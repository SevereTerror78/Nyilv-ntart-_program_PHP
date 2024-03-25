<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raktár</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="mainBody">
        <h1>Raktárak</h1>

        <div class="upLoadBt">
            <form action="setupDatabase.php" method="post">
                <input type="submit" name="upload" value="Adatbázis feltöltése">
            </form>
        </div>
        
        <div class="newData">
            <button id="newDataBtn">Új adat</button>
            <div id="form" style="display: none;">
                <form id="newDataForm" action="add.php" method="post">
                    <label for="store_name">Áruház neve:</label><br>
                    <input type="text" id="store_name" name="store_name"><br>
                    <label for="store_address">Cím:</label><br>
                    <input type="text" id="store_address" name="store_address"><br>
                    <label for="shelf_name">Polc:</label><br>
                    <input type="text" id="shelf_name" name="shelf_name"><br>
                    <label for="row_name">Sor:</label><br>
                    <input type="text" id="row_name" name="row_name"><br>
                    <label for="column_name">Oszlop:</label><br>
                    <input type="text" id="column_name" name="column_name"><br>
                    <label for="product_name">Termék:</label><br>
                    <input type="text" id="product_name" name="product_name"><br>
                    <label for="min_qty">Minimális mennyiség:</label><br>
                    <input type="number" id="min_qty" name="min_qty" min="1"><br>
                    <label for="quantity">Mennyiség:</label><br>
                    <input type="number" id="quantity" name="quantity" min="1"><br>
                    <label for="price">Ár:</label><br>
                    <input type="number" id="price" name="price" step="0.01" min="0"><br><br>
                    <input type="button" id="addDataBtn" value="Hozzáadás">
                </form>
            </div>
        </div>

        <script src="index.js"></script>

        <div class="kiiratas">
            <?php
            require_once 'dataBaseManager.php';

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shop";

            $databaseManager = new DatabaseManager($servername, $username, $password, $dbname);
            $databaseManager->connect();

            $data = $databaseManager->getAllData();

            if (!empty($data)) {
                foreach ($data as $row) {
                    echo "<div class='containers'>";
                    echo "<p><strong>Áruház neve:</strong> " . $row["store_name"] . "<br>";
                    echo "<strong>Cím:</strong> " . $row["store_address"] . "<br>";
                    echo "<strong>Polc:</strong> " . $row["shelf_name"] . "<br>";
                    echo "<strong>Sor:</strong> " . $row["row_name"] . "<br>";
                    echo "<strong>Oszlop:</strong> " . $row["column_name"] . "<br>";
                    echo "<strong>Termék:</strong> " . $row["product_name"] . "<br>";        
                    echo "<strong>Darab: </strong>" . $row['db']."</p>";
                    if ($row['min_db'] > $row['db']) {
                        echo "<p style='color: red;'>Kevés van a termékből!</p>";
                    }
                    echo "<button class='delBtn' data-id='" . $row['product_id'] . "'>Adat törlése</button>";
                    echo "<button class='modifBtn' data-id='" . $row['product_id'] . "'>Adat módosítása</button>";
                    echo "</div>";
                }
            } else {
                echo "Nincs elérhető adat.";
            }

            $databaseManager->closeConnection();
        ?>
        </div>

    </div>
</body>
</html>
