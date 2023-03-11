<?php

use App\Models\Guardian;
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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_number');
            $table->string('relation_type')->index();
            $table->timestamps();
        });

        Schema::create('guardian_student', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(Guardian::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
        Schema::dropIfExists('guardian_student');
    }
};
