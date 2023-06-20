<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    use HasFactory;

    public function users(){
        $this->hasMany(User::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    // public function experts(){
    //     $this->hasMany(Expert::class);
    // }
}
