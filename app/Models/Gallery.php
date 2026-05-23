<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {
    protected $fillable = ['title','description','file_path','file_type','thumbnail','category','is_featured','is_active','sort_order'];
    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean'];
}
