<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'instructor_id',
        'class_type_id',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
    public function scheduled()
    {
       return $this->belongsTo(
        ScheduledClass::class,
        'scheduled_class_id',
        'id'
    );
    }
}
