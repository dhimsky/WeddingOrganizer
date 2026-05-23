<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model {
    protected $fillable = ['name','logo','website','category','description','is_active','sort_order'];
    protected $casts = ['is_active' => 'boolean'];
}
