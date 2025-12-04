<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            // Kolom baru
            $table->string('nik')->unique(); 
            $table->string('visitor_name');
            $table->string('person_visited_name');
            
            $table->date('visit_date');
            $table->timestamps();
        });
        Schema::table('visitors', function (Blueprint $table) {
            // Tambahkan kolom untuk menyimpan nomor antrian
            $table->unsignedInteger('queue_number')->nullable()->after('visit_date');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};