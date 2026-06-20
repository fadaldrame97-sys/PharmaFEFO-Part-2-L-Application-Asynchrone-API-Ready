<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



<h1>Rapport des pertes financières</h1>

<div id="report"></div>

<script>
fetch("/public/index.php?route=api/admin/reports")
    .then(res => res.json())
    .then(data => {
        document.getElementById("report").innerHTML =
            "Total pertes: " + data.total_loss + " unités";
    });
</script>
    
</body>
</html>