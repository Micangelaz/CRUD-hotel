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

    $sql = "SELECT MAX(Client_ID) AS id
    FROM Clients";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    foreach ($stmt as $row) {
        $id = $row['id'];
    }

    return $id;
}

$Client_ID = mssql_insert_id() + 1;
$FIO = "";
$Sex = "";
$Address = "";
$Date_birth = "";
$Psprt_series = "";
$Psprt_number = "";
$Date_to = "";
$Date_from = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ID = $_POST["ID"];
    $FIO = $_POST["ФИО"];
    $Sex = $_POST["Пол"];
    $Address = $_POST["Адрес"];
    $Date_birth = $_POST["Дата_рождения"];
    $Psprt_series = $_POST["Серия_паспорта"];
    $Psprt_number = $_POST["Номер_паспорта"];
    $Date_to = $_POST["Прибытие"];
    $Date_from = $_POST["Отъезд"];

    do {
        if (empty($FIO) || empty($Sex) || empty($Address) || empty($Date_birth) || empty($Psprt_series) || empty($Psprt_number) || empty($Date_to) || empty($Date_from)) {
            $errorMessage = "Все поля обязательны для заполнения";
            break;
        }

        $sql_add = "SET IDENTITY_INSERT Distribution ON 
                    insert INTO Clients (Client_ID, FIO, Sex, Address, Date_birth, Psprt_series, Psprt_number, Date_to, Date_from) VALUES ($Client_ID, $FIO, $Sex, $Address,
                    $Date_birth, $Psprt_series, $Psprt_number, $Date_to, $Date_from)
                    SET IDENTITY_INSERT Distribution OFF";
        $stmt = $connection->prepare($sql_add);
        $stmt->execute();

        $Client_ID = "";
        $FIO = "";
        $Sex = "";
        $Address = "";
        $Date_birth = "";
        $Psprt_series = "";
        $Psprt_number = "";
        $Date_to = "";
        $Date_from = "";

        $successMessage = "Клиент успешно добавлен";

        header("location: ../Clients.php");
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
        <h1>Новый клиент</h1>

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
                    <input type="text" readonly class="form-control" name="ID" value="<?php echo $Client_ID; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ФИО</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ФИО" value="<?php echo $FIO; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Пол</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Пол" value="<?php echo $Sex; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Адрес</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Адрес" value="<?php echo $Address; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Дата рождения</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Дата_рождения" value="<?php echo $Date_birth; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Серия паспорта</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Серия_паспорта" value="<?php echo $Psprt_series; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Номер паспорта</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Номер_паспорта" value="<?php echo $Psprt_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Прибытие</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Прибытие" value="<?php echo $Date_to; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Отъезд</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Отъезд" value="<?php echo $Date_from; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="../Clients.php" class="btn btn-outline-primary" role="button">Закрыть</a>
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