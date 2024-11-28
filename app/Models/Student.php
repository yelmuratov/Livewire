<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    protected $fillable = ['name', 'surname', 'age', 'address', 'phone'];

    use HasFactory;
}
