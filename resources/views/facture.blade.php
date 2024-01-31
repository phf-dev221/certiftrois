 ,<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <!-- Ajoutez le lien vers Bootstrap CSS ici -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Facture Publicitaire chez EUREKA</h2>

        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>Nom du payant:</strong> {{$user->nom }} {{$user->firstName}}</p>
                <p class="card-text"><strong>Montant payé:</strong> {{ $payment->amount }}</p>
                <p class="card-text"><strong>Date de paiement:</strong> {{ $payment->created_at }}</p>


                <a href="{{ route('payment.index') }}" class="btn btn-primary">Retour à la page d'accueil</a>
            </div>
        </div>
    </div>

    <!-- Ajoutez le lien vers Bootstrap JS et Popper.js ici -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
