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


    public function test_store_bien()
    {
        Storage::fake('public');
        $imageFile = UploadedFile::fake()->image('test_image.jpg');

        $user = user::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $bien = [
            "libelle" => "ftfy",
            "lieu" => "hvdjhv",
            "description" => "gfhgfgv",
            "date" => "2023-01-14",
            "categorie_id" => 2,
            'image' => [$imageFile],
            "statut" => "en attente",
            "user_id" => 15,
            "rendu" => 0
        ];

        $response = $this->post('/api/biens/store', $bien);
        $response->assertStatus(200);

    }

    public function test_liste_biens_acceptes()
    {
        $user = user::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('api/biens/index/4');
        $response->assertStatus(200);
    }

    public function test_biens_show()
    {

        $user = user::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('api/biens/23/show');
        $response->assertStatus(200);
    }

    // public function test_biens_update()
    // {

    //     $user = User::factory()->create();
    //     $this->actingAs($user);

    //     $newbien = [
    //         "libelle"=>"ftfy",
    //         "lieu"=>"hvdjhv",
    //         "description"=>"gfhgfgv",
    //         "date"=>"2023-01-14",
    //         "categorie_id"=>2,
    //         "statut"=>"en attente",
    //         "user_id"=>15,
    //         "rendu"=>0
    //     ];
    //     // var_dump($newbien);
    //     $response = $this->post("/api/biens/23/update", $newbien);
    //     $response->assertStatus(200)->json();
    // }


    //     public function test_store_bien_basse()
//     {
//         Storage::fake('public');
//         $imageFile = UploadedFile::fake()->image('test_image.jpg');

    //         $user = user::factory()->create();
//         $response = $this->post('/api/login', [
//             'email' => $user->email,
//             'password' => 'password',
//         ]);
//         $response = $this->put('/api/biens/24/update',[
//             "libelle"=>"ftfy",
//             "lieu"=>"hvdjhv",
//             "description"=>"gfhgfgv",
//             "date"=>"2023-01-14",
//             "categorie_id"=>2,
//             // 'image' => [$imageFile],
//             "statut"=>"en attente",
//             // "user_id"=>15,
//             "rendu"=>0
//         ]);
//         $response->assertStatus(200);

    //     }
//  }

    public function test_destroy_bien()
    {
        $user = user::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $bien = Bien::factory()->create();

        $response = $this->delete("/api/biens/{$bien->id}/destroy");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('biens', ['id' => $bien->id]);
    }

    public function test_accepter_bien()
    {
        $user = user::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $bien = Bien::factory()->create();

        $response = $this->post("/api/biens/{$bien->id}/accepte");

        $bien->refresh();

        $response->assertStatus(200);

        $this->assertEquals('accepte', $bien->statut);

        $response->assertJson([
            'status code' => 200,
            'status message' => 'Le bien a été validé',
        ]);
    }

    public function test_refuser_bien()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $bien = Bien::factory()->create();

        $response = $this->post("/api/biens/{$bien->id}/refuse");

        $bien->refresh();

        $response->assertStatus(200);

        $this->assertEquals('refuse', $bien->statut);

    }

    public function test_rendre_bien_en_tant_que_non_proprietaire()
    {
        $user = User::factory()->create();
        $autreUtilisateur = User::factory()->create();

        $bien = Bien::factory()->create(['user_id' => $autreUtilisateur->id]);

        $this->actingAs($user);

        $response = $this->post("/api/biens/{$bien->id}/rendreBien");

        $bien->refresh();

        $response->assertStatus(200);

        $this->assertEquals(0, $bien->rendu);


    }

    public function test_rendre_bien_en_tant_que_proprietaire()
    {
        $user = User::factory()->create();
        $bien = Bien::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->post("/api/biens/{$bien->id}/rendreBien");

        $bien->refresh();

        $response->assertStatus(200);

        $this->assertEquals(1, $bien->rendu);


    }


}

