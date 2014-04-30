<?php
/**
* Description: a complete year
*/

$meses = [
  'January'   => 'Enero',
  'February'  => 'Febrero',
  'March'     => 'Marzo',
  'April'     => 'Abril',
  'May'       => 'Mayo',
  'June'      => 'Junio',
  'July'      => 'Julio',
  'August'    => 'Agosto',
  'September' => 'Septiembre',
  'October'   => 'Octubre',
  'November'  => 'Noviembre',
  'December'  => 'Diciembre'
];

if ( !@include 'Calendar/Calendar.php' ) {
    define('CALENDAR_ROOT','../../');
}

require_once CALENDAR_ROOT.'Year.php';

define ('CALENDAR_MONTH_STATE',CALENDAR_USE_MONTH_WEEKDAYS);

if ( !isset($_GET['year']) ) $_GET['year'] = date('Y');

$Year = new Calendar_Year($_GET['year']);

$Year->build();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<style type="text/css">

table {
  border: thin groove #800080;
  width: 100%;
  font-size: 14px;
  border-collapse: collapse;
}
tr {
  vertical-align: top;
}
.month tr:hover {
  background-color: #ffff99;
  cursor: pointer;
}
th, td {
  text-align: center;
}
</style>
</head>
<body>

<table>
  <thead>
    <tr>
      <th><a href="?year=<?= $Year->prevYear() ; ?>"><<</a></th>
      <th><?= $Year->thisYear() ; ?></th>
      <th><a href="?year=<?= $Year->nextYear() ; ?>">>></a></th>
    </tr>
  </thead>
</table>

<?php  
for ( $i = 0; $Month = $Year->fetch() ; $i++ ) {
  $mes = $meses[date('F',$Month->thisMonth(TRUE))];
?>

<table class="month">

<thead>
  <tr>
    <th colspan="7"><?= $mes ?></th>
  </tr>
  <tr>
    <th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th><th>Sabado</th><th>Domingo</th>
  </tr>
</thead>

<tbody>
<?php

$Month->build();
while ( $Day = $Month->fetch() ) {

    if ( $Day->isFirst() )
      echo '<tr onclick="console.log(\'aers\');">';

    if ( $Day->isEmpty() )
        echo '<td>&nbsp;</td>';
    else
      echo '<td>'.$Day->thisDay().'</td>';

    if ( $Day->isLast() )
      echo '</tr>';

}
?>
</tbody>
</table>

<?php  }  ?>

</body>
</html>