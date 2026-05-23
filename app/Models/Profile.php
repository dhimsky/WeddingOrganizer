<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
    protected $fillable = ['company_name','tagline','description','founded_year','logo','hero_image','phone','email','address','instagram','facebook','whatsapp','tiktok','youtube','events_done','happy_couples','team_members','years_experience'];
}
