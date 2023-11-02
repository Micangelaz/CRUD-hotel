<?php
$servername = "LAPTOP-Q4H533AK\SQLEXPRESS";
$username = "sa";
$password = "123";
$database = "Hotel";

$connection = new PDO("sqlsrv:Server=$servername;Database=$database", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ID = "";
$Floor = "";
$Quantity_beds = "";
$Quantity_persons = "";
$Cost = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["update"])) {
        header("location: ../../main.php");
        exit;
    }
    $ID = $_GET["update"];

    $sql = "SELECT * FROM Rooms WHERE Room_ID = :ID";

    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":ID", $ID);
    $stmt->execute();

    foreach ($stmt as $row) {
        $Floor = $row['Floor'];
        $Quantity_beds = $row['Quantity_beds'];
        $Quantity_persons = $row['Quantity_persons'];
        $Cost = $row['Cost'];
    }


} else {
    $ID = $_POST["ID"];
    $Floor = $_POST["Этаж"];
    $Quantity_beds = $_POST["Количество_мест"];
    $Quantity_persons = $_POST["Количество_человек"];
    $Cost = $_POST["Стоимость"];

    do {
        if (empty($Floor) || empty($Quantity_beds) || empty($Quantity_persons) || empty($Cost)) {
            $errorMessage = "Все поля обязательны для заполнения";
            break;
        }

        try {

            $sql_up = 'UPDATE Rooms SET Floor= :Floor, Quantity_beds= :Quantity_beds, Quantity_persons= :Quantity_persons, Cost= :Cost WHERE Room_ID= :ID';

            $stmt = $connection->prepare($sql_up);
            $stmt->execute(array(":Floor" => $Floor, ":Quantity_beds" => $Quantity_persons, ":Quantity_persons" => $Quantity_persons, ":Cost" => $Cost, ":ID" => $ID));

        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        $ID = "";
        $Floor = "";
        $Quantity_beds = "";
        $Quantity_persons = "";
        $Cost = "";

        $successMessage = "Номер успешно обновлен";

        header("location: ../Rooms.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container my-5">
        <h1>Обновление номера</h1>

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
                    <input type="text" readonly class="form-control" name="ID" value="<?php echo $ID; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Этаж</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Этаж" value="<?php echo $Floor; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Количество мест</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Количество_мест"
                        value="<?php echo $Quantity_beds; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Количество человек</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Количество_человек"
                        value="<?php echo $Quantity_persons; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Стоимость</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Стоимость" value="<?php echo $Cost; ?>">
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