<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addCq extends Model
{
    use HasFactory;
    public function search($keyword)
    {
        return $this->where('departmentName', 'like', '%' . $keyword . '%')
        ->orWhere('subjectName', 'like', '%' . $keyword . '%')
        ->orWhere('chapterName', 'like', '%' . $keyword . '%')
        ->orWhere('questionCat', 'like', '%' . $keyword . '%')
        ->orWhere('uddipakText', 'like', '%' . $keyword . '%')
        ->orWhere('question1', 'like', '%' . $keyword . '%')
        ->orWhere('question2', 'like', '%' . $keyword . '%')
        ->orWhere('question3', 'like', '%' . $keyword . '%')
        ->orWhere('question4', 'like', '%' . $keyword . '%')
        ->orWhere('answerQuestion1', 'like', '%' . $keyword . '%')
        ->orWhere('answerQuestion2', 'like', '%' . $keyword . '%')
        ->orWhere('answerQuestion3', 'like', '%' . $keyword . '%')
        ->orWhere('answerQuestion4', 'like', '%' . $keyword . '%')
        ->orWhere('addedBy', 'like', '%' . $keyword . '%')->get();
    }
}
