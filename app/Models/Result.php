<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Term;
use App\Models\Session;
use App\Models\SchoolClass;
use App\Models\Student;

class Result extends Model
{
    use HasFactory;

    public function term() {
        return $this->belongsTo(Term::class);
    }

    public function session() {
        return $this->belongsTo(Session::class);
    }

    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }



}
