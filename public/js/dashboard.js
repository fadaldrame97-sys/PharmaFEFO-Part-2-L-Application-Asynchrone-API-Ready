console.log("EXTERNAL JS CHARGÉ !");
alert("EXTERNAL JS CHARGÉ !");

fetch("api/v1/batches")
.then(Response=>Response.json())
.then(data=>{console.log("DATA API:",data)})

.catch(error=>{console.log("Erreur API:",error)});

