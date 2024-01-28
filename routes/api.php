<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\SouscrisController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PubliciteController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\ForgotPasswordController;

/*routes pour l'administrateurs seulement*/

Route::middleware(['auth:api', 'admin'])->group(function () {
    /**biens */
    Route::delete('biens/destroy/{bien}', [BienController::class, 'destroy']);
    Route::post('biens/accepte/{bien}', [BienController::class, 'acceptBien']);
    Route::post('biens/refuse/{bien}', [BienController::class, 'refuseBien']);

    /*demandes publicites*/
    Route::post('demandes/accept/{demande}', [DemandeController::class, 'accept']);
    Route::post('demandes/refuse/{demande}', [DemandeController::class, 'refuse']);
    Route::get('demandes/acceptedDemande', [DemandeController::class, 'acceptedDemande']);
    Route::get('demandes/refusedDemande', [DemandeController::class, 'refusedDemande']);
    Route::get('demandes/index', [DemandeController::class, 'index']);

    /*publicités*/
    Route::post('pubs/update/{publicite}', [PubliciteController::class, 'update']);
    Route::post('pubs/destroy/{publicite}', [PubliciteController::class, 'destroy']);
    Route::post('pubs/invalide/{publicite}', [PubliciteController::class, 'invalidPub']);
    Route::post('pubs/store', [PubliciteController::class, 'store']);

    /*catégories de biens*/
    Route::post('categories/update/{categorie}', [CategorieController::class, 'update']);
    Route::post('categories/destroy/{categorie}', [CategorieController::class, 'destroy']);
    Route::post('categories/store', [CategorieController::class, 'store']);
    Route::get('categories/index', [CategorieController::class, 'index']);

    /*contacts*/
    Route::get('contacts/index', [ContactController::class, 'index']);
    Route::get('contacts/show/{contact}', [ContactController::class, 'show']);
    Route::delete('contacts/destroy/{contact}', [ContactController::class, 'destroy']);


    /*temoignages*/
    Route::post('temoignages/accept/{temoignage}', [TemoignageController::class, 'accept']);

    /*utilisateurs*/
    Route::get('users/index', [AuthController::class, 'index']);
    Route::put('/archive{user}', [AuthController::class, 'archive']);
    Route::get('users/archives', [AuthController::class, 'userArchive']);
    Route::get('users/nonArchives', [AuthController::class, 'userNonArchive']);

    Route::post('news', [SouscrisController::class, 'newsletter']);
});

Route::middleware('auth:api')->group(function () {

    Route::post('biens/store', [BienController::class, 'store']);
    Route::get('biens/bienUser', [BienController::class, 'bienUser']);
    Route::post('biens/update/{bien}', [BienController::class, 'update']);
    Route::post('biens/rendreBien/{bien}', [BienController::class, 'rendreBien']);

    Route::post('demandes/store', [DemandeController::class, 'store']);
    Route::post('demandes/update/{demande}', [DemandeController::class, 'update']);
    Route::get('demandes/show/{demande}', [DemandeController::class, 'show']);
    Route::get('demandes/indexUser', [DemandeController::class, 'indexUser']);
    Route::delete('demandes/destroy/{demande}', [DemandeController::class, 'destroy']);

    Route::post('contacts/store', [ContactController::class, 'store']);

    Route::post('temoignages/store', [TemoignageController::class, 'store']);

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('users/update/{user}', [AuthController::class, 'update']);
    Route::get('users/show/{user}', [AuthController::class, 'show']);
    Route::post('users/whatsapp/{user}', [AuthController::class, 'sendWhatsapp'])->name('whatsapp');
});

/*routes pour biens*/
Route::get('biens/index/{categorie}', [BienController::class, 'index']);
Route::get('biens/show/{bien}', [BienController::class, 'show']);

/*routes pour pub */
Route::get('pubs/index', [PubliciteController::class, 'index']);
Route::get('pubs/show/{publicite}', [PubliciteController::class, 'show']);

/*routes pour contact*/
// Route::post('contacts/{contact}/update', [ContactController::class, 'update']);

/*routes pour temoignage*/
Route::get('temoignages/index', [TemoignageController::class, 'index']);
Route::get('temoignages/show/{temoignage}', [TemoignageController::class, 'show']);

/**routes pour les roles */
Route::post('roles/store', [RoleController::class, 'store']);
Route::post('roles/update/{role}', [RoleController::class, 'update']);

/*routes pour les utilisateurs*/
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');


/*newsletter*/
Route::post('news/store', [SouscrisController::class, 'store']);

/*reset password*/
// Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

