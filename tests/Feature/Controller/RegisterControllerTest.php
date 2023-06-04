<?php
namespace Tests\Feature\Controller;

use App\Http\Middleware\Api\AuthenticateClient;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_register_successfullu_as_user()
    {
        $this->withoutMiddleware(AuthenticateClient::class);
        
        $email = 'test@example.com';
        $data = [
            'firstname' => 'Benjamen',
            'lastname' => 'Fash',
            'email' => $email,
            'password' => 'password',
            'confirm_password' => 'password'
        ];

        $response = $this->postJson( route('auth.register'), $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => ['token']
            ]);
        $this->assertDatabaseHas((new User)->getTable(), ['email' => $email, 'is_admin' => false]);
    }


    public function test_user_cannot_register_with_invalid_credentials()
    {
        $this->withoutMiddleware(AuthenticateClient::class);

        $data = [
            'firstname' => 'Benjamen',
            'lastname' => 'Fash',
            'email' => 'test',
            'password' => 'password',
            'confirm_password' => 'password'
        ];

        $response = $this->postJson( route('auth.register'), $data);
        $response->assertStatus(422);
    }

    public function test_user_cannot_register_with_existing_email()
    {
        $this->withoutMiddleware(AuthenticateClient::class);

        $user = User::factory()->create();
        $data = [
            'firstname' => 'Benjamen',
            'lastname' => 'Fash',
            'email' => $user->email,
            'password' => 'password',
            'confirm_password' => 'password'
        ];

        $response = $this->postJson( route('auth.register'), $data);
        $response->assertStatus(422);
    }
}