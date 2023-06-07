<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządanie bazą danych</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
</head>
<body>

    <header>

    </header>

    <main>
<?php 
$conn = new mysqli("localhost", "root", "") or die("error");
$sql = "SHOW DATABASES";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $databaseName = $row['Database'];
        echo "<a href='tables.php?database=".$databaseName."'>".$databaseName."</a><br>";
    }
} else {
    echo "You don't have any database";
}


?>
 
</main>
</body>
</html>