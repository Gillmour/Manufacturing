<?php
// include './include/header.php';
require './include/dcMachine.php';
require './include/dcWorkers.php';

$connection = mysqli_connect('localhost', 'root', '', 'diecasting');
// $connection = mysqli_connect('192.168.1.143', 'gillmour', 'acariciar', 'diecasting');

if (!$connection) {
    echo 'no connection';
    exit;
}

mysqli_query($connection, 'SET NAMES utf8');
$q = mysqli_query($connection, 'SELECT * FROM rawpart');
if (!$q) {
    echo 'error in database';
}
/* while ($row = $q->fetch_assoc()){
  echo '<pre>'.print_r($row, true).'</pre>';
  } */

// exit;
// var_dump($q);
// echo $q->fetch_assoc();
// while($row=$q->fetch_assoc()){            
// echo '<pre>'.print_r($row, true)."</pre>";
// }
// echo $row['rtNumber'];
// exit;

mb_internal_encoding('UTF-8');

if ($_POST) {
    $rtNumber = trim($_POST['dcNumber']);
    $dcNumber = str_replace('!', '', $rtNumber);
    $rtQty = trim($_POST ['rtQty']);
    $rtQty = str_replace('!', '', $rtQty);
    $selectedDcMachine = (int) $_POST['dcMachine'];
    $selectedDcWorkers = (int) $_POST['dcWorkers'];
    $dcDescription = $_POST['dcDescription'];
    $dcMold = $_POST['dcMold'];
    date_default_timezone_set('Europe/Minsk');
    $now = date('d-m-y G:i:s');

    // echo "$now";
    // exit;
    // echo '<pre>'.print_r($dcWorkers, true).'</pre>';
    // echo '<pre>'.print_r($rtQty, true).'</pre>';
    // $selectedMachine=(int)$_POST['dcMachine'];
    // echo $selectedMachine;
    $error = false;

    if (!array_key_exists($selectedDcWorkers, $dcWorkers)) {
        echo '<p>Няма такава лейка<p>';
        $error = true;
    }

    if (mb_strlen($rtNumber) < 6 || mb_strlen($rtNumber) > 8) {
        echo '<p>Грешен номер на детайл<p>';
        $error = true;
    }
    if ($rtQty < 0 || $rtQty > 2000) {
        echo '<p>Лъжеш в бройките!!! <p>';
        $error = true;
    }
    if (!array_key_exists($selectedDcMachine, $dcMachine)) {
        echo '<p>Няма такава машина<p>';
        $error = true;
    }

    // '<pre>'.print_r($error, true).'</pre>';

    if (!$error) {
        $result = $rtNumber . '!' . $dcMold . '!' . $dcDescription . '!' . $rtQty . '!' . $selectedDcMachine . '!' . $selectedDcWorkers . "\n";
        // echo $result;
        // $send = 'INSERT INTO rawpart (rtNumber) VALUES("'.$dcNumber.'")';

        $send = 'INSERT INTO rawpart (rtNumber, dcMold, rtDesc, rtQty, dcMachine, dcShift, dcDate)
         VALUES ("' . $rtNumber . '", "' . $dcMold . '", "' . $dcDescription . '", "' . $rtQty . '", "' . $selectedDcMachine . '", "' . $selectedDcWorkers . '", "' . $now . '")';

        // echo $send;
        // exit;
        if (mysqli_query($connection, $send)) {
            // echo 'OK';    
        } else {
            echo 'Нещо не се получи!';
            echo mysqli_error($connection);
        }
    }
}

// echo $dcWorkers;
// echo '<pre>'.print_r($_POST, true).'</pre>';
// echo '<pre>'.print_r($dcWorkers, true).'</pre>';
?>
<form method="POST">
    <div id="title">Отчет на произведените отливки</div>

    <span class="span">Номер детайл: <input type="text" name="dcNumber" placeholder="Номер на отливка"/></span>
    <div><span class="span">Броя: <input type="text" name="rtQty" placeholder="Броя"/></span></div>
    <span class="span">
        <select name="dcMachine">
<?php
foreach ($dcMachine as $key => $value) {
    echo '<option value="' . $key . '">' . $value . '</option>';
}
?>
        </select>

    </span>
    <span class="span">
        <select name="dcWorkers">
            <?php
            foreach ($dcWorkers as $key1 => $value1) {
                echo '<option value="' . $key1 . '">' . $value1 . '</option>';
            }
            // echo '<pre>'.print_r($key1, true).'</pre>'
            ?>
        </select>
    </span><br />
    <span class="span">Пресформа: <input type="text" name="dcMold" /></span>
    <span class="span">Описание: <input type="text" name="dcDescription" /></span>

    <div><input type="submit" value="Добави" /></div>
</form>
