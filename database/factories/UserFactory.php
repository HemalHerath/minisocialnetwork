<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(App\User::class, function (Faker $faker) {
	static $password;
	$name = $faker->name;

	return [
		'name' => $name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'gender' => 0,
		'slug' => str_slug($name),
		'avatar' => 'defaults/avatars/female.png',
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Profile::class, function (Faker $faker) {
	return [
		'location' => $faker->city,
		'about' => $faker->paragraph(4),
	];
});

$factory->define(App\Post::class, function (Faker $faker) {

	return [
		'user_id' => App\User::all()->random()->id,
		'content' => $faker->paragraph(10),
	];
});
