<?php

use App\Enums\Sample\SampleItemEnumerate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sample_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('string', 255);
            $table->uuid('user_id')->nullable();
            $table->enum('enumerate', SampleItemEnumerate::values())->nullable();
            $table->text('text')->nullable();

            $table->string('email', 255)->nullable();
            $table->string('npwp', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->integer('integer')->nullable();
            $table->decimal('decimal', 10, 2)->nullable();

            $table->dateTime('datetime')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();

            $table->string('ip_address', 255)->nullable();
            $table->boolean('boolean')->nullable();

            $table->text('file')->nullable();
            $table->text('image')->nullable();

            $table->text('markdown_text')->nullable();
            $table->text('wysiwyg')->nullable();

            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->json('json')->nullable();

            $table->foreignUuid('created_by')->nullable()->index();
            $table->foreignUuid('updated_by')->nullable()->index();
            $table->string('storage_dir')->nullable();

            $table->timestamps();

            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_items');
    }
};
