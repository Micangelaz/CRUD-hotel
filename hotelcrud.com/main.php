<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <!-- <link rel="stylesheet" href="static/style/style_main.css">
    <link rel="stylesheet" href="static/style/style_All.css"> -->
    <style>
        <?php
        include 'static/style/style_main.css'
            ?>
        <?php
        include 'static/style/style_All.css'
            ?>
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- контент  -->
        <div class="content">
            <!-- Меню -->
            <div class="container">
                <div class="title__row">
                    <div class="title">
                        <h1>Главное меню</h1>
                        </p>
                    </div>
                </div>
                <div class="buttons">
                    <div><a class=button href="pages/Clients.php">Гости</a></div>
                    <div><a class=button href="pages/Rooms.php">Реестр номеров</a></div>
                    <div><a class=button href="pages/Distribution.php">Распределение номеров</a></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>