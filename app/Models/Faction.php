<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Faction extends Model
{
    use HasFactory, Sluggable, SoftDeletes;



	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */

	protected $fillable = [
		'image',
		'name',
		'description'
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
	 * Set up project relationships.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */

	public function project(): BelongsTo
	{
		return $this->belongsTo(Project::class);
	}

	public function members(): BelongsToMany
	{
		return $this->belongsToMany(Character::class)
			->withPivot('role');
	}

	public function territory(): BelongsToMany
	{
		return $this->belongsToMany(Location::class);
	}
	// public function territory(): HasMany
	// {
	// 	return $this->HasMany(Location::class);
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

	public function getRouteKeyName()
	{
		return 'slug';
	}
}
