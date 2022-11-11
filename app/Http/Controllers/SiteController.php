<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\RatingName;
use App\Models\Setting;
use App\Models\Pin;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class SiteController extends Controller
{
    //

    public function toOrdinal($number)
    {

        $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
        if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
            return $number . 'th';
        } else {
            return $number . $ends[$number % 10];
        }

    }




    public function array_rank($array, $number)
    {


        arsort($array);

        $number_key = array_search($number, $array);
        # Initival values
        $rank = 0;
        $hiddenrank = 0;
        $hold = null;
        foreach ($array as $key => $val) {
            # Always increase hidden rank
            $hiddenrank += 1;

            # If current value is lower than previous:
            # set new hold, and set rank to hiddenrank.
            if (is_null($hold) || $val < $hold) {
                $rank = $hiddenrank;
                $hold = $val;
            }
            # Set rank $rank for $in[$key]
            $array[$key] = $rank;
        }



        return $this->toOrdinal($array[$number_key]);
    }


    public function index() {

        return view('check-result');
    }



    public function getResult(Request $request) {

        // if($request->isMethod('get')) {
        //     return redirect()->back();
        // }
        $use_pins = Setting::first()->use_pins;
        if($use_pins == 'no') {
        $request->validate([
            'regnum' => 'required',
            'class' => 'required|numeric',
            'term' => 'required|numeric',
            'session' => 'required|numeric'
        ]);
    }
    else {
        $request->validate([
            'regnum' => 'required',
            'class' => 'required|numeric',
            'term' => 'required|numeric',
            'session' => 'required|numeric',
            'pin' => 'required'
        ]);
    }
        try {
        $student = Student::where('regnum', $request->regnum)->firstOrFail();

        }
        catch(ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'No student with that registration number exists');
        }

        if($student->status == 'blocked') {
            return redirect()->back()->with('error', "<b>".$student->name."&#39;</b>s account is currently disabled.");
        }


        try {
        $data['result'] = Result::where([
            'session_id'=> $request->session,
            'term_id' => $request->term,
            'school_class_id' => $request->class,
            'student_id' => $student->id
        ])->with(['term','session','schoolClass','student'])->firstOrFail();

        }
        catch(ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Result Not Found. Please check the details you entered.');
        }

        if($use_pins == 'yes') {
            try {
        $pin = Pin::where('pin', $request->pin)->firstOrFail();
            }
            catch(ModelNotFoundException $e) {
                return redirect()->back()->with('error', 'Pin does not exist. Check that you typed it correctly.');
            }
            if ($pin->trials == 0) {
                return redirect()->back()->with('error', 'You have exhausted the maximum number of usages on that pin.');
        }

        else {

            // count as one usage and update the pin trials
            $pin->trials -= 1;
            $data['trials_left'] = $pin->trials;
            $pin->save();
        }
        }



        $data['subjects'] = array_keys(json_decode($data['result']->result, JSON_FORCE_OBJECT));
        $data['subjects'] = Subject::whereIn('id', $data['subjects'])->get();
        $data['scores'] = array_values(json_decode($data['result']->result, JSON_FORCE_OBJECT));

        $data['ratings'] = json_decode($data['result']->rating, JSON_FORCE_OBJECT);

        $data['rating_ids'] = array_keys($data['ratings']);
        $data['rating_names'] = RatingName::whereIn('id', $data['rating_ids'])->pluck('name');

        $averages = Result::pluck('average')->toArray();
        $data['total'] = [];
        foreach($data['scores'] as $scores) {
            $sum = array_sum($scores);
            array_push($data['total'], $sum);
        }
        $data['out_of'] = count($data['total']) * 100;
        $data['total'] = array_sum($data['total']);


        $data['position_in_class'] = $this->array_rank($averages, $data['result']->average);

        return view('result', $data);



    }



}
