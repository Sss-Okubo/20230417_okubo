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
        //1
        $param = [
            'genre_name' => '寿司',
        ];
        Genre::create($param);
        //2
        $param = [
            'genre_name' => '焼肉',
        ];
        Genre::create($param);
        //3
        $param = [
            'genre_name' => '居酒屋',
        ];
        Genre::create($param);
        //4
        $param = [
            'genre_name' => 'イタリアン',
        ];
        Genre::create($param);
        //5
        $param = [
            'genre_name' => 'ラーメン',
        ];
        Genre::create($param);
    }
}
