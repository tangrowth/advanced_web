<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = array('id');

    public function getTitle(){
        return 'ID'.$this->id . ':' . $this->task;
    }

    public function user(){
        return $this->belongs('App\User');
    }
}
