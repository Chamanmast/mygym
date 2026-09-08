<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Boxing',
                'description' => 'Boxing training',
                'minutes' => 60,
            ],
            [
                'name' => 'Yoga',
                'description' => 'Yoga and stretching',
                'minutes' => 45,
            ],
            [
                'name' => 'Swimming',
                'description' => 'Swimming training',
                'minutes' => 60,
            ],
            [
                'name' => 'Running',
                'description' => 'Running workout',
                'minutes' => 30,
            ],
            [
                'name' => 'Cycling',
                'description' => 'Cycling workout',
                'minutes' => 45,
            ],
            [
                'name' => 'Weight Training',
                'description' => 'Strength and weight training',
                'minutes' => 60,
            ],
            [
                'name' => 'CrossFit',
                'description' => 'High intensity functional training',
                'minutes' => 60,
            ],
            [
                'name' => 'Zumba',
                'description' => 'Dance fitness workout',
                'minutes' => 45,
            ],
            [
                'name' => 'Pilates',
                'description' => 'Core and flexibility training',
                'minutes' => 45,
            ],
            [
                'name' => 'Kickboxing',
                'description' => 'Kickboxing training',
                'minutes' => 60,
            ],
            [
                'name' => 'Aerobics',
                'description' => 'Cardio fitness workout',
                'minutes' => 40,
            ],
            [
                'name' => 'Stretching',
                'description' => 'Flexibility and recovery',
                'minutes' => 30,
            ],
        ];
        ClassType::insert($data);
    }
}
