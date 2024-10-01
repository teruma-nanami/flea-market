<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'title',
		'description',
		'price',
		'category_id',
		'image_url',
		'is_sold',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function favorites()
	{
		return $this->hasMany(Favorite::class);
	}
	// public function favoritedBy()
	// {
	// 	return $this->belongsToMany(User::class, 'favorites');
	// }
}
