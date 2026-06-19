<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Stock FEFO - PharmaFEFO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<h1 class="text-2xl font-bold mb-4"> Gestion Stock FEFO</h1>

<div class="bg-white p-4 rounded shadow">

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Produit</th>
                <th class="p-2">Lot</th>
                <th class="p-2">Quantité</th>
                <th class="p-2">Expiration</th>
                <th class="p-2">Status</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>

        <tbody id="batch-table">
          
        </tbody>
    </table>

</div>

<script src="/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/js/dashboard.js"></script>

</body>
</html>