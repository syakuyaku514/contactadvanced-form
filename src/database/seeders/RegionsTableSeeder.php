<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create([
          'id' => 1,
          'region' => '大阪府',
        ]);

        Region::create([
          'id' => 2,
          'region' => '東京都',
        ]);

        Region::create([
          'id' => 3,
          'region' => '福岡県',
        ]);
    }
}
