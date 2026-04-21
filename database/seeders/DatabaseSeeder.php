<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Loom',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminadmin'),
            'is_admin' => true,
        ]);

        $imad = User::create([
            'first_name' => 'Imad',
            'last_name' => 'Elmasoudy',
            'email' => 'imad@example.com',
            'password' => Hash::make('imadimad'),
            'is_admin' => false,
        ]);

        Category::insert([
            ['name' => 'Electronics'],
            ['name' => 'Vehicles'],
            ['name' => 'Real Estate'],
            ['name' => 'Home & Furniture'],
            ['name' => 'Fashion & Style'],
            ['name' => 'Sports & Outdoors'],
        ]);

        // Get all available images from storage to pick randomly
        $availableImages = \Illuminate\Support\Facades\Storage::disk('public')->files('annonces');

        // Create 5 Annonces (Posts) for Imad
        for ($i = 1; $i <= 5; $i++) {
            $annonce = \App\Models\Annonce::create([
                'title' => 'Imad Product '.$i,
                'description' => 'This is a great product posted by Imad. It has high quality and is available now.',
                'price' => rand(100, 1000).'.00',
                'location' => 'Casablanca, Morocco',
                'status' => 'active',
                'user_id' => $imad->id,
                'category_id' => rand(1, 6),
            ]);

            // Add 1 to 3 random images if any exist in storage
            if (! empty($availableImages)) {
                $imageCount = rand(1, 3);
                $randomImages = array_rand(array_flip($availableImages), min($imageCount, count($availableImages)));
                foreach ((array) $randomImages as $imagePath) {
                    \App\Models\Image::create([
                        'annonce_id' => $annonce->id,
                        'file_path' => $imagePath,
                    ]);
                }
            }
        }

        // Create 4 Annonces (Posts) for Admin
        for ($i = 1; $i <= 4; $i++) {
            $annonce = \App\Models\Annonce::create([
                'title' => 'Admin Premium Item '.$i,
                'description' => 'A special premium item listed by the platform administrator.',
                'price' => rand(500, 5000).'.00',
                'location' => 'Rabat, Morocco',
                'status' => 'active',
                'user_id' => $admin->id,
                'category_id' => rand(1, 6),
            ]);

            if (! empty($availableImages)) {
                $imageCount = rand(1, 3);
                $randomImages = array_rand(array_flip($availableImages), min($imageCount, count($availableImages)));
                foreach ((array) $randomImages as $imagePath) {
                    \App\Models\Image::create([
                        'annonce_id' => $annonce->id,
                        'file_path' => $imagePath,
                    ]);
                }
            }
        }
    }
}
