console.log("EXTERNAL JS CHARGÉ !");
alert("EXTERNAL JS CHARGÉ !");

fetch("/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/api/v1/batches")
  .then(response => response.json())
  .then(data => {console.log("DATA API:", data);
  })
  .catch(error => {console.log("Erreur API:", error);});

