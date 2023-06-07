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

        <div class="controls">
<a href="insert.php?database=<?php echo urlencode($databaseName); ?>"> 
<button name="controls" type="radio" id="insert">Insert</button></a>
            Update<input name="controls" type="radio" id="update">
            Select<input name="controls" type="radio" id="select">
        </div>
        <div class="change"></div>


    </main>
    <?php
    $tableName = $_GET['table'];
    $databaseName = $_GET['database'];
    $conn = new mysqli("localhost", "root", "", $databaseName) or die("error");
    $sql = "SELECT * FROM " . $tableName;
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $columns = mysqli_fetch_fields($query);
        echo "<table border=1>";
        echo "<tr>";
        foreach ($columns as $column) {
            echo "<td>" . $column->name . "</td>";
        }
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }


    ?>

</body>

</html>