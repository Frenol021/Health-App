<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'enrollments');
    }
}
