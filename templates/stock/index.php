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

<div class="bg-white shadow-md rounded-lg p-6 mb-6">

    <h2 class="text-xl font-bold text-gray-800 mb-4">
        Ajouter un lot
    </h2>

    <form id="add-batch-form" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

        <!-- Product ID -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                ID Produit
            </label>
            <input type="number" id="product_id"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Ex: 1">
        </div>

        <!-- Quantity -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Quantité
            </label>
            <input type="number" id="quantity"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Ex: 50">
        </div>

        <!-- Expiration -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Date d'expiration
            </label>
            <input type="date" id="expiration_date"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Button -->
        <div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                Ajouter lot
            </button>
        </div>

    </form>
</div>

<hr>

<script src="/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/js/dashboard.js"></script>

</body>
</html>