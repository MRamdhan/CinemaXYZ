<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Purchase;
use App\Models\PurchaseTicket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::Create([
            'name' => 'kasir1',
            'username' => 'kasir1',
            'password' => bcrypt('1'),
            'role' => 'kasir'
        ]);
        $user = User::Create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('1'),
            'role' => 'admin'
        ]);
        $user = User::Create([
            'name' => 'owner',
            'username' => 'owner',
            'password' => bcrypt('1'),
            'role' => 'owner'
        ]);

        Genre::create([
            'name' => 'Horor'
        ]);
        Genre::create([
            'name' => 'Adventure'
        ]);
        Genre::create([
            'name' => 'Action'
        ]);
        Genre::create([
            'name' => 'Music'
        ]);
        Genre::create([
            'name' => 'Comedy'
        ]);
        Genre::create([
            'name' => 'fantasy'
        ]);


        Movie::create([
            'name' => 'KKN Di Desa Penari',
            'genre_id' => 1,
            'image' => 'https://risetcdn.jatimtimes.com/images/2020/01/22/KKN-di-Desa-Penari-Akan-Tayang-di-Bioskop-Tonton-Teasernya-di-Sini6a02a6dbb0f0dc82.jpg',
            'minutes' => '130',
            'director' => 'asdds',
            'studio_name' => 'Anggrek',
            'studio_capacity' => '96',
            'status' => 'upComing',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam egestas et arcu non euismod. Aliquam luctus eleifend erat, eget suscipit ligula commodo id. Praesent accumsan ante a eleifend viverra. In placerat elit nec risus dignissim auctor. Sed tellus est, placerat vitae scelerisque non, sollicitudin non risus. Nulla in dui sed magna tempor vestibulum non a massa. Praesent consequat nibh auctor dolor sagittis, ac eleifend felis imperdiet. Nulla facilisi. Sed sed maximus nibh,'
        ]);
        Movie::create([
            'name' => 'Jujutsu Kaisen 0',
            'genre_id' => 3,
            'image' => 'img/JJK 0.jpg',
            'minutes' => '105',
            'director' => 'Gege Akutami',
            'studio_name' => 'MAPPA',
            'studio_capacity' => '96',
            'status' => 'onGoing',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam egestas et arcu non euismod. Aliquam luctus eleifend erat, eget suscipit ligula commodo id. Praesent accumsan ante a eleifend viverra. In placerat elit nec risus dignissim auctor. Sed tellus est, placerat vitae scelerisque non, sollicitudin non risus. Nulla in dui sed magna tempor vestibulum non a massa. Praesent consequat nibh auctor dolor sagittis, ac eleifend felis imperdiet. Nulla facilisi. Sed sed maximus nibh,'
        ]);
        Movie::create([
            'name' => 'Spy x Family Code White',
            'genre_id' => 5,
            'image' => 'img/anya.jpg',
            'minutes' => '120',
            'director' => 'Takashi Katagiri',
            'studio_name' => 'WIT Studio & Clover Works',
            'studio_capacity' => '96',
            'status' => 'onGoing',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam egestas et arcu non euismod. Aliquam luctus eleifend erat, eget suscipit ligula commodo id. Praesent accumsan ante a eleifend viverra. In placerat elit nec risus dignissim auctor. Sed tellus est, placerat vitae scelerisque non, sollicitudin non risus. Nulla in dui sed magna tempor vestibulum non a massa. Praesent consequat nibh auctor dolor sagittis, ac eleifend felis imperdiet. Nulla facilisi. Sed sed maximus nibh,'
        ]);
        Movie::create([
            'name' => 'One Piece Film: Red',
            'genre_id' => 2,
            'image' => 'img/1pis.webp',
            'minutes' => '120',
            'director' => 'Oda Sensei',
            'studio_name' => 'TOEI Animation',
            'studio_capacity' => '96',
            'status' => 'onGoing',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam egestas et arcu non euismod. Aliquam luctus eleifend erat, eget suscipit ligula commodo id. Praesent accumsan ante a eleifend viverra. In placerat elit nec risus dignissim auctor. Sed tellus est, placerat vitae scelerisque non, sollicitudin non risus. Nulla in dui sed magna tempor vestibulum non a massa. Praesent consequat nibh auctor dolor sagittis, ac eleifend felis imperdiet. Nulla facilisi. Sed sed maximus nibh,'
        ]);

        Purchase::create([
            'movie_id' => 1,
            'date' => '2022-05-24',
            'time' => '13.00',
            'total' => 104000,
            'cash' => 105000
        ]);
        PurchaseTicket::create([
            'purchase_id' => 1,
            'seat' => 'E05',
            'code' => 'D6uY3D',
        ]);
    }
}
