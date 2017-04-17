<?php
// $pageTitle='Яко лейки млейки';
// require './include/dcMachine.php';
require './include/dcWorkers.php';
include 'form.php';
?>
<div id="title">СКЛАДОВА НАЛИЧНОСТ</div>

<form method="POST">
    <div id='imput'>
        <select name=".$dcMachine[$row['dcMachine']].">
            <option value="0">Всички</option>
<?php
foreach ($dcMachine as $value) {
    echo '<option selected>' . $value . '</option>';
}
?>
        </select> <input type="submit" value="Филтрирай" />

    </div>
</form>
<?php ?>            

<div>
    <table>
        <tr>
            <th><strong>Запис No</strong></th>
            <th><strong>Дaтa</strong></th>
            <th><strong>Детайл</strong></th>
            <th><strong>Пресформа</strong></th>
            <th><strong>Описание</strong></th>
            <th><strong>Броя</strong></th>
            <th><strong>Леярска машина</strong></th>
            <th><strong>Смяна</strong></th>			
        </tr>
<?php
$q = mysqli_query($connection, 'SELECT * FROM rawpart
                ORDER BY dcDate DESC LIMIT 0, 20');
if (!$q) {
    echo '<span class="span">Има проблем със селекта</span>';
    echo mysqli_error($q);
}

while ($row = $q->fetch_assoc()) {
    echo '<tr>
				<td>' . $row['rtId'] . '</td>
				<td>' . $row['dcDate'] . '</td>
				<td>' . $row['rtNumber'] . '</td>
				<td>' . $row['dcMold'] . '</td>
				<td>' . $row['rtDesc'] . '</td>
				<td>' . $row['rtQty'] . '</td>
				<td>' . $dcMachine[$row['dcMachine']] . '</td>
				<td>' . $dcWorkers[$row['dcShift']] . '</td>
				
		</tr>';
}
$r = mysqli_query($connection, 'SELECT SUM(rtQty) FROM rawpart WHERE rtID>1');
$suma = mysqli_fetch_array($r);
//echo '<pre>'.print_r($r).'</pre>';								
echo '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>Сума</td>
					<td>' . $suma[0] . '</td>
					<td></td>
					<td></td>
				  </tr>';
?>


    </table>






</div>
