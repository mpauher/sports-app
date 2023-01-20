<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'average',
        'sport_id',
        'trainer_id',
        'user_id',
    ];

    public function player(){
        return $this->hasTo(Player::class);
    }

    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }

    public function sport(){
        return $this->belongsTo(Sport::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
