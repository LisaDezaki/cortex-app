<?php

use App\Models\Location;
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
				// Schema::create('species', function (Blueprint $table) {
				// 	$table->id();
				// 	$table->string('name');
				// });

				Schema::create('characters', function (Blueprint $table) {
					$table->id();
					$table->foreignIdFor(Project::class, 'project_id')
							->constrained()
							->cascadeOnUpdate()
							->cascadeOnDelete();
					$table->string('name');
					$table->string('slug')
						->nullable();
					$table->string('alias')
						->nullable();
					$table->string('image')
						->nullable();
					$table->text('description')
						->nullable();
					// $table->foreignId('species');
					$table->string('role')
						->nullable();
					$table->foreignIdFor(Location::class, 'location_id_work')
						->nullable()
						->constrained()
						->cascadeOnUpdate();
					$table->foreignIdFor(Location::class, 'location_id_home')
						->nullable()
						->constrained()
						->cascadeOnUpdate();
					// $table->string('home')
					// 	->nullable();
					// $table->string('work')
					// 	->nullable();
					
					$table->timestamps();
					$table->softDeletes();
				});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('species');
        Schema::dropIfExists('characters');
    }
};
