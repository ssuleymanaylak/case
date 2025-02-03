<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yukatechtest extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'latitude', 'longitude', 'color'];
}
