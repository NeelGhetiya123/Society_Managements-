<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'flatNo', 
        'visitorName', 
        'visitorPhone', 
        'personToMeet', 
        'entryTime', 
        'exitTime',
        'created_at'
    ];
}
