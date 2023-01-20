<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
       'lastname',
        'email',
        'level',
        'age',
        'team_id',
        'position_id',
    ];

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }
}
