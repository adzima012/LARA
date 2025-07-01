<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LARA;

class LARASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some dummy users first
        $users = User::factory(10)->create();

        // Create LARA records with different scenarios
        $laras = [
            [
                'title' => 'Wasiat Keluarga',
                'content' => 'Kepada keluarga tercinta, saya berharap kalian tetap bersatu dan saling mendukung satu sama lain. Jangan pernah lupa nilai-nilai yang telah kita tanamkan bersama.',
                'pemilik_id' => $users->random()->id,
                'penerima_id' => $users->random()->id,
                'is_released' => false,
            ],
            [
                'title' => 'Pesan Terakhir untuk Anak-anak',
                'content' => 'Anak-anakku yang tercinta, ayah/ibu sangat bangga dengan kalian. Teruslah berjuang dan jangan pernah menyerah dalam mencapai impian kalian.',
                'pemilik_id' => $users->random()->id,
                'penerima_id' => $users->random()->id,
                'is_released' => true,
            ],
            [
                'title' => 'Wasiat Bisnis',
                'content' => 'Untuk rekan bisnis, perusahaan ini harus tetap berjalan sesuai visi yang telah kita bangun bersama. Pertahankan kepercayaan pelanggan dan kesejahteraan karyawan.',
                'pemilik_id' => $users->random()->id,
                'penerima_id' => $users->random()->id,
                'is_released' => false,
            ],
            [
                'title' => 'Pesan untuk Sahabat',
                'content' => 'Sahabatku, terima kasih telah menjadi teman sejati dalam suka dan duka. Jangan pernah lupa kenangan indah yang telah kita lewati bersama.',
                'pemilik_id' => $users->random()->id,
                'penerima_id' => $users->random()->id,
                'is_released' => false,
            ],
            [
                'title' => 'Wasiat Harta',
                'content' => 'Semua harta yang saya miliki akan dibagikan secara adil kepada keluarga. Pastikan setiap orang mendapat bagian yang sesuai dengan kebutuhan mereka.',
                'pemilik_id' => $users->random()->id,
                'penerima_id' => $users->random()->id,
                'is_released' => true,
            ],
            [
                'title' => 'Pesan Rohani',
                'content' => 'Jangan pernah lupa untuk selalu berdoa dan mendekatkan diri kepada Tuhan. Iman adalah fondasi terkuat dalam menghadapi segala cobaan hidup.',
                'pemilik_id' => $users->random()->id,
                'penerima_id' => $users->random()->id,
                'is_released' => false,
            ],
            [
                'title' => 'Wasiat Pendidikan',
                'content' => 'Pendidikan adalah investasi terbaik untuk masa depan. Pastikan anak-anak mendapatkan pendidikan terbaik yang bisa kalian berikan.',
                'pemilik_id' => $users->random()->id,
                'penerima_id' => $users->random()->id,
                'is_released' => false,
            ],
            [
                'title' => 'Pesan untuk Pasangan',
                'content' => 'Terima kasih telah menjadi pasangan hidup yang luar biasa. Semoga kalian menemukan kebahagiaan baru dan tidak pernah melupakan cinta yang telah kita bangun.',
                'pemilik_id' => $users->random()->id,
                'penerima_id' => $users->random()->id,
                'is_released' => true,
            ],
        ];

        foreach ($laras as $lara) {
            LARA::create($lara);
        }

        // Create additional random LARA records
        for ($i = 0; $i < 10; $i++) {
            LARA::create([
                'title' => fake()->sentence(3),
                'content' => fake()->paragraph(3),
                'pemilik_id' => $users->random()->id,
                'penerima_id' => $users->random()->id,
                'is_released' => fake()->boolean(20), // 20% chance of being released
            ]);
        }
    }
}
