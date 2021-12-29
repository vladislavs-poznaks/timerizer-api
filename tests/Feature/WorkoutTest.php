<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\TestCase;

class WorkoutTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Passport::actingAs($this->user);
    }

    /** @test */
    public function it_returns_a_single_instance_of_a_workout()
    {
        $workout = Workout::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this
            ->followingRedirects()
            ->get(route('workouts.show', $workout))
            ->assertJsonFragment([
                'title' => $workout->title,
                'description' => $workout->description,
                'public' => $workout->public,
            ])
            ->assertStatus(Response::HTTP_OK);
    }

//    /** @test */
//    public function it_stores_a_workout()
//    {
////        $attributes = Workout::factory()->raw();
//
//        $this
//            ->followingRedirects()
//            ->post(route('workouts.store'), ['title' => 'some'])
//            ->assertStatus(Response::HTTP_CREATED);
//
//        $this->assertDatabaseHas('workouts', [
//            'title' => 'TEST',
//            'description' => 'TEST',
//        ]);
//    }
//
//    /** @test */
//    public function guest_cannot_create_a_workout()
//    {
//        $this->assertGuest();
//
//        $attributes = Workout::factory()->raw();
//
//        $this
//            ->post(route('workouts.store'), $attributes)
//            ->assertRedirect(route('login'));
//
//        $this->assertDatabaseMissing('workouts', [
//            'title' => $attributes['title'],
//            'description' => $attributes['description'],
//        ]);
//    }
//
//    /** @test */
//    public function workout_title_is_required()
//    {
//        $attributes = [
//            'description' => 'some'
//        ];
//
//        $this
//            ->actingAs($this->user)
//            ->followingRedirects()
//            ->post(route('workouts.store'), $attributes)
//            ->assertInertia(fn(Assert $page) => $page->has('errors', 1));
//
//        $this->assertDatabaseMissing('workouts', $attributes);
//    }
//
//    /** @test */
//    public function workout_description_and_public_attribute_are_optional()
//    {
//        $attributes = [
//            'title' => 'some'
//        ];
//
//        $this
//            ->actingAs($this->user)
//            ->followingRedirects()
//            ->post(route('workouts.store'), $attributes)
//            ->assertStatus(Response::HTTP_OK);
//
//        $this->assertDatabaseHas('workouts', $attributes);
//    }
}
