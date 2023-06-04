<?php
namespace Tests\Feature\Controller;

use App\Http\Middleware\Api\AuthenticateClient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_logout_successful()
    {
        $this->withoutMiddleware(AuthenticateClient::class);

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson( route('auth.logout'));
        $response->assertStatus(200);
    }
}