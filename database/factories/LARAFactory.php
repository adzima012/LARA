<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LARA>
 */
class LARAFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Surat Keluarga',
            'Pesan Terakhir',
            'Surat Bisnis',
            'Pesan untuk Anak-anak',
            'Surat Harta',
            'Pesan Rohani',
            'Surat Pendidikan',
            'Pesan untuk Pasangan',
            'Surat Investasi',
            'Pesan untuk Sahabat',
        ];

        $contents = [
            'Kepada keluarga tercinta, saya berharap kalian tetap bersatu dan saling mendukung satu sama lain.',
            'Anak-anakku yang tercinta, ayah/ibu sangat bangga dengan kalian. Teruslah berjuang dan jangan pernah menyerah.',
            'Untuk rekan bisnis, perusahaan ini harus tetap berjalan sesuai visi yang telah kita bangun bersama.',
            'Sahabatku, terima kasih telah menjadi teman sejati dalam suka dan duka.',
            'Semua harta yang saya miliki akan dibagikan secara adil kepada keluarga.',
            'Jangan pernah lupa untuk selalu berdoa dan mendekatkan diri kepada Tuhan.',
            'Pendidikan adalah investasi terbaik untuk masa depan.',
            'Terima kasih telah menjadi pasangan hidup yang luar biasa.',
            'Investasi yang telah saya lakukan harus dikelola dengan bijak.',
            'Jangan pernah lupa kenangan indah yang telah kita lewati bersama.',
        ];

        return [
            'title' => fake()->randomElement($titles),
            'content' => fake()->randomElement($contents) . ' ' . fake()->paragraph(),
            'file_path' => fake()->optional(0.3)->filePath(), // 30% chance of having a file
            'image_path' => fake()->optional(0.4)->randomElement([
                'will-images/sample1.jpg',
                'will-images/sample2.jpg',
                'will-images/sample3.jpg',
            ]), // 40% chance of having an image
            'pemilik_id' => User::factory(),
            'recipient_email' => fake()->email(),
            'is_released' => fake()->boolean(20), // 20% chance of being released
        ];
    }

    /**
     * Indicate that the will is released.
     */
    public function released(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_released' => true,
        ]);
    }

    /**
     * Indicate that the will is not released.
     */
    public function unreleased(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_released' => false,
        ]);
    }
}
