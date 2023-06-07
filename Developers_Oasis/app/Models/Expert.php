<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $table = 'experts';

    protected $fillable = ['dept_id', 'bio', 'user_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
