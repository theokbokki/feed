<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(3)->create([
            'created_at' => now()->subDays(15),
        ]);


        Post::factory(7)->create([
            'created_at' => now()->addDays(4),
        ]);

        Post::factory(5)
            ->hasAttachments(1, fn (array $attributes, Post $post) => [
                'post_id' => $post->id,
            ])
            ->create([
                'created_at' => now()->addDays(15),
            ]);

        Post::factory(5)
            ->hasAttachments(3, fn (array $attributes, Post $post) => [
                'post_id' => $post->id,
            ])
            ->create([
                'created_at' => now(),
            ]);
    }
}
