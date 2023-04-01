<?php

namespace Database\Seeders;

use App\Models\Standard;
use Illuminate\Database\Seeder;

class StandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect();

        for ($i = 1; $i <= 10; $i++) {
            $data->push([
                'name' => "Std {$i}",
                'class_number' => $i,
            ]);
        }

        Standard::factory()->createMany($data);
    }
}
