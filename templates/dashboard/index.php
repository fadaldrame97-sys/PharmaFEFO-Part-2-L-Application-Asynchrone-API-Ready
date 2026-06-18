<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaFEFO Dashboard</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-blue-600 text-white p-6 shadow-md">
        <h1 class="text-2xl font-bold">PharmaFEFO Dashboard</h1>
        <p class="text-sm opacity-80">Gestion des stocks et expiration</p>
    </header>

    <!-- Container -->
    <main class="p-6 max-w-6xl mx-auto">

        <!-- Stats -->
        <div id="stats" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- JS injectera les cards ici -->
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold text-gray-700">
                    Liste des lots
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Produit</th>
                            <th class="px-6 py-3">Quantité</th>
                            <th class="px-6 py-3">Expiration</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>

                    <tbody id="batch-table" class="divide-y divide-gray-200">
                        <!-- JS inject -->
                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <script src="/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/js/dashboard.js"></script>

</body>
</html>