<?php

namespace Database\Seeders;

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
        // Seeders français pour BiblioTech
        $this->call([
            LivreSeeder::class,
        ]);

        // Utilisateur de test français
        User::factory()->create([
            'name' => 'Administrateur BiblioTech',
            'email' => 'admin@bibliotech.fr',
        ]);
    }
}
