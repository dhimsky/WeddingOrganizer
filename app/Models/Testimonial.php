<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    protected $fillable = ['couple_name','event_date','event_type','testimonial','rating','photo','is_featured','is_active'];
    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean'];
}
