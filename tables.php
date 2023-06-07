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
$databaseName = $_GET['database'];
$conn = new mysqli("localhost", "root", "", $databaseName) or die("error");
$sql = "SHOW TABLES";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        echo "<a href='operations.php?database=".$databaseName."&table=".$row[0]."'>".$row[0]."</a><br>";
    }
}


?>
        <div class="controls">
        <a href="create.php?database=<?php echo urlencode($databaseName); ?>">
  <button name="controls" type="radio" id="create">Create table</button>
</a>


        </div>
        <div class="change"></div>


    </main>


</body>
</html>