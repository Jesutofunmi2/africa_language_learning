<?php
namespace Tests\Feature\Controller;

use App\Http\Middleware\Api\AuthenticateClient;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ActivityControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_personal_activities()
    {
        $this->withoutMiddleware(AuthenticateClient::class);

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $count = 5;

        Activity::factory()->count($count)->create([
            'user_id' => $user
        ]);
       
        $response = $this->getJson( route('activity.activities'));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data'
            ])
            ->assertJsonCount($count, 'data');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_personal_and_global_activities()
    {
        $this->withoutMiddleware(AuthenticateClient::class);

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $personal_count = 5;
        $global_count = 2;
        $total_count = $personal_count + $global_count;

        Activity::factory()->count($personal_count)->create([
            'user_id' => $user
        ]);


        Activity::factory()->count($global_count)->global()->create([
            'user_id' => null
        ]);
       
        $response = $this->getJson( route('activity.activities'));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data'
            ])
            ->assertJsonCount($total_count, 'data');
    }
}