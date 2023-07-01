<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    use HasFactory;
    protected $fillable = [
        'service_id',
        'user_id',
        'expert_id',
        'charge_id',
    ];

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
