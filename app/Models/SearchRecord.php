<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchRecord extends Model
{
    protected $table = 'searchrecords'; 
    use HasFactory;
    protected $fillable = ['user_id','searching_for'];
}
