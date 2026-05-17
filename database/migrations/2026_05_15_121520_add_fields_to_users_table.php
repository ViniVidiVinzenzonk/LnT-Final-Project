<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // tambahin kolom yang kurang di users
            $table->string('nama_lengkap')->after('id');
            $table->string('no_hp')->after('email');
            $table->string('role')->default('user')->after('no_hp'); // 'user' atau 'admin'
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama_lengkap', 'no_hp', 'role']);
        });
    }
};