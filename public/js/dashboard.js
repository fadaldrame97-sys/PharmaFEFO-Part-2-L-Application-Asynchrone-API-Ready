console.log("EXTERNAL JS CHARGÉ !");
alert("EXTERNAL JS CHARGÉ !");

fetch("/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/index.php?route=api&action=stocks")
  .then(response => response.json())
  .then(result => {

      console.log("DATA API:", result);

      displayBatches(result.data);

  })
  .catch(error => {
      console.log("Erreur API:", error);
  });

function displayBatches(batches) {

    const tbody = document.getElementById("batch-table");
    tbody.innerHTML = "";

    if (!batches || batches.length === 0) {
        tbody.innerHTML = "<tr><td colspan='4'>Aucune donnée</td></tr>";
        return;
    }

    batches.forEach(batch => {

        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${batch.product_name}</td>
            <td>${batch.quantity}</td>
            <td>${batch.expiration_date}</td>
            <td>
                <button data-id="${batch.id}">
                    Délivrer
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });
}
