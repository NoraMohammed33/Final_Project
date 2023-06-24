<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['title', 'price', 'description', 'image', 'expert_id'];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
    public function ratings(){
        return $this->hasMany(ServiceRating::class);
    }



}
