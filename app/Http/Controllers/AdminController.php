<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\Rating;
use App\Models\RatingName;
use App\Models\Result;
use App\Models\ResultExtra;
use App\Models\SchoolClass;
use App\Models\Session;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectCombination;
use App\Models\Term;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            return $next($request);
        });
    }

    // check if admin
    public function isAdmin()
    {
        if ($this->user->role == 1) {
            return true;
        } else {
            return false;
        }
    }

    // dashboard
    public function index()
    {

        $setting = Setting::first();
        $current_term = $setting->term_id;
        $current_session = $setting->session_id;

        $data['students_count'] = Student::when(function ($query) {
            if (!$this->isAdmin()) {
                $query->where('school_class_id', $this->user->school_class_id);
            }
        })->all()->count();
        if ($this->isAdmin()) {
            $data['subjects_count'] = Subject::count();
            $data['subject_combos_count'] = SubjectCombination::count();
            $data['sessions_count'] = Session::count();
            $data['teachers_count'] = User::get()->except($this->user->id)->count();

            // For the form to quickly check a student's result
            $data['school_classes'] = SchoolClass::get();
            $data['terms'] = Term::get();
            $data['sessions'] = Session::get();
        }

        $data['results_count'] = Result::when(function ($query) use ($current_term, $current_session) {
            $query->where(['session_id' => $current_session,
                'term_id' => $current_term]);
        })->get()->count();

        $data['is_admin'] = $this->isAdmin();

        return view('admin.dashboard', $data);
    }

    // login method
    public function login(Request $request)
    {

        // if we clicked the submit button
        if ($request->isMethod('post')) {

            $request->validate([
                'user' => 'required|max:30',
                'password' => 'required',
            ]);

            $credentials = [
                'username' => strtolower($request->user),
                'password' => $request->password,
            ];

            // check if user exists
            if (!User::where('username', $request->user)->first()) {
                return back()->withInput(request()->only('user'))->with('error', 'User does not exist');
            }

            // if user exists:
            elseif ($user = User::where('username', $request->user)->first()) {

                // check if their password is correct
                if (!(Hash::check($request->password, $user->password))) {
                    return back()->withInput(request()->only('user'))->with('error', 'Incorrect password');
                } else {
                    // then finally login. cheers!
                    Auth::attempt($credentials);
                    return redirect()->route('dashboard')->with('success', 'You have logged in successfully');
                }

            }

        }

        // if user is already logged in:
        elseif ($this->user) {
            return redirect()->route('dashboard')->with('info', 'You are already logged in');
        }

        return view('admin.login');
    }

    // logout method
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', 'You have logged out successfully.');
    }

    /*
    ----------------------------------------
    TEACHER METHODS
    ----------------------------------------
     */

    public function showTeachers()
    {
        if ($this->user->role != 1) {
            return back()->with('error', 'You are not allowed to view that page');
        }

        $users = User::where('role', '!=', 1)->get();
        return view('admin.teachers', compact('users'));

    }

    public function deleteTeacher(Request $request, $id)
    {
        if ($id == 'multiple') {

            if ($request->delete) {
                $i = 0;
                foreach ($request->delete as $id) {
                    User::destroy($id);
                    ++$i;
                }

                return back()->with('success', '<b>' . $i . '</b> teacher account(s) have been deleted successfully.');
            }

            return back()->with('error', 'No teachers were selected.');
        }

        User::find($id)->delete();
        return 1;
    }

    public function createTeacher(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|max:20|min:5|unique:users,username|',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20|alpha_num',
                'confirm' => 'required|same:password',
                'class' => 'required',
                'name' => 'required',
            ]);

            $user = new User();
            $user->username = $request->username;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->school_class_id = $request->class;
            $user->save();

            return back()->with('success', 'Teacher account has been created successfully');
        }
        $school_classes = SchoolClass::get();
        return view('admin.create.teacher', compact('school_classes'));

    }

    // Edit Teacher Method
    public function editTeacher($id, Request $request)
    {

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|min:5|max:30',
                'username' => [
                    'required', 'min:5',
                    Rule::unique('users', 'username')->ignore($id),
                ],
                'class' => 'required',
                'email' => [
                    'required', 'email', 'min:5',
                    Rule::unique('users', 'email')->ignore($id),
                ],

            ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->school_class_id = $request->class;
            $user->save();

            return back()->with('success', 'Teacher details updated successfully');

        }

        $data['school_classes'] = SchoolClass::get();
        try {
            $data['teacher'] = User::findorFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Sorry, that teacher account does not exist.');
        }
        $data['id'] = $id;
        return view('admin.edit.teacher', $data);

    }

    /*
    ----------------------------------------

    STUDENT METHODS

    ----------------------------------------
     */

    // Show students
    public function showStudents()
    {
        $role = $this->user->role;
        $class = $this->user->school_class_id;
        $students = Student::when(function ($q) use ($role, $class) {
            if ($role == 2) {
                $q->where('school_class_id', $class);
            }

        })
            ->orderBy('school_class_id', 'asc')->orderBy('name', 'asc')->get();
        return view('admin.students', compact('students'));

    }
    // End Show Students

    // Delete Student
    public function deleteStudent(Request $request, $id)
    {
        if ($id == 'multiple') {
            if ($request->delete) {
                foreach ($request->delete as $id) {

                    $student = Student::find($id);

                    if ($student->image != "" && file_exists('storage/uploads/students/' . $student->image)) {

                        unlink('storage/uploads/students/' . $student->image);

                    }
                    $student->delete();
                    Result::where('student_id', $id)->delete();
                }
                return back()->with('success', 'Selected students have been deleted successfully.');
            }

            return back()->with('error', 'No students were selected.');
        }
        $student = Student::find($id);

        if ($student->image != "" && file_exists('storage/uploads/students/' . $student->image)) {

            unlink('storage/uploads/students/' . $student->image);

        }

        $student->delete();
        Result::where('student_id', $id)->delete();

        return 1;

    }
    // End Delete students

    // Create student
    public function createStudent()
    {
        if (request()->isMethod('post')) {

            request()->validate([

                'name' => [
                    'required',
                    Rule::unique('students', 'name')->where(function ($query) {
                        return $query->where('gender', request()->gender);
                    }),
                    'min:8',
                    'max:30',
                ],

                'regnum' => [
                    'required',
                    'unique:students,regnum',
                ],
                'dob' => 'date|before:today',
                'class' => 'required|exists:school_classes,id',
                'image' => 'image|mimes:png,jpg,jpeg|max:300',
            ],
                [
                    'regnum.unique' => 'The registration number has already been taken',
                    'dob.before' => 'The date of birth must be a date before today',
                    'name.unique' => 'A ' . request()->gender . ' student with that name already exists',
                    'image.image' => 'The uploaded file must be an image',

                ]);

            $student = new Student();
            $student->name = request()->name;
            $student->date_of_birth = request()->dob;
            $student->regnum = request()->regnum;
            $student->school_class_id = request()->class;
            if (request()->file('image')) {
                $file = request()->file('image');
                $ext = $file->extension();
                $final_name = hash('sha1', time()) . "." . $ext;
                $file->storeAs('public/uploads/students', $final_name);
                $student->image = $final_name;
            }
            $student->gender = request()->gender;
            if ($student->save()) {

                return back()->with('success', 'Student created successfully');
            }

        }

        switch ($this->user->role) {
            case 1:
                $data['classes'] = SchoolClass::get();
                break;

            default:
                $data['classes'] = SchoolClass::get()->where('id', $this->user->school_class_id);
                break;
        }

        return view('admin.create.student', $data);

    }
    // End create student

    // Edit student
    public function editStudent($id)
    {
        if (request()->isMethod('post')) {
            request()->validate([

                'name' => [
                    'required',
                    Rule::unique('students', 'name')->ignore($id)->where(function ($query) {
                        return $query->where('gender', request()->gender);

                    }),
                    'min:8',
                    'max:30',
                ],

                'regnum' => [
                    'required',
                    Rule::unique('students', 'regnum')->ignore($id),
                ],
                'dob' => 'date|before:today',
                'class' => 'required|exists:school_classes,id',
                'image' => 'image|mimes:png,jpg,jpeg|max:300',
                'status' => 'required',
            ],
                [
                    'regnum.unique' => 'The registration number has already been taken',
                    'dob.before' => 'The date of birth must be a date before today',
                    'name.unique' => 'A ' . request()->gender . ' student with that name already exists',
                    'image.image' => 'The uploaded file must be an image',

                ]);

            $student = Student::find($id);

            // delete old image
            if ($student->image != "" && file_exists('storage/uploads/students/' . $student->image) && !empty(request()->file('image'))) {

                unlink('storage/uploads/students/' . $student->image);

            }

            $student->name = request()->name;
            $student->date_of_birth = request()->dob;
            $student->regnum = request()->regnum;
            $student->school_class_id = request()->class;

            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $ext = $file->extension();
                $final_name = hash('sha1', time()) . "." . $ext;
                $file->storeAs('public/uploads/students', $final_name);
                $student->image = $final_name;
            }

            $student->gender = request()->gender;
            $student->status = request()->status;

            if ($student->save()) {

                return back()->with('success', 'Student information edited successfully.');
            }

        }

        switch ($this->user->role) {
            case 1:
                $data['classes'] = SchoolClass::get();
                break;

            default:
                $data['classes'] = SchoolClass::get()->where('id', $this->user->school_class_id);
                break;
        }

        try {
            $data['student'] = Student::findorFail($id);

        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Student does not exist');
        }
        return view('admin.edit.student', $data);

    }
    // End edit student

    /*
    ----------------------------------------

    SUBJECT METHODS

    ----------------------------------------
     */

    public function showSubjects()
    {
        $subjects = Subject::orderBy('name', 'asc')->get();
        return view('admin.subjects', compact('subjects'));
    }

    // Delete Subject Method
    public function deleteSubject(Request $request, $id)
    {
        // get all results as well as their ids
        $results = Result::pluck('result', 'id')->toArray();

        if ($id == 'multiple') {
            if ($request->delete) {
                foreach ($request->delete as $id) {

                    // loop through the results
                    foreach ($results as $result) {

                        // convert the json to array
                        $result = json_decode($result, JSON_FORCE_OBJECT);

                        // if the subject exists in the result
                        if (array_key_exists($id, $result)) {
                            // start working on editing the result
                            $new_result = Result::find(array_search(json_encode($result), $results));

                            // remove the subject(as well as scores) from the result array
                            unset($result[$id]);

                            // Re-calculate average
                            $scores_sum_array = collect();
                            foreach (array_keys($result) as $key) {
                                $sum = array_sum($result[$key]);
                                $scores_sum_array->push($sum);
                            }

                            // update the average and result with new values
                            $new_result->result = json_encode($result);
                            $new_result->average = $scores_sum_array->avg();
                            $new_result->save();

                        }
                    }

                    if (Subject::destroy($id)) {
                        SubjectCombination::where('subject_id', $id)->delete();

                    }
                }
                return back()->with('success', 'Selected subject combinations have been deleted successfully.');
            }

            return back()->with('error', 'No subjects were selected.');
        }

        // loop through the results
        foreach ($results as $result) {

            // convert the json to array
            $result = json_decode($result, JSON_FORCE_OBJECT);

            // if the subject exists in the result
            if (array_key_exists($id, $result)) {
                // start working on editing the result
                $new_result = Result::find(array_search(json_encode($result), $results));

                // remove the subject(as well as scores) from the result array
                unset($result[$id]);

                // Re-calculate average
                $scores_sum_array = collect();
                foreach (array_keys($result) as $key) {
                    $sum = array_sum($result[$key]);
                    $scores_sum_array->push($sum);
                }

                // update the average and result with new values
                $new_result->result = json_encode($result);
                $new_result->average = $scores_sum_array->avg();
                $new_result->save();

            }
        }

        // delete the subject
        if (Subject::destroy($id)) {
            SubjectCombination::where('subject_id', $id)->delete();
            // echo output to ajax
            return 1;
        }
    }

    // Create subject method
    public function createSubject(Request $request)
    {

        if ($request->isMethod('post')) {

            //     request()->validate([
            //         'subject_name' => 'array',
            //         'subject_name.*' => ['required','string', 'unique:subjects,name', 'min:3', 'distinct'],

            //     ],
            // );

            if (count($request->subject_name) > 0) {
                $i = 0;
                foreach ($request->subject_name as $name) {

                    if (!Subject::where('name', $name)->first()) {
                        Subject::create(['name' => ucwords($name)]);
                        ++$i;

                    }

                }
                switch ($i) {
                    case 0:
                        return back()->with('error', 'No unique subjects found.');

                    default:
                        return back()->with('success', '<b>' . $i . '</b> unique subject(s) created successfully');

                }

            }

        }

        return view('admin.create.subject');
    }

    // End create subject method

    public function editSubject($id)
    {
        if (request()->isMethod('post')) {
            request()->validate([
                'name' => [
                    'required',
                    Rule::unique('subjects', 'name')->ignore($id),
                ],
            ]);

            $subject = Subject::find($id);
            $subject->name = ucwords(request()->name);
            $subject->save();

            return back()->with('success', 'Subject edited successfully');

        }
        try {
            $data['subject'] = Subject::findorFail($id);

        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Subject does not exist');
        }
        return view('admin.edit.subject', $data);
    }

    /*
    -----------------------------------------------

    SUBJECT COMBINATION METHODS

    -----------------------------------------------
     */

    public function showSubjectCombos()
    {
        if ($this->user->role != 1) {
            $subject_combos = SubjectCombination::with('subject')->where('school_class_id', $this->user->school_class_id)->get()->sortBy(function ($subject_combo) {
                return $subject_combo->subject->name;
            });
        } else {
            $subject_combos = SubjectCombination::with('schoolClass')->orderBy('school_class_id', 'ASC')->get()->sortBy(function ($subject_combo) {
                return $subject_combo->schoolClass->name;
            });
        }
        return view('admin.subject-combos', compact('subject_combos'));
    }

    // Activate or Deactivate subject combination
    public function toggleSubjectCombo($id)
    {

        try {
            $subject_combo = SubjectCombination::findorFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Sorry, that subject combination does not exist');
        }
        if ($subject_combo->status == 'active') {
            $subject_combo->status = 'inactive';
            $response = 'Subject combination deactivated successfully';
        } else {
            $subject_combo->status = 'active';
            $response = 'Subject combination activated successfully';
        }

        $subject_combo->save();
        return back()->with('success', $response);
    }

    // delete subject combination
    public function deleteSubjectCombo(Request $request, $id)
    {
        if ($id == 'multiple') {
            if ($request->delete) {
                foreach ($request->delete as $id) {

                    SubjectCombination::destroy($id);

                }
                return back()->with('success', 'Selected subject combinations have been deleted successfully.');
            }

            return back()->with('error', 'No subject combinations were selected.');
        }

        if (SubjectCombination::destroy($id)) {
            return 1;
        }
    }

    // Create Subject Combination
    public function createSubjectCombo(Request $request)
    {
        if (request()->isMethod('post')) {

            $request->validate([
                'class' => 'required|exists:school_classes,id',
            ]);
            $values = array();
            foreach ($request->subjects as $subject) {

                if (!SubjectCombination::where('school_class_id', $request->class)->where('subject_id', $subject)->first()) {
                    array_push($values, 1);
                    $subject_combo = new SubjectCombination();
                    $subject_combo->subject_id = $subject;
                    $subject_combo->school_class_id = $request->class;
                    $subject_combo->status = 'active';

                    $subject_combo->save();

                } else {
                    array_push($values, 0);

                }

            }

            if (!in_array(1, $values)) {
                return back()->with('error', 'All those subject combinations already exist');
            } else {
                return back()->with('success', 'Valid subject combinations created successfully');
            }

            return back()->with('success', 'Subject combinations added successfully');
        }
        $data['subjects'] = Subject::get();

        if ($this->user->role != 1) {
            $data['classes'] = SchoolClass::where('id', $this->user->school_class_id)->get();
        } else {
            $data['classes'] = SchoolClass::get();
        }
        return view('admin.create.subject-combo', $data);
    }

    /*
    ----------------------------------------

    SESSION METHODS

    ----------------------------------------
     */

    public function showSessions()
    {
        $sessions = Session::orderBy('name')->get();
        return view('admin.sessions', compact('sessions'));
    }

    // Delete session method
    public function deleteSession($id)
    {
        $delete['session'] = Session::destroy($id);
        $delete['results'] = Result::where('session_id', $id)->delete();
        $delete['result_extras'] = ResultExtra::where('session_id', $id)->delete();
        $delete['averages'] = Average::where('session_id', $id)->delete();

        if ($delete) {
            return 1;
        }
    }
    // End delete session

    // Create Session
    public function createSession(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|min:4|max:20|unique:sessions,name',
            ]);

            $session = new Session();
            $session->name = $request->name;
            $session->save();

            return back()->with('success', 'Session created successfully');
        }
        return view('admin.create.session');
    }

    // Edit session Method
    public function editSession($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => [
                    'required', 'min:4', 'max:20',
                    Rule::unique('sessions', 'name')->ignore($id),
                ],
            ]);

            $session = Session::find($id);
            $session->name = $request->name;
            $session->save();
            return back()->with('success', 'Session details edited successfully');
        }

        try {
            $session = Session::findorFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Sorry. That session does not exist');
        }
        return view('admin.edit.session', compact('session'));
    }

    // End Edit Session Method

    // Edit Profile
    public function editProfile(Request $request)
    {

        $id = $this->user->id;

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|min:5|max:30',
                'username' => [
                    'required', 'min:5',
                    Rule::unique('users', 'username')->ignore($id),
                ],
                'class' => 'required',
                'email' => [
                    'required', 'email', 'min:5',
                    Rule::unique('users', 'email')->ignore($id),
                ],
                'image' => 'image|mimes:png,jpg,jpeg|max:200',

            ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;

            if ($request->hasFile('image') && file_exists('storage/uploads/admin/' . $user->image)) {
                $file = $request->file('image');

                if ($user->image != 'avatar.png') {
                    unlink('storage/uploads/admin/' . $user->image);
                }

                $ext = $file->extension();
                $final_name = hash('sha1', time()) . "." . $ext;
                $file->storeAs('public/uploads/admin', $final_name);
                $user->image = $final_name;

            }

            $user->save();

            return back()->with('success', 'Profile updated successfully');

        }

        $data['user'] = User::find($id);
        $data['school_class'] = SchoolClass::where('id', $data['user']->school_class_id)->first()->name;

        $data['id'] = $id;
        return view('admin.edit.profile', $data);

    }
    // End Edit Profile

    // Change Password Method
    public function changePassword(Request $request)
    {

        if ($request->isMethod('post')) {
            $id = $this->user->id;

            $user = User::find($id);

            if (Hash::check($request->current_password, $user->password)) {
                $request->validate([
                    'current_password' => 'required',
                    'new_password' => 'required|alpha_num|min:5|max:20',
                    'confirm_password' => 'required|same:new_password',
                ]);

                $user->password = Hash::make($request->new_password);
                $user->save();
                return back()->with('success', 'Your password has been changed successfully');
            } else {
                return back()->with('error', 'Your current password is incorrect');
            }
        }

        return view('admin.edit.password');

    }
    // End Edit Password

    public function changeSettings(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|min:5',
                'location' => 'required|min:7',
                'image' => 'image|mimes:png,jpeg,jpg',
            ]);
            $file = $request->file('image');
            $setting = Setting::first();
            $setting->session_id = $request->session;
            $setting->school_name = $request->name;
            $setting->location = $request->location;
            $setting->is_disabled = 0;
            $setting->term_id = $request->term;
            $setting->use_pins = $request->pins;

            if ($setting->save()) {
                if ($file) {
                    if (file_exists('storage/uploads/image/logo.png')) {
                        unlink('storage/uploads/image/logo.png');
                    }

                    $file->storeAs('public/uploads/image', 'logo.png');
                }

                return back()->with('success', 'Settings saved successfully');
            }

        }

        $data['sessions'] = Session::get();
        $data['terms'] = Term::get();

        return view('admin.edit.settings', $data);

    }

    /*
    ----------------------------------------

    PIN METHODS

    ----------------------------------------
     */

    public function createPin(Request $request)
    {
        if ($request->isMethod('post')) {

            // function to generate random n-characters pin
            function random_strings($length)
            {

                // String of all alphanumeric character
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

                // Shuffle the $str_result and returns substring
                // of specified length
                return substr(str_shuffle($str_result),
                    0, $length);
            }

            $request->validate([
                'count' => 'required|numeric|max:500',
                'characters' => 'required|numeric|max:10',
                'trials' => 'required|numeric|min:2',
            ]);
            $count = 0;
            for ($i = 0; $i < $request->count;) {
                $pin = new Pin();
                $string = random_strings($request->characters);
                $pin->pin = $string;
                $pin->trials = $request->trials;

                if (!Pin::where('pin', $string)->first()) {
                    $pin->save();
                    $count++;
                }

                $i++;

            }

            return back()->with('success', '<b>' . $count . '</b> unique pins created successfully');

        }

        return view('admin.create.pin');
    }
    // End Create Pin

    // Start Show Pins
    public function showPins()
    {
        // All pins except the top secret for admin :)
        $pins = Pin::get()->except(568);
        return view('admin.pins', compact('pins'));
    }
    // End Show Pins

    // Delete Pin Method
    public function deletePin(Request $request, $id)
    {
        if ($id == 'multiple') {
            if ($request->delete) {
                foreach ($request->delete as $id) {

                    Pin::destroy($id);

                }
                return back()->with('success', 'Selected pins have been deleted successfully.');
            }

            return back()->with('error', 'No pins were selected.');
        }

        if (Pin::destroy($id)) {
            return 1;
        }
    }

    /*
    ----------------------------------------

    RESULT METHODS

    ----------------------------------------
     */

    // Start Show Results
    public function showResults()
    {
        if ($this->user->role != 1) {
            $results = Result::with('student')->where('school_class_id', $this->user->school_class_id)->where('session_id', Setting::first()->session_id)->get()->sortBy(function ($q) {
                return $q->student->name;
            });
        } else {
            $results = Result::with(['student', 'term', 'session', 'schoolClass'])->orderBy('school_class_id', 'asc')->get()->sortBy(function ($q) {
                return $q->student->name;
            });

        }
        return view('admin.results', compact('results'));
    }

    // Start Create Result Method
    public function createResult(Request $request)
    {

        if ($request->isMethod('post')) {

            if (!$this->isAdmin() && [session()->pull('school_class_id'), session()->pull('term'), session()->pull('session')] != [$request->class, $request->term, $request->session]) {

                return back()->with('warning', 'Stop that. You cannot hack the system!');

            }

            $request->validate([
                'student' => 'required|exists:students,id|numeric',
                'class' => 'required|exists:school_classes,id|numeric',
                'session' => 'required|numeric|exists:sessions,id',
                'term' => 'required|numeric|exists:terms,id',
                'comment' => 'required|min:2',
                'rating' => 'required',
                'rating.*' => 'required',
                'cas' => 'required',
                'exams' => 'required',

            ]);

            // remove empty exam and ca scores from the arrays
            $request->exams = (array_filter($request->exams));
            $request->cas = (array_filter($request->cas));

            $cas = collect($request->cas)->intersectByKeys($request->exams)->toArray();
            $exams = collect($request->exams)->intersectByKeys($request->cas)->toArray();

            $subjects = $request->subjectid;

            // Doing this trick removes the subjects that do not have
            // a corresponding exam score

            $subjects = collect($subjects)->intersectbyKeys($exams)->toArray();

            /*
            Now here is what the next set of tricks do. Since the array_merge_recursive function does not work as supposed to if the keys are integers. What I am doing here is to convert the integer keys to strings(alphabet letter combinations) dynamically.
             */

            $digits = range(0, 9);

            $alphabet = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j");

            $new_array = [];
            foreach (array_keys($cas) as $key) {
                $new_key = "";
                foreach (str_split($key) as $i) {
                    $i = str_replace($digits, $alphabet, $i);
                    $new_key = $new_key . $i;
                }
                array_push($new_array, $new_key);
            }

            $results = array_combine($subjects, array_merge_recursive(array_combine($new_array, $cas), array_combine($new_array, $exams)));

            $ratings = array_combine($request->rating_id, $request->rating);

            [$ratings, $results] = [json_encode($ratings), json_encode($results)];

            if (Result::where('session_id', $request->session)->where('term_id', $request->term)->where('school_class_id', $request->class)->where('student_id', $request->student)->first()) {

                return back()->with('error', 'Sorry that result already exists.');
            }

            $result = new Result();
            $result->term_id = $request->term;
            $result->session_id = $request->session;
            $result->school_class_id = $request->class;
            $result->student_id = $request->student;
            $result->comment = $request->comment;
            $result->rating = $ratings;
            $result->result = $results;

            $result->save();

            return back()->with('success', 'Result created successfully');

        }

        if (!$this->isAdmin()) {
            $request->session()->put([
                // Doing this so a malicious user wont go ahead and create a result for another class that is not theirs
                'school_class_id' => $this->user->school_class_id,
                'session' => Setting::first()->session_id,
                'term' => Setting::first()->term_id,

            ]);
            $data['classes'] = SchoolClass::where('id', $this->user->school_class_id)->get();

            $data['sessions'] = Session::where('id', Setting::first()->session_id)->get();

            $data['terms'] = Term::where('id', Setting::first()->term_id)->get();

            $data['students'] = Student::where('school_class_id', $this->user->school_class_id)->get();
        } else {
            $data['classes'] = SchoolClass::get();
            $data['sessions'] = Session::get();
            $data['terms'] = Term::get();
            $data['students'] = Student::get();

        }

        $data['rating_names'] = RatingName::orderBy('name', 'asc')->get();

        return view('admin.create.result', $data);
    }

    // Get all subjects assigned to a selected class

    public function getSubjects(Request $request)
    {

        if ($request->classid) {

            $data['subjects'] = SubjectCombination::where('school_class_id', $request->classid)->where('status', 'active')->with('subject')->get();
            $data['class_name'] = SchoolClass::find($request->classid)->name;

            return view('admin.partials.get-subjects', $data);

        }

    }

    // Start Edit Result

    public function editResult(Request $request)
    {

        if ($request->isMethod('post')) {

            // if user tries to force edit another result, tell them they are hackers
            if ($request->session()->pull('result_id') != $request->result_id) {

                return back()->with('warning', 'Nice try hacker!');
            }

            $request->validate([
                'comment' => 'required|min:2',
                'rating' => 'required',
                'rating.*' => 'required',
                'cas' => 'required',
                'exams' => 'required',

            ]);

            // remove empty exam and ca scores from the arrays
            $request->exams = (array_filter($request->exams));
            $request->cas = (array_filter($request->cas));

            $cas = collect($request->cas)->intersectByKeys($request->exams)->toArray();
            $exams = collect($request->exams)->intersectByKeys($request->cas)->toArray();

            // calculate average
            $scores_sum_array = collect();
            foreach (array_keys($cas) as $key) {
                $sum = $cas[$key] + $exams[$key];
                $scores_sum_array->push($sum);
            }

            $subjects = array_unique($request->subject_id);

            // Doing this trick removes the subjects that do not have
            // a corresponding exam score

            $subjects = collect($subjects)->intersectbyKeys($cas)->toArray();

            /*
            Now here is what the next set of tricks do. Since the array_merge_recursive function does not work as supposed to if the keys are integers. What I am doing here is to convert the integer keys to strings(alphabet letter combinations) dynamically.
             */

            $digits = range(0, 9);

            $alphabet = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j");

            $new_array = [];
            foreach (array_keys($cas) as $key) {
                $new_key = "";
                foreach (str_split($key) as $i) {
                    $i = str_replace($digits, $alphabet, $i);
                    $new_key = $new_key . $i;
                }
                array_push($new_array, $new_key);
            }

            $results = array_combine($subjects, array_merge_recursive(array_combine($new_array, $cas), array_combine($new_array, $exams)));

            $ratings = array_combine($request->rating_id, $request->rating);

            [$ratings, $results] = [json_encode($ratings), json_encode($results)];

            $result = Result::find($request->result_id);

            $result->average = $scores_sum_array->avg();
            $result->comment = $request->comment;
            $result->rating = $ratings;
            $result->result = $results;

            $result->save();

            return back()->with('success', 'Result has been edited successfully.');

            // Post request end
        }

        // Get request start
        try {
            $data['result'] = Result::with(['student', 'term', 'session', 'schoolClass'])->findorFail($request->id);
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Sorry, that result does not exist or has been deleted from the database.');
        }

        if (!$this->isAdmin()) {

            if ([$data['result']->session_id, $data['result']->school_class_id] != [Setting::first()->session_id, $this->user->school_class_id]) {

                return back()->with('error', 'You are not allowed to edit that result.');

            }

        }

        $data['subjects'] = array_keys(json_decode($data['result']->result, JSON_FORCE_OBJECT));

        // subjects not in result
        $data['not_subjects'] = SubjectCombination::with('subject')->where('school_class_id', $data['result']->school_class_id)->where('status', 'active')->whereNotIn('subject_id', $data['subjects'])->get();

        // work-around to make sure it retrieves the subject from the database in the order they were stored
        $data['arranged_subjects'] = collect([]);
        foreach ($data['subjects'] as $subject) {
            $data['arranged_subjects']->push(Subject::where('id', $subject)->first());
        }

        $data['scores'] = array_values(json_decode($data['result']->result, JSON_FORCE_OBJECT));

        $data['ratings'] = json_decode($data['result']->rating, JSON_FORCE_OBJECT);


        $data['rating_ids'] = array_keys($data['ratings']);
        $data['rating_names'] = RatingName::whereIn('id', $data['rating_ids'])->pluck('name');

        // Set a session variable to prevent users from exploiting the hidden 'result_id' input element
        $request->session()->put('result_id', $data['result']->id);

        return view('admin.edit.result', $data);

    }

    // Delete result method
    public function deleteResult(Request $request, $id)
    {
        if ($id == 'multiple') {
            if ($request->delete) {
                foreach ($request->delete as $id) {

                    Result::destroy($id);

                }
                return back()->with('success', 'Selected results have been deleted successfully.');
            }
            return back()->with('error', 'No pins were selected.');
        }

        if (Result::destroy($id)) {
            return 1;
        }

    }

    public function promote()
    {
        if (request()->isMethod('post')) {
            Student::whereHas('schoolClass', function ($query) {
                $query->where('name', '!=', 'graduated');
            })->increment('school_class_id');
            return back()->with('success', 'All students have been promoted to next class');
        }

        return view('admin.promote');

    }
    // public function blah() {
    //     $monitors = User::whereHas('schoolClass', function($q)
    //     {
    //         $q->where('blah', 'hi');

    //     })->get();
    //     dd($monitors);
    // }

}
