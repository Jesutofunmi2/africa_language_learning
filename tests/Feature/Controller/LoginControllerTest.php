<?php
namespace Tests\Feature\Controller;

use App\Http\Middleware\Api\AuthenticateClient;
use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_school_can_login_successful()
    {
        $this->withoutMiddleware(AuthenticateClient::class);

        $user = School::factory()->create();
        $data = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->postJson( route('auth.login'), $data);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['token']
            ]);
    }

    public function test_school_cannot_login_with_invalid_credentials()
    {
        $this->withoutMiddleware(AuthenticateClient::class);

        $user = School::factory()->create();
        $data = [
            'email' => $user->email,
            'password' => 'fakepassword'
        ];

        $response = $this->postJson( route('auth.login'), $data);
        $response->assertStatus(401);
    }
}