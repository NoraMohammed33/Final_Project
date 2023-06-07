<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['title', 'price', 'description', 'image', 'expert_id'];

    public function Contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }



}
