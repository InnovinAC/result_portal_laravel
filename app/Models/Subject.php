<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubjectCombination;

class Subject extends Model
{
    use HasFactory;

    public function subjectCombo() {
        return $this->hasMany(SubjectCombination::class);
    }

    public function subjectForClass() {
        return $this->subjectCombo()->where('school_class_id', 1);
    }

    protected $fillable = ['name'];
}
