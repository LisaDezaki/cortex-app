<?php

use App\Models\Project;
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
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
			$table->foreignIdFor(Project::class, 'project_id')
				->constrained('projects')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->string('table');
			$table->string('type');
			$table->string('name');
			$table->string('placeholder')
				->nullable();
			$table->unique(['project_id','table','name']);
        });

		Schema::create('custom_field_options', function (Blueprint $table) {
			$table->id();
			$table->foreignId('custom_field_id')
				->constrained('custom_fields')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->string('value');
			$table->unique(['custom_field_id', 'value']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_fields');
        Schema::dropIfExists('custom_field_options');
    }
};
