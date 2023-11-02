<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
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
                    <h1>Реестр номеров</h1>
                </div>
                <div class="buttons">
                    <div><a class="btn btn-primary" id="create" href="Create/Create_rooms.php">Создать</a></div>
                    <div><a class="btn btn-primary" id="main_menu" href="../main.php">Главное меню</a></div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Этаж</th>
                            <th>Количество мест</th>
                            <th>Количество человек</th>
                            <th>Стоимость за 1 сутки</th>
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


                        $sql = "select * from Rooms";
                        $result = $connection->query($sql);

                        $data = $result->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($data as $row) {
                            $ID = $row['Room_ID'];
                            $Floor = $row['Floor'];
                            $Quantity_beds = $row['Quantity_beds'];
                            $Quantity_persons = $row['Quantity_persons'];
                            $Cost = $row['Cost'] + 0;
                            echo "
                                <tr>
                                <td>$ID</td>
                                <td>$Floor</td>
                                <td>$Quantity_beds</td>
                                <td>$Quantity_persons</td>
                                <td>$Cost</td>
                                <td>
                                 <a class='btn btn-primary btn-sm' href='Edit/Edit_rooms.php?update=$ID'>Изменить</a>
                                 <a class='btn btn-danger btn-sm' href='Delete/Delete_rooms.php?delete=$ID'>Удалить</a>
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