<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie bazą danych</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
    input {
        margin: 10px;
    }
    </style>
</head>
<body>

<form action="create.php" method="post">

        Table name: <input type="text" name="tName" id="tName" oninput="addButton()" required><br>
        <input type="button" id="add" onclick="addCell()" value="Add collumn">
        <div id="newInput"></div>
        <div id="submit"></div>
    </form>

    <script>
    function addCell() {
        const input = "<input type='text' name='columns[]'>";
        const select =
        "<select name='types[]' required><option>int</option><option >varchar</option><option>text</option></select>";
        const value = "<input type='number' name='values[]' placeholder='Length/Values' size='6'>";
        const PrimaryKey = "Primary Key <input type='radio' name='pk[]' value='PRIMARY KEY'>";
        $("#newInput").append("Column name: " + input + " " + select + " " + value + " " + PrimaryKey + "<br>");
    }


    let buttonAdded = false;

    function addButton() {
        const tName = document.getElementById("tName").value;
        if (tName !== "" && !buttonAdded) {
            $("#submit").append("<input type='submit' value='Send data'><br>");
            buttonAdded = true;
        }
    }
    </script>
   


   <?php

    $databaseName = $_GET['database'];
    $conn = new mysqli("localhost", "root", "", $databaseName) or die("error");
    $tableName = $_POST['tName'];
    $columns = $_POST['columns'];
    $types = $_POST['types'];
    $values = $_POST['values'];
    $primarykey = $_POST['pk'];
    if (count($columns) == count($types)) {
        // Tworzenie zapytania SQL do utworzenia tabeli
        $sql = "CREATE TABLE $tableName (";
        for ($i = 0; $i < count($columns); $i++) {
            $columnName = $columns[$i];
            $columnType = $types[$i];
            $pk = $primarykey[$i];
            $TypeValues = isset($values[$i]) ? $values[$i] : ""; // Sprawdzenie, czy wartość istnieje
        
            $sql .= "$columnName $columnType ";
            if (!empty($TypeValues)) {
                $sql .= "($TypeValues)";
            }
            if ($i < count($columns) - 1) {
                $sql .= ", ";
            }
            $sql .= " ". $pk;
        }
        $sql .= ");";

        $query = mysqli_query($conn, $sql);
        if ($query) {
            header("Location: tables.php?database=".urlencode($databaseName)."&info=Table%20created");
        } else {
            header("Location: tables.php?database=".urlencode($databaseName)."&info=Something%20went%20wrong");
        }
    } else {
        echo "Liczba kolumn i typów nie jest zgodna!";
    }

    $conn->close();

?>


</body>

</html>