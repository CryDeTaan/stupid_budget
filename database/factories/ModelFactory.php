<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('111111'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Account::class, function (Faker\Generator $faker) {

    $openingBalance = $faker->numberBetween($min = 1000, $max = 9000);

    return [
        'user_id' => $faker->numberBetween($min = 3, $max = 3),
        'accountName' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'accountDescription' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'accountType' => $faker->randomElement($array = array ('Current','Savings','Cheque')),
        'openingBalance' => $openingBalance,
        'balance' => $openingBalance
    ];

});

$factory->define(App\Expense::class, function (Faker\Generator $faker) {

    return [
        'user_id' => $faker->numberBetween($min = 3, $max = 3),
        'account_id' => $faker->numberBetween($min = 7, $max = 9),
        'category_id' => $faker->numberBetween($min = 11, $max = 15),
        'expenseDescription' => $faker->sentence($nbWords = 1, $variableNbWords = true),
        'amount' => $faker->numberBetween($min = 1000, $max = 9000)

    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {

    return [
        'user_id' => $faker->numberBetween($min = 3, $max = 3),
        'categoryName' => $faker->sentence($nbWords = 1, $variableNbWords = true),
        'subcategoryName' => $faker->sentence($nbWords = 1, $variableNbWords = true),
    ];
});

$factory->define(App\Income::class, function (Faker\Generator $faker) {

    return [
        'user_id' => $faker->numberBetween($min = 3, $max = 3),
        'account_id' => $faker->numberBetween($min = 4, $max = 4),
        'incomeDescription' => $faker->sentence($nbWords = 1, $variableNbWords = true),
        'amount' => $faker->numberBetween($min = 1000, $max = 9000)

    ];
});


