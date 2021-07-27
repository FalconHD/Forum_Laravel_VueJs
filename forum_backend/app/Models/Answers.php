<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;


    protected $fillable = [
        'answer',
        'Post_id',
        'user_id'
    ];
}
