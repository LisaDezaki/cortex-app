<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomField extends Model
{

    use HasFactory;

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */

	 protected $fillable = [
		'name',
		'placeholder',
		'table',
		'type'
	];

	protected $guarded = [
		'project_id'
	];



	/**
	 * Set up relationships.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */

	 public function project()
	 {
		 return $this->belongsTo(Project::class);
	 }

	 public function options()
	 {
		return DB::table('custom_field_options')
			->where('custom_field_id', $this->id);
	 }



}
