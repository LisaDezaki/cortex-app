<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{

	use HasFactory, Sluggable, SoftDeletes;



	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */

	protected $fillable = [
		'name',
		'alias',
		'description',
		'role',
		'location_id_home',
		'location_id_work',
		'image'
	];



	/**
	 * The attributes that should not be mass assignable.
	 *
	 * @var array<int, string>
	 */

	protected $guarded = [
		'project_id'
	];



	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */

	protected $casts = [
		'name' => 'string',
		'role' => 'string'
	];



	/**
	 * Set up character relationships.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */

	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	public function factions()
	{
		return $this->belongsToMany(Faction::class)
			->withPivot('role');
	}

	public function work()
    {
        return $this->belongsTo(Location::class, 'location_id_work');
    }

    public function home()
    {
        return $this->belongsTo(Location::class, 'location_id_home');
    }

	// public function locations()
	// {
	// 	return $this->belongsToMany(Location::class);
	// }



	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */

	public function sluggable(): array
	{
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}



	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return string
	 */

	public function getRouteKeyName(): string
	{
		return 'slug';
	}
}
