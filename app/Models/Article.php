<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function Category()
    {
    return $this->belongsTo('App\Models\Category');
    }

    public function Comments(){
        return $this->hasMany("App\Models\Comment");
    }

    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}

