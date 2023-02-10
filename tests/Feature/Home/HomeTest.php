<?php

namespace Tests\Feature\Home;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page()
    {
        $response = $this->get('/home');

        $response->assertStatus(200);
        $response->assertJson([
            '_token' => csrf_token(),
            'user' => null
        ]);
    }

    public function test_home_page_witn_authenticated_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(RouteServiceProvider::HOME);

        $response->assertOk();
        $response->assertJson([
            '_token' => csrf_token(),
            'user' => json_decode((new UserResource($user))->toJson(), true)
        ]);
    }
}
