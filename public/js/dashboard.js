console.log("JS CHARGÉ");

// API CALL
fetch("/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/index.php?route=api/stocks")
    .then(response => response.json())
    .then(data => {
        console.log("DATA API:", data);

        // 🔥 IMPORTANT: appel affichage
        displayBatches(data.data);
    })
    .catch(error => {
        console.log("Erreur API:", error);
    });

function displayBatches(batches) {
    const tbody = document.getElementById("batch-table");
    tbody.innerHTML = "";

    batches.forEach(batch => {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${batch.product_name}</td>
            <td>${batch.lot_number}</td>
            <td>${batch.quantity}</td>
            <td>${batch.expiration_date}</td>
            <td>${batch.status}</td>
            <td>
                <button class="bg-blue-500 text-white px-2 py-1 rounded"
                        onclick="checkout(${batch.product_id})">
                    Délivrer
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });
}
