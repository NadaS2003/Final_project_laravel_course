<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;


    protected $fillable = ['first_name', 'last_name','email','phone'];

    public function assignments(){
        return $this->hasMany(Assignment::class);
    }
}
