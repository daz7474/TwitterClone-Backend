<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tweet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com'
        ]);

        User::factory(99)
            ->sequence(fn ($sequence) => ['name' => 'Person ' . $sequence->index + 2])
            ->create();

        foreach (range(1, 20) as $user_id) {
            Tweet::factory()
                ->create(['user_id' => $user_id]);

            foreach (range(1, 20) as $user_id2) {
                User::find($user_id)
                    ->follows()
                    ->attach(User::find($user_id2));
            }
        }
    }
}
