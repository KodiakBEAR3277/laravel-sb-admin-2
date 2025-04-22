<?php

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
        Schema::table('students', function (Blueprint $table) {
            // Academic Information
            $table->string('StudentNumber')->unique()->after('id');
            $table->string('Course', 100)->nullable();
            $table->integer('YearLevel')->nullable();
            $table->string('Section', 20)->nullable();
            $table->enum('AcademicStatus', ['Regular', 'Irregular', 'LOA', 'Graduated'])->default('Regular');

            // Personal Information
            $table->enum('Gender', ['Male', 'Female', 'Other'])->nullable();
            $table->text('Address')->nullable();
            $table->string('ContactNumber', 20)->nullable();
            $table->string('EmergencyContact', 100)->nullable();
            $table->string('EmergencyContactNumber', 20)->nullable();
            $table->string('Email')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'StudentNumber',
                'Course',
                'YearLevel',
                'Section',
                'AcademicStatus',
                'Gender',
                'Address',
                'ContactNumber',
                'EmergencyContact',
                'EmergencyContactNumber',
                'Email'
            ]);
        });
    }
};
