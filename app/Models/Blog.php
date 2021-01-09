<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_category' ,
        'id_user',
        'name' ,
        'slug', 
        'short_text',
        'long_text' ,
        'image',        
    ];

}
