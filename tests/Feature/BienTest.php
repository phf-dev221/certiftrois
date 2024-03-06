<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Bien;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class BienTest extends TestCase
{
    /**
     * A basic feature test example.
     */


    public function test_store_bien_with_image()
    {
        $user = User::factory()->create();
        Storage::fake('public');


        $image = UploadedFile::fake()->image('test_image.jpg');

        $data = [
            'libelle' => 'sacoche',
            'description' => 'description',
            'date' => "2023/12/12",
            'lieu' => 'malika',
            'type_bien' => "bien perdu",
            'categorie_id' => 8,
            'image' => $image,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/biens/store', $data);

        $response->assertStatus(201);

    }

    public function test_store_bien_without_image()
    {
        $user = User::factory()->create();

        $data = [
            'libelle' => 'sacoche',
            'description' => 'description',
            'date' => "2023/12/12",
            'lieu' => 'malika',
            'type_bien' => "bien perdu",
            'categorie_id' => 8
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/biens/store', $data);

        $response->assertStatus(201);

    }

    public function test_liste_biens_attente()
    {

        $response = $this->get('api/biens/listeBiensTousType');
        $response->assertStatus(200);
    }

    public function test_biens_show()
    {

        $bien = Bien::factory()->create();


        $response = $this->get("api/biens/show/{$bien->id}");
        $response->assertStatus(200);
    }

    public function test_destroy_bien()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $bien = Bien::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/api/biens/destroy/{$bien->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('biens', ['id' => $bien->id]);
    }


    // public function test_accepter_bien()
    // {
    //     $user = user::factory()->create();
    //     $response = $this->post('/api/login', [
    //         'email' => $user->email,
    //         'password' => 'password',
    //     ]);

    //     $bien = Bien::factory()->create(['user_id' => $user->id]);

    //     $response = $this->post("/api/biens/accepte/{$bien->id}");

    //     $bien->refresh();

    //     $response->assertStatus(200);

    //     $this->assertEquals('accepte', $bien->statut);

    //     $response->assertJson([
    //         'status code' => 200,
    //         'status message' => 'Le bien a été validé',
    //     ]);
    // }

    public function test_refuser_bien()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $bien = Bien::factory()->create(['user_id' => $user->id]);

        $response = $this->post("/api/biens/refuse/{$bien->id}");

        $bien->refresh();

        $response->assertStatus(200);

        $this->assertEquals('refuse', $bien->statut);

    }


}

