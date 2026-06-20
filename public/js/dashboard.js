console.log("JS CHARGÉ");
console.log("🔥 dashboard.js chargé");

document.addEventListener("DOMContentLoaded", () => {
    loadBatches("all");
    loadStats();
});

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

        const status = (batch.status || "").trim().toUpperCase();
        const statusClass = getStatusClass(status);

        row.className = statusClass;
row.innerHTML = `
    <td>${batch.product_name}</td>
    <td>${batch.quantity}</td>
    <td>${batch.expiration_date}</td>
    <td>
        <span class="px-2 py-1 rounded ${getStatusClass(batch.status)}">
            ${batch.status}
        </span>
    </td>
    <td>
        <button 
            data-id="${batch.product_id}" 
            class="btn-checkout bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
            Délivrer
        </button>
    </td>
`;

        tbody.appendChild(row);
    });
}
function getStatusClass(status) {
    switch (status) {
        case "EXPIRED":
            return "bg-red-100 text-red-700";
        case "WARNING":
            return "bg-orange-100 text-orange-700";
        case "CRITICAL":
            return "bg-red-200 text-red-900";
        case "OK":
            return "bg-green-100 text-green-700";
        default:
            return "bg-gray-100 text-gray-700";
    }
}


//form ajouter

document.getElementById("add-batch-form").addEventListener("submit", function (e) {
    e.preventDefault();

    fetch("/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/index.php?route=api/stocks/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            product_id: document.getElementById("product_id").value,
            quantity: document.getElementById("quantity").value,
            expiration_date: document.getElementById("expiration_date").value
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log("AJOUT OK:", data);

        alert("Lot ajouté avec succès");

        // refresh table
        loadStocks();
    })
    .catch(err => console.error(err));
});

//ajouter function checkout
function checkout(productId) {
    fetch(`/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/index.php?route=api/stocks/checkout`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ batch_id: batchId })
    })
    .then(res => res.json())
    .then(data => {
        console.log("DÉLIVRÉ:", data);
        alert("Produit délivré avec succès");

        loadBatches("all"); // refresh correct
    })
    .catch(err => console.error("Erreur checkout:", err));
}


//le button délivrer
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-checkout")) {
        checkout(e.target.dataset.id);
    }
});


//Ecouter le button d'alert

document.addEventListener("DOMContentLoaded", () => {
    loadBatches("all");
    loadStats();
});

function loadBatches(criteria = "all") {
    fetch(`/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/index.php?route=api/stocks/filter&criteria=${criteria}`)
        .then(res => res.json())
        .then(data => {
            renderTable(data.data);
        })
        .catch(err => console.error("Erreur loadBatches:", err));
}

// IMPORTANT pour onclick HTML
window.loadBatches = loadBatches;



//render le table

function renderTable(batches) {
    const tbody = document.getElementById("batch-table");
    tbody.innerHTML = "";

    batches.forEach(batch => {

        const status = (batch.status || "").toUpperCase().trim();

        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${batch.product_name}</td>
            <td>${batch.quantity}</td>
            <td>${batch.expiration_date}</td>
            <td>
                <span class="${getStatusClass(status)} px-2 py-1 rounded">
                    ${status}
                </span>
            </td>
            <td>
                <button 
                    data-id="${batch.product_id}" 
                    class="btn-checkout bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                    Délivrer
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });
}

function loadStats() {
    fetch(`/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/index.php?route=api/stocks/stats`)
        .then(res => res.json())
        .then(data => {
            document.getElementById("stats").innerHTML = `
                <div class="bg-red-100 p-4 rounded">
                    <h3 class="font-bold">Expire bientôt</h3>
                    <p class="text-2xl">${data.count_expiring ?? 0}</p>
                </div>
            `;
        })
        .catch(err => console.error("Erreur stats:", err));
}