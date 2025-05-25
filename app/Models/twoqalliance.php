<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Twoqalliance extends Model
{
    protected $table = 'twoqalliances';  // explicitly specify table name if plural
    protected $fillable = ['name', 'email', 'logo', 'website']; // to allow mass assignment
}
