<?php

/**
 * @OA\Security(
 *     security={
 *         "BearerAuth": {}
 *     },
 */


/**
 * @OA\SecurityScheme(
 *     securityScheme="BearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 */


/**
 * @OA\Info(
 *     title="Your API Title",
 *     description="Your API Description",
 *     version="1.0.0"
 */


/**
 * @OA\Consumes({
 *     "multipart/form-data"
 * })
 */


/**
 * @OA\GET(
 *     path="/api/souscris/index",
 *     summary="Liste des souscris",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Newsletter"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/news/store",
 *     summary="Souscrire a un newsletter",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="email", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Newsletter"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/news",
 *     summary="Creer un newsletter",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="libelle", type="string"),
 *                     @OA\Property(property="contenu", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Newsletter"},
 * )
 */


/**
 * @OA\GET(
 *     path="http://localhost:8000/api/roles/index",
 *     summary="liste des roles",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Role"},
 * )
 */


/**
 * @OA\POST(
 *     path="http://localhost:8000/api/roles/destroy/{role}",
 *     summary="supprimer un role",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="role", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Role"},
 * )
 */


/**
 * @OA\POST(
 *     path="http://localhost:8000/api/roles/store",
 *     summary="creer un role",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="nomRole", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Role"},
 * )
 */


/**
 * @OA\POST(
 *     path="http://localhost:8000/api/roles/update/{role}",
 *     summary="Modifier un role",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="role", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Role"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/demandes/indexUser",
 *     summary="Liste des demandes d'un Utilisateur",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/demandes/show/{demande}",
 *     summary="Voir une demande",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="path", name="demande", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\DELETE(
 *     path="/api/demandes/destroy/{demande}",
 *     summary="supprimer une demande",
 *     description="",
 * @OA\Response(response="204", description="Deleted successfully")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 * @OA\Response(response="404", description="Not Found")
 *     @OA\Parameter(in="path", name="demande", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/demandes/refuse/{demande}",
 *     summary="Refuser une demande",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="demande", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/demandes/accept/{demande}",
 *     summary="Accepter une demande",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="demande", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/demandes/refusedDemande",
 *     summary="demandes refusées",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/demandes/acceptedDemande",
 *     summary="demandes acceptées",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/demandes/index",
 *     summary="demandes en attente",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/demandes/update/{demande}",
 *     summary="Modifier une demande",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="demande", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="duree", type="integer"),
 *                     @OA\Property(property="details", type="string"),
 *                     @OA\Property(property="email", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/demandes/store",
 *     summary="creer une demande",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="duree", type="integer"),
 *                     @OA\Property(property="details", type="string"),
 *                     @OA\Property(property="email", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Demande publicité"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/categories/store",
 *     summary="Creer une categorie",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="nom", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"categorie"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/categories/index",
 *     summary="Liste des categories",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"categorie"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/categories/update/{categorie}",
 *     summary="Modifier une categorie",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="categorie", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="nom", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"categorie"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/categories/destroy/{categorie}",
 *     summary="Supprimer une categorie",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="categorie", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"categorie"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/contacts/store",
 *     summary="Enregistré contact",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="nom", type="string"),
 *                     @OA\Property(property="email", type="string"),
 *                     @OA\Property(property="messag", type="string"),
 *                     @OA\Property(property="phone", type="integer"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"contact"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/pubs/update/{publicite}",
 *     summary="Modifier une publicité",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="publicite", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="media", type="string", format="binary"),
 *                     @OA\Property(property="demande_id", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Publicités"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/pubs/index",
 *     summary="liste des publicités",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Publicités"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/pubs/invalide/{publicite}",
 *     summary="invalider une publicité",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="publicite", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Publicités"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/pubs/show/{publicite}",
 *     summary="voir une publicité",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="path", name="publicite", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Publicités"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/pubs/store",
 *     summary="Creer une publicité",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="media", type="string", format="binary"),
 *                     @OA\Property(property="demande_id", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Publicités"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/biens/rendreBien/{bien}",
 *     summary="Mettre un bien comme rendu",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="bien", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Biens"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/biens/bienUser",
 *     summary="Biens d'un utilisateur",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Biens"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/biens/refuse/{bien}",
 *     summary="Refuser un bien",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="bien", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Biens"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/biens/accepte/{bien}",
 *     summary="Accepter un bien",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="bien", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Biens"},
 * )
 */


/**
 * @OA\DELETE(
 *     path="/api/biens/destroy/{bien}",
 *     summary="Supprimer un bien",
 *     description="",
 * @OA\Response(response="204", description="Deleted successfully")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 * @OA\Response(response="404", description="Not Found")
 *     @OA\Parameter(in="path", name="bien", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Biens"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/biens/update/{bien}",
 *     summary="Modifier un bien",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="bien", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="libelle", type="string"),
 *                     @OA\Property(property="date", type="string"),
 *                     @OA\Property(property="description", type="string"),
 *                     @OA\Property(property="lieu", type="string"),
 *                     @OA\Property(property="categorie_id", type="string"),
 *                     @OA\Property(property="image", type="string", format="binary"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Biens"},
 * )
 */


/**
 * @OA\GET(
 *     path="",
 *     summary="récupérer un bien",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="path", name="bien", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Biens"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/biens/index/{categorie}",
 *     summary="liste des biens trouvés",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="path", name="categorie", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Biens"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/biens/store",
 *     summary="déclarer bien",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="libelle", type="string"),
 *                     @OA\Property(property="lieu", type="string"),
 *                     @OA\Property(property="description", type="string"),
 *                     @OA\Property(property="date", type="string"),
 *                     @OA\Property(property="image", type="string", format="binary"),
 *                     @OA\Property(property="categorie_id", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Biens"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/users/changePassword",
 *     summary="changer mot de passe",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="current_password", type="string"),
 *                     @OA\Property(property="new_password", type="string"),
 *                     @OA\Property(property="confirm_password", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Users"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/forget-password",
 *     summary="reset password",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="email", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Users"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/users/whatsapp/5",
 *     summary="whatsapp",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Users"},
 * )
 */


/**
 * @OA\GET(
 *     path="/chatify",
 *     summary="chatify",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Users"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/users/update/{user}",
 *     summary="Modification utilisateur",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="path", name="user", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="name", type="string"),
 *                     @OA\Property(property="phone", type="integer"),
 *                     @OA\Property(property="firstName", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Users"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/users/archives",
 *     summary="utilisateurs archives",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Users"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/users/nonArchives",
 *     summary="utilisateurs non archives",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Users"},
 * )
 */


/**
 * @OA\PUT(
 *     path="/api/archive{user}",
 *     summary="archivage",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="path", name="user", required=false, @OA\Schema(type="string")
 * )
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Users"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/logout",
 *     summary="déconnexion",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Users"},
 * )
 */


/**
 * @OA\GET(
 *     path="/api/users/index",
 *     summary="liste des utilisateurs",
 *     description="",
 * @OA\Response(response="200", description="OK")
 * @OA\Response(response="404", description="Not Found")
 * @OA\Response(response="500", description="Internal Server Error")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     tags={"Users"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/login",
 *     summary="authentification",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="email", type="string"),
 *                     @OA\Property(property="password", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Users"},
 * )
 */


/**
 * @OA\POST(
 *     path="/api/register",
 *     summary="inscription",
 *     description="",
 * @OA\Response(response="201", description="Created successfully")
 * @OA\Response(response="400", description="Bad Request")
 * @OA\Response(response="401", description="Unauthenticated")
 * @OA\Response(response="403", description="Unauthorize")
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * )
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="name", type="string"),
 *                     @OA\Property(property="firstName", type="string"),
 *                     @OA\Property(property="phone", type="integer"),
 *                     @OA\Property(property="email", type="string"),
 *                     @OA\Property(property="password", type="string"),
 *                     @OA\Property(property="confirmPassword", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Users"},
 * )
 */


