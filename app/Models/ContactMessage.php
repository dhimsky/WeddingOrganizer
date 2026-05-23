<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model {
    protected $fillable = ['name','email','phone','event_type','event_date','budget_range','message','is_read'];
    protected $casts = ['is_read' => 'boolean'];
}
