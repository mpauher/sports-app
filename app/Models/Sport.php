<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sport extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function position(){
        return $this->hasTo(Position::class);
    }
}
