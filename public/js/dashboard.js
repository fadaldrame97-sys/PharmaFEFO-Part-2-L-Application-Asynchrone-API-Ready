console.log("EXTERNAL JS CHARGÉ !");
console.log();
 console.log($data);
alert("EXTERNAL JS CHARGÉ !");

fetch("/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/api/v1/batches")
  .then(response => response.json())
  .then(data => {console.log("DATA API:", data);
  })
  .catch(error => {console.log("Erreur API:", error);});


  function displayBatches(batches) {
    const tbody = document.getElementById("batch-table");
    tbody.innerHTML = "";

    batches.forEach(batch => {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${batch.product_name}</td>
            <td>${batch.quantity}</td>
            <td>${batch.expiration_date}</td>
            <td>
                <button data-id="${batch.product_id}">
                    Délivrer
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });
}

