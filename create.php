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
        Table name: <input type="text" name="tName" id="tName" oninput="addButton()"><br>
        <input type="button" id="add" onclick="addCell()" value="Add cell" > 
        <div id="newInput"></div>
        <div id="submit"></div>
    </form>

    <script>
    function addCell() {
        $("#newInput").append("Column name: <input type='text' name='columns[]'><select name='types[]'><option>int</option><option >varchar</option><option>text</option></select><input type='number' name='values[]' placeholder='Length/Values' size='6'><br>");
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tName'], $_POST['columns'], $_POST['types'])) {
        $conn = new mysqli("localhost", "root", "", "test") or die("error");
        $tableName = $_POST['tName'];
        $columns = $_POST['columns'];
        $types = $_POST['types'];
        $values = $_POST['values'];
       
        if (count($columns) == count($types)) {
           
            $sql = "CREATE TABLE $tableName (";
            for ($i = 0; $i < count($columns); $i++) {
                $columnName = $columns[$i];
                $columnType = $types[$i];
                $TypeValues = isset($values[$i]) ? $values[$i] : ""; 
            
                $sql .= "$columnName $columnType";
                if (!empty($TypeValues)) {
                    $sql .= "($TypeValues)";
                }
                if ($i < count($columns) - 1) {
                    $sql .= ", ";
                }
            }
            $sql .= ");";
            
$query = mysqli_query($conn, $sql);
if ($query) {
    echo "Table created successfully";
} else {
    echo "Something went wrong";
}

        } else {
            echo "";
        }

        $conn->close();
    }
}
?>

</body>

</html>
