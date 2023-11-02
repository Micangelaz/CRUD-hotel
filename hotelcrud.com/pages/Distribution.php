<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribution</title>
    <!-- <link rel="stylesheet" href="../static/style/style_pages.css">
    <link rel="stylesheet" href="../static/style/style_All.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        <?php
        include '../static/style/style_pages.css'
            ?>
        <?php
        include '../static/style/style_All.css"'
            ?>
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- контент -->
        <div class="content">
            <!--Меню-->
            <div class="container">
                <div class="title__row">
                    <h1>Распределение номеров</h1>
                </div>
                <div class="buttons">
                    <div><a class="btn btn-primary" id="create" href="Create/Create_distributions.php">Создать</a></div>
                    <div><a class="btn btn-primary" id="main_menu" href="../main.php">Главное меню</a></div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room_ID</th>
                            <th>Client_ID</th>
                            <th>ФИО</th>
                            <th>Прибытие</th>
                            <th>Отъезд</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "LAPTOP-Q4H533AK\SQLEXPRESS";
                        $username = "sa";
                        $password = "123";
                        $database = "Hotel";

                        $connection = new PDO("sqlsrv:Server=$servername;Database=$database", $username, $password);
                        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        if ($connection === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        $sql = "SELECT distribution.*, clients.FIO, clients.Date_to, clients.Date_from FROM distribution, clients WHERE distribution.Client_ID = clients.Client_ID;";
                        $result = $connection->query($sql);

                        $data = $result->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($data as $row) {
                            $ID = $row['ID'];
                            $Room_ID = $row['Room_ID'];
                            $Client_ID = $row['Client_ID'];
                            $FIO = $row['FIO'];
                            $Date_to = $row['Date_to'];
                            $Date_from = $row['Date_from'];
                            echo "
                                <tr>
                                <td>$ID</td>
                                <td>$Room_ID</td>
                                <td>$Client_ID</td>
                                <td>$FIO</td>
                                <td>$Date_to</td>
                                <td>$Date_from</td>
                                <td>
                                 <a class='btn btn-primary btn-sm' href='Edit/Edit_distribution.php?update=$ID'>Изменить</a>
                                 <a class='btn btn-danger btn-sm' href='Delete/Delete_distribution.php?delete=$ID'>Удалить</a>
                                </td>
                             </tr>
                                ";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>