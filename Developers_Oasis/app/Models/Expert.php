<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $fillable = [ 'bio', 'dept_id', 'user_id'];
    public function Contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
