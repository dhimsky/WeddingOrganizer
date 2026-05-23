<?php
// database/migrations/2024_01_01_000001_create_profiles_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->text('tagline')->nullable();
            $table->text('description');
            $table->string('founded_year')->nullable();
            $table->string('logo')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->integer('events_done')->default(0);
            $table->integer('happy_couples')->default(0);
            $table->integer('team_members')->default(0);
            $table->integer('years_experience')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('profiles'); }
};
