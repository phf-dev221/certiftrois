<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    public function test_store_user()
    {

        $user = [
            "name" => "sow",
            "firstName" => "assane",
            "phone" => 701854665,
            "email" => "sow@gmail.com",
            "password" => "@zerty123",
            "confirmPassword" => "@zerty123"
        ];
        

        $response = $this->postJson('/api/register', $user);
        $response->assertStatus(200);

    }

    // public function test_users_login(): void
    // {
    //     {
    //         $user = User::factory()->create([
    //             'email' => 'djigoo@example.com',
    //             'password' => bcrypt('@zety123'), 
    //         ]);
    
    //         $response = $this->postJson('/api/login', [
    //             'email' => 'djigoo@example.com',
    //             'password' => '@zety123',
    //         ]);
    //         $response->assertStatus(Response::HTTP_OK);
    //         $response->assertJsonStructure(['access_token']);
    //         $responseData = $response->json();
    //         $this->assertNotEmpty($responseData['access_token']);
    //     }
    // }

    // public function test_user_can_logout()
    // {
    //     $user = User::factory()->create([
    //         'email' => 'djigoo@example.com',
    //         'password' => bcrypt('@zety123'), 
    //     ]);
    //     $response = $this->post('/api/login', [
    //         'email' => $user->email,
    //         'password' => '@zerty123',
    //     ]);
    //     $response = $this->post('/api/logout');
    //     $this->assertGuest();
    //     $response->assertStatus(200);
    // }


    public function test_users_archives(){
        $user = user::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson("/api/users/archives");

        $response->assertStatus(Response::HTTP_OK);

    }

    public function test_users_nonarchives(){
        $user = user::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson("/api/users/nonArchives");

        $response->assertStatus(Response::HTTP_OK);

    }


}