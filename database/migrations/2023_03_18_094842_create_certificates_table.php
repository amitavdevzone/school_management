<?php

use App\Models\Certificate;
use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->boolean('is_active')->default(1)->index();
            $table->string('certificate_image')->nullable();
            $table->string('original_filename')->nullable();
            $table->timestamps();
        });

        Schema::create('certificate_student', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->index();
            $table->foreignIdFor(Certificate::class)->index();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('certificate_student');
    }
};
