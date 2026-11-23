<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi@beritakita.id',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'bio' => 'Pemimpin Redaksi BeritaKita. 15 tahun pengalaman di jurnalisme digital.',
        ]);

        // Editor / Author
        $authors = [
            ['Siti Rahma', 'siti@beritakita.id', 'editor', 'Redaktur Pelaksana, fokus teknologi & startup.'],
            ['Budi Santoso', 'budi@beritakita.id', 'author', 'Wartawan olahraga, covering Timnas & liga domestik.'],
            ['Dewi Lestari', 'dewi@beritakita.id', 'author', 'Reporter ekonomi makro & pasar modal.'],
            ['Rizky Pratama', 'rizky@beritakita.id', 'author', 'Koresponden politik & pemerintahan.'],
        ];

        foreach ($authors as $a) {
            User::create([
                'name' => $a[0],
                'email' => $a[1],
                'password' => Hash::make('password'),
                'role' => $a[2],
                'bio' => $a[3],
            ]);
        }
    }
}