<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;


    protected $fillable = ['volunteer_id', 'place_id', 'task_id'];

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function volunteer(){
        return $this->belongsTo(Volunteer::class);
    }
}
