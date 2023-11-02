<?php
$servername = "LAPTOP-Q4H533AK\SQLEXPRESS";
$username = "sa";
$password = "123";
$database = "Hotel";

$connection = new PDO("sqlsrv:Server=$servername;Database=$database", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['delete'])) {

    $ID = $_GET['delete'];

    try {

        $sql = "delete from Distribution where ID=:ID;";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":ID", $ID);
        $stmt->execute();

        header('location: ../Distribution.php');
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }

}