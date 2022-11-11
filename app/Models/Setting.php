<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Term;
use App\Models\Session;

class Setting extends Model
{
    use HasFactory;

    // public function session() {
    //     return $this->belongsTo(Session::class);
    // }

    // public function term() {
    //     return $this->belongsTo(Term::class);
    // }


}
