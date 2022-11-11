<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user/{id}', function ($id) {
//     $user = User::find($id);
//     $hello = json_decode('{"2" :{
//         "id": 14,
//         "student_name": "Polly Grain",
//         "gender": "Female",
//         "stream_id": 1,
//         "school_id": 1,
//         "final_year_id": 2,
//         "grade": "Form Four"
//     },
//     "3": {
//         "id": 15,
//         "student_name": "Polly Grain",
//         "gender": "Male",
//         "stream_id": 3,
//         "school_id": 1,
//         "final_year_id": 2,
//         "grade": "Form Four"
//     }
// }');


$ids = [21, 19, 7];
$users = User::get()->sortBy(function($user, $key) use($ids) {
    return array_search($user->id, $ids);
});
return $users;
});
