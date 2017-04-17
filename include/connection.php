<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>Test</p>
        <?php
        $connection = mysqli_connect('localhost', 'root', '', 'diecasting');
        if (!$connection) {
            echo 'no connection';
            exti;
        }

        mysqli_query($connection, 'SET NAMES UTF8');
        $q = mysqli_query($connection, 'SELECT * FROM rawpart');
        if (!$q) {
            echo 'error in database';
            echo mysqli_error($connection);
        }

        // var_dump($q);
        // echo $q->fetch_assoc();
        while ($row = $q->fetch_assoc()) {
            echo '<pre>' . print_r($row, true) . "</pre>";
            // echo $row['rtNumber'];
        }
        ?>
    </body>
</html>
