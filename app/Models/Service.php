<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model {
    protected $fillable = ['name','slug','short_description','description','icon','image','price_start','price_end','is_featured','is_active','sort_order','features'];
    protected $casts = ['features' => 'array', 'is_featured' => 'boolean', 'is_active' => 'boolean'];
}
