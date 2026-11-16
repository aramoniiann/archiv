<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public const DEMO_EMAIL = 'demo@archiv.test';

    public const OTHER_EMAIL = 'other@archiv.test';

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Demo',
            'email' => self::DEMO_EMAIL,
        ]);

        User::factory()->create([
            'name' => 'Other User',
            'email' => self::OTHER_EMAIL,
        ]);
    }
}
