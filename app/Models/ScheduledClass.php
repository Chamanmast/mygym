<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledClass extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'instructor_id',
        'class_type_id',
        'date_time',
    ];
    public $casts = [
        'date_time' => 'datetime',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
    public function classType()
    {
        return $this->belongsTo(ClassType::class, 'class_type_id');
    }

}
