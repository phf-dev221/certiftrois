<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;
use App\Models\User;
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

    public function test_users_login(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);

    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->post('/api/logout');
        $this->assertGuest();
        $response->assertStatus(200);
    }


    public function test_archive_user()
    {
        $user = user::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->put("/api/archive{$user->id}");

        $user->refresh();
        $response->assertStatus(200);
    }

    public function test_users_archives(){
        $user = user::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/api/users/archives');
        $response->assertStatus(200);

    }

    public function test_users_nonarchives(){
        $user = user::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/api/users/nonArchives');
        $response->assertStatus(200);

    }


}