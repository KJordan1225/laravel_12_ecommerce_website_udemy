<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY profile_image VARCHAR(255) NULL DEFAULT NULL;");
    }

    public function down(): void
    {
        // Optional: reverse the change if needed
        DB::statement("ALTER TABLE users MODIFY profile_image VARCHAR(255) NOT NULL;");
    }
};

