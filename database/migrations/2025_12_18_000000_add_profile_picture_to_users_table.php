<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_picture_hd')->nullable()->after('email');
            $table->string('profile_picture_thumbnail')->nullable()->after('profile_picture_hd');
            $table->string('storage_dir')->nullable()->after('profile_picture_thumbnail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_picture_hd');
            $table->dropColumn('profile_picture_thumbnail');
            $table->dropColumn('storage_dir');
        });
    }
};
