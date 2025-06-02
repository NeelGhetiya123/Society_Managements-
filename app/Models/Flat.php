<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;
    protected $fillable = [
        'allotedTo', 
        'flatNo', 
        'blockNo', 
        'phoneNo', 
        'type', 
        'created_at'
    ];
}
