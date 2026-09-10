<?php

namespace Tests\Feature;

use App\Models\ClassType;
use App\Models\User;
use Database\Seeders\ClassTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstructorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    // public function test_instructor_is_redirected_to_instructor_dashboard(): void
    // {
    //     $user = User::factory()->create([
    //         'role' => 'instructor'
    //     ]);

    //     $response = $this->actingAs($user)
    //         ->get('dashboard');

    //     $response->assertRedirectToRoute('instructor.dashboard');
    // }

    public function test_instructor_can_schedule_a_class(): void
    {
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);
        $this->seed(ClassTypeSeeder::class);
        $response = $this->actingAs($user)
            ->post('instructor/schedule', [
            'class_type_id' => ClassType::first()->id,
            'date' => '2023-04-20',
            'time' => '09:00:00'
        ]);

        $response->assertRedirectToRoute('schedule.index');
    }
}
