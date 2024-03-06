<?php

namespace Tests\Unit;

use App\Http\Requests\RegisterUserRequest;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tests\CreatesApplication;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AuthController;


class AuthUnitTest extends TestCase
{
    use CreatesApplication;

    protected $authController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authController = new AuthController();
    }

    public function testUnitLoginWithValidCredentials()
{
    // $user = User::factory()->create([
    //     'name' => 'jean',
    //     'firstName' => 'mendy',
    //     "phone"=>778120200,
    //     'email' => 'mendi@gmail.com',
    //     'isArchived'=>0,
    //     'role_id'=>2,
    //     'email_verified_at' => now(),
    //     'password' => Hash::make('password'),
    //     'remember_token' => Str::random(10),
    // ]);

    $request = new LoginRequest([
        'email' => 'admin@gmail.com',
        'password' => '@zerty123',
    ]);

    $response = $this->authController->login($request);

    $this->assertInstanceOf(JsonResponse::class, $response);

    $responseData = $response->getData(true);
    $this->assertArrayHasKey('access_token', $responseData);
    $this->assertArrayHasKey('token_type', $responseData);
    $this->assertArrayHasKey('expires_in', $responseData);
}

    // public function testLoginWithUserBlocked()
    // {
    //     //Créez un utilisateur avec des identifiants valides
    //      User::factory()->create([
    //         'nom'=> 'heber tochi',
    //         'email' => 'albertine@example.com',
    //         'password' => Hash::make('password123.'),
    //         'telephone'=>'779999912',
    //         'genre' => 'homme',
    //         'role_id' => 3,
    //         'ville_id' => 1,

    //         'is_blocked' => 1,
    //     ]);

    //     // Envoyez une demande de connexion avec les identifiants valides
    //     $request = new LoginRequest([
    //         'email' => 'albertine@example.com',
    //         'password' => 'password123.',
    //     ]);
    //     $response = $this->authController->login($request);

    //     // Assurez-vous que la réponse contient un jeton d'accès
    //     $this->assertInstanceOf(JsonResponse::class, $response);

    //     // Assurez-vous que le code de statut HTTP est 401 (Unauthorized)
    //     $this->assertEquals(404, $response->getStatusCode());
    
    //     // Assurez-vous que la réponse contient le message approprié
    //     $expectedContent = [
    //         'error' => 'Votre compte est bloqué'
    //     ];
    //     $this->assertEquals($expectedContent, json_decode($response->getContent(), true));
    // }




    public function testUnitRegisterUser()
    {
        $storeUserRequest = new RegisterUserRequest([
            'name' => 'jean',
            'firstName' => 'mendy',
            "phone"=>777724477,
            'email' => 'bodian@gmail.com',
            'isArchived'=>0,
            'role_id'=>2,
            'email_verified_at' => now(),
            'password' => '@zerty123', 
            'confirmPassword' => '@zerty123', 
        ]);
    
        $response = $this->authController->register($storeUserRequest);
      
        $this->assertInstanceOf(JsonResponse::class, $response);
    

        if ($response->getStatusCode() == 201) {
            $responseData = $response->getData(true);
            $this->assertArrayHasKey('status_message', $responseData);
            $this->assertEquals('utilisateur ajouté avec succes', $responseData['status_message']);
            $this->assertArrayHasKey('status_body', $responseData);
           
        } else {
           
            $responseData = $response->getData(true);
            $this->assertArrayHasKey('status_message', $responseData);
            $this->assertEquals('Le mot de passe et la confirmation ne correspondent pas.', $responseData['status_message']);
        }
    }
    
    // public function testUnitLogout()
    // {
    //     // Créer un utilisateur fictif
    // $request = new LoginRequest([
    //     'email' => 'admin@gmail.com',
    //     'password' => '@zerty123',
    // ]);
    
    //         $token = auth('api')->login($request);

    //         // Ajouter le jeton JWT à l'en-tête de la requête
    //         $this->withHeader('Authorization', 'Bearer '.$token);
            
    //         // Appeler la méthode de déconnexion
    //         $response = $this->authController->logout();
    
    //     // Vérifier que l'utilisateur est bien déconnecté
    //     $this->assertGuest('api');
    
    //     // Vérifier que la réponse est une instance de JsonResponse
    //     $this->assertInstanceOf(JsonResponse::class, $response);
    
    //     // Vérifier que la réponse contient le message de déconnexion
    //     $responseData = $response->getData(true);
    //     $this->assertEquals('vous êtes déconnecté', $responseData['message']);
    // }
}
