<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
          'id' => 1,
          'genre' => 'イタリアン',
        ]);

        Genre::create([
          'id' => 2,
          'genre' => 'ラーメン',
        ]);

        Genre::create([
          'id' => 3,
          'genre' => '居酒屋',
        ]);

        Genre::create([
          'id' => 4,
          'genre' => '寿司',
        ]);

        Genre::create([
          'id' => 5,
          'genre' => '焼肉',
        ]);
    }
}
