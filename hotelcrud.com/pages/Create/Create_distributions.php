<?php
$servername = "LAPTOP-Q4H533AK\SQLEXPRESS";
$username = "sa";
$password = "123";
$database = "Hotel";

$connection = new PDO("sqlsrv:Server=$servername;Database=$database", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function mssql_insert_id()
{
    $servername = "LAPTOP-Q4H533AK\SQLEXPRESS";
    $username = "sa";
    $password = "123";
    $database = "Hotel";

    $connection = new PDO("sqlsrv:Server=$servername;Database=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = 0;

    $sql = "SELECT MAX(ID) AS id
    FROM Distribution";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    foreach ($stmt as $row) {
        $id = $row['id'];
    }

    return $id;
}

$ID = mssql_insert_id() + 1;
$Room_ID = "";
$Client_ID = "";


$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ID = $_POST["ID"];
    $Room_ID = $_POST["Room_ID"];
    $Client_ID = $_POST["Client_ID"];

    do {
        if (empty($Room_ID) || empty($Client_ID)) {
            $errorMessage = "Все поля обязательны для заполнения";
            break;
        }

        $sql_add = "SET IDENTITY_INSERT Distribution ON 
                    insert INTO Distribution (ID, Room_ID, Client_ID) VALUES ($ID, $Room_ID, $Client_ID)
                    SET IDENTITY_INSERT Distribution OFF";
        $stmt = $connection->prepare($sql_add);
        $stmt->execute();

        $ID = "";
        $Room_ID = "";
        $Client_ID = "";

        $successMessage = "Распределение успешно добавлен";

        header("location: ../Distribution.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container my-5">
        <h1>Новое Распределение</h1><br>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class = 'alert alert-warning alert-dismissible fade show' role ='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class = 'btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button>
            </div>
            ";
        }
        ?>

        <form method="post">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input readonly type="text" class="form-control" name="ID" value="<?php echo $ID; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Room_ID</label>
                <div class="col-sm-6">

                    <select class="form-control" name="Room_ID">
                        <?php

                        $stmt = $connection->prepare("SELECT * FROM Rooms ORDER BY Room_ID ASC");
                        $stmt->execute();

                        foreach ($stmt as $row) {
                            echo '<option value="' . $row['Room_ID'] . '">' . $row['Room_ID'] . '</option>';
                        }

                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Client_ID</label>
                <div class="col-sm-6">

                    <select class="form-control" name="Client_ID">
                        <?php

                        $stmt = $connection->prepare("SELECT * FROM Clients ORDER BY Client_ID ASC");
                        $stmt->execute();

                        foreach ($stmt as $row) {
                            echo '<option value="' . $row['Client_ID'] . '">' . $row['FIO'] . '</option>';
                        }

                        ?>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="../Rooms.php" class="btn btn-outline-primary" role="button">Закрыть</a>
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class = 'offset-sm-3 col-sm-3 d-grid'>
                        <div class = 'alert alert-success alert-dismissible fade show' role ='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class = 'btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
        </form>
    </div>
</body>

</html>