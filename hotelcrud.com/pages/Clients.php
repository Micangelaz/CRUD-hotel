<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
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
                    <h1>Гости</h1>
                </div>
                <div class="buttons">
                    <div><a class="btn btn-primary" id="create" href="Create/Create_clients.php">Создать</a></div>
                    <div><a class="btn btn-primary" id="main_menu" href="../main.php">Главное меню</a></div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ФИО</th>
                            <th>Пол</th>
                            <th>Адрес</th>
                            <th>Дата рождения</th>
                            <th>Серия паспорта</th>
                            <th>Номер паспорта</th>
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


                        $sql = "select * from Clients";
                        $result = $connection->query($sql);

                        $data = $result->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($data as $row) {
                            $ID = $row['Client_ID'];
                            $FIO = $row['FIO'];
                            $Sex = $row['Sex'];
                            $Address = $row['Address'];
                            $Date_birth = $row['Date_birth'];
                            $Psprt_series = $row['Psprt_series'];
                            $Psprt_number = $row['Psprt_number'];
                            $Date_to = $row['Date_to'];
                            $Date_from = $row['Date_from'];

                            echo "
                                <tr>
                                <td>$ID</td>
                                <td>$FIO</td>
                                <td>$Sex</td>
                                <td>$Address</td>
                                <td>$Date_birth</td>
                                <td>$Psprt_series</td>
                                <td>$Psprt_number</td>
                                <td>$Date_to</td>
                                <td>$Date_from</td>
                                <td>
                                 <a class='btn btn-primary btn-sm' href='Edit/Edit_clients.php?update=$ID'>Изменить</a>
                                 <a class='btn btn-danger btn-sm' href='Delete/Delete_clients.php?delete=$ID'>Удалить</a>
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