<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addMcq extends Model
{
    use HasFactory;

    public function search($keyword)
    {
        return $this->where('question', 'like', '%' . $keyword . '%')
        ->orWhere('uploaded_by', 'like', '%' . $keyword . '%')->get();
    }
}
