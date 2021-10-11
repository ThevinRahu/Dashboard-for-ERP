<?php
include "config.php";
?>
<?php

if (isset($_GET['n'])) {
	$n = $_GET['n'];
$d = $_GET['day'];

$date2 = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($d) ) ));
	
$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date = '$date2' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$nety = $row["sum1"] - $row["sum3"];
		$data[0] = number_format((float)$nety, 2, '.', ',');
		$data[1] = $row["sum2"];
	}
}
if ($data[0] == "" && $data[1] == "") {
	$data[0] = 0.00;
	$data[1] = 0.00;
}
$ajax = '<b>Rs<br>' . $data[0] . '<br>Inv ' . $data[1] . '</b>';
$date2 = date('Y-m',(strtotime ( '-0 month' , strtotime ($d) ) ));
$sql2 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date like '$date2%' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql2);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$netm = $row["sum1"] - $row["sum3"];
		$data1[0] = number_format((float)$netm, 2, '.', ',');
		$data1[1] = $row["sum2"];
	}
}
if ($data1[0] == "" && $data1[1] == "") {
	$data1[0] = 0.00;
	$data1[1] = 0.00;
}

$ajax = $ajax . "###" . '<b>Rs<br>' . $data1[0] . '<br>Inv ' . $data1[1] . '</b>';

$date = date('Y-m',(strtotime ( '-0 days' , strtotime ($d) ) ));
$date = date('Y-m',(strtotime ( '-1 month' , strtotime ($date) ) ));
$sql3 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date like '$date%' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql3);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$netl = $row["sum1"] - $row["sum3"];
		$data2[0] = number_format((float)$netl, 2, '.', ',');
		$data2[1] = $row["sum2"];
	}
}
if ($data2[0] == "" && $data2[1] == "") {
	$data2[0] = 0.00;
	$data2[1] = 0.00;
}

$ajax = $ajax . "###" . '<b>Rs<br>' . $data2[0] . '<br>Inv ' . $data2[1] . '</b>';

$date44 =  date('d',(strtotime ( '-0 day' , strtotime ($d) ) )); //today
$date4444 = date('m',(strtotime ( '-1 month' , strtotime ($d) ) )); //lastmonth
$date44444 = date('Y-m-01',(strtotime ( '-0 month' , strtotime ($d) ) )); //this month and year
$datelast = date("Y-m-$date44",(strtotime ( '-0 month' , strtotime ($d) ) ));
$date444 = date('m',(strtotime ( '-0 month' , strtotime ($d) ) )); //this month
if ($date444 == 01) {
	$date3 = 12;
	$yr = date('Y',(strtotime ( '-1 year' , strtotime ($d) ) )); //last year
	$date444 = "$yr-$date3-01";
	
										$date4 = "$yr-12-$date44";
										}
 else {
   $y = date('Y',(strtotime ( '-0 year' , strtotime ($d) ) ));
	$date444 = "$y-$date4444-01";

										
										$date4 = "$y-$date4444-$date44";
										}


$sql5 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date BETWEEN '$date44444' AND '$datelast' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql5);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$sale1 = $row["sum1"]-$row["sum3"];
	}
}
$ly = date('Y-m', strtotime('last day of previous month', strtotime ($d) ) );
									if( date('d', strtotime('last day of previous month', strtotime ($d) ) ) >= $date44){
	$sql6 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date BETWEEN '$date444' AND '$date4' and Branch = '" . $n . "'";
	}else{
	$sql6 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date like '$ly%' and Branch = '" . $n . "'";
	
	}
	$result = mysqli_query($conn, $sql6);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$sale2 = $row["sum1"]-$row["sum3"];
	}
}
if ($sale1 == 0.00) {
	$salea[0] = number_format((float)$sale1 - $sale2, 2, '.', '');
	$salea[1] = -$sale2;
	$salea[1] = number_format((float)$salea[1], 2, '.', ',');
	$salea[0] = number_format((float)$sale1 - $sale2, 2, '.', ',');
}
if ($sale2 == 0.00) {
	$salea[0] = number_format((float)$sale1 - $sale2, 2, '.', '');
	$salea[1] = $sale1;
	$salea[1] = number_format((float)$salea[1], 2, '.', ',');
	$salea[0] = number_format((float)$sale1 - $sale2, 2, '.', ',');
}
if ($sale2 == 0.00 && $sale1 == 0.00) {
	$salea[0] = 0.00;
	$salea[1] = 0.00;
	$salea[1] = number_format((float)$salea[1], 2, '.', ',');
	$salea[0] = number_format((float)$sale1 - $sale2, 2, '.', ',');
}
if ($sale2 > 0.00 && $sale1 > 0.00) {
	$salea[0] = number_format((float)$sale1 - $sale2, 2, '.', '');
	$salea[1] = (($salea[0] / $sale2) * 100);
	$salea[1] = number_format((float)$salea[1], 2, '.', ',');
	$salea[0] = number_format((float)$sale1 - $sale2, 2, '.', ',');
}
if ($salea[0] > 0) {
	$ajax = $ajax . "###" . '<b>Rs<br>' . $salea[0] . '<br>Percentage<br>' . $salea[1] . '%</b><br><i class="fas fa-angle-double-up" style="font-size:58px;color:green"></i></center></p>';
} else if ($salea[0] <= 0) {
	$ajax = $ajax . "###" . '<b>Rs<br>' . $salea[0] . '<br>Percentage<br>' . $salea[1] . '</b>%<br><i class="fas fa-angle-double-down" style="font-size:58px;color:red"></i></center></p>';
}

$cashc = 0.00;
$creditc = 0.00;
$chequec = 0.00;
$cardc = 0.00;

$today = date('Y-m-d',(strtotime ( '-0 days' , strtotime ($d) ) ));
$sql = "select sum(Sales_Volume) as sum1, sum(Return_m) as sum3 from sales where Method = 'Cash' and Date = '$today' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$cashc = $row["sum1"] - $row["sum3"];
	}
}
if ($cashc == "") {
	$cashc = 0.00;
}
$cashc = number_format((float)$cashc, 2, '.', ',');
$ajax = $ajax . "###" . $cashc;
$sql = "select sum(Sales_Volume) as sum1, sum(Return_m) as sum3 from sales where Method = 'Cheque' and Date = '$today' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$chequec = $row["sum1"] - $row["sum3"];
	}
}
if ($chequec == "") {
	$chequec = 0.00;
}
$chequec = number_format((float)$chequec, 2, '.', ',');
$ajax = $ajax . "###" . $chequec;

$sql = "select sum(Sales_Volume) as sum1, sum(Return_m) as sum3 from sales where Method = 'Card' and Date = '$today' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$cardc = $row["sum1"] - $row["sum3"];
	}
}
if ($cardc == "") {
	$cardc = 0.00;
}
$cardc = number_format((float)$cardc, 2, '.', ',');
$ajax = $ajax . "###" . $cardc;

$sql = "select sum(Sales_Volume) as sum1, sum(Return_m) as sum3 from sales where Method = 'Credit' and Date = '$today' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$creditc = $row["sum1"] - $row["sum3"];
	}
}
if ($creditc == "") {
	$creditc = 0.00;
}
$creditc = number_format((float)$creditc, 2, '.', ',');

$ajax = $ajax . "###" . $creditc;
$date2 = $today = date('Y-m-d',(strtotime ( '-0 days' , strtotime ($d) ) ));
	$sql4 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date = '$date2' and Branch = '" . $n . "'";
	$result = mysqli_query($conn, $sql4);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$tsale[0] = $row["sum1"]-$row["sum3"];
			$tsale[1] = $row["sum2"];
		}
	}
$ajax = $ajax . "###" . $tsale[0] . "###" . $tsale[1];
$date2 =  date('Y-m-d',(strtotime ( '-1 day' , strtotime ($d) ) ));
$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2 from sales where Date = '$date2' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$gross = $row["sum1"];
		$gross = number_format((float)$gross, 2, '.', ',');
	}
}
$ajax = $ajax . "###" . 'Rs<br>' . $gross;
$date2 =  date('Y-m-d',(strtotime ( '-1 day' , strtotime ($d) ) ));
$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date = '$date2' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$return = $row["sum3"];
		$return = number_format((float)$row["sum3"], 2, '.', ',');
	}
}
$ajax = $ajax . "###" . 'Rs<br>' . $return;
$row["sum1"] = 0.00;
$row["sum2"] = 0.00;
$date2 = date('Y-m',(strtotime ( '-0 month' , strtotime ($d) ) ));
$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3  from sales where Date like '$date2%' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$row["sum1"] = number_format((float)$row["sum1"], 2, '.', ',');
		$grosstm = $row["sum1"];
	}
}
$ajax = $ajax . "###" . 'Rs<br>' . $grosstm;
$row["sum1"] = 0.00;
$row["sum2"] = 0.00;
$date2 = date('Y-m',(strtotime ( '-0 month' , strtotime ($d) ) ));
$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3  from sales where Date like '$date2%' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$row["sum3"] = number_format((float)$row["sum3"], 2, '.', ',');
		$returntm = $row["sum3"];
	}
}
$ajax = $ajax . "###" . 'Rs<br>' . $returntm;
$row["sum1"] = 0.00;
$row["sum2"] = 0.00;
$date = date('Y-m',(strtotime ( '-0 days' , strtotime ($d) ) ));
$date = date('Y-m',(strtotime ( '-1 month' , strtotime ($date) ) ));

$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3  from sales where Date like '$date%' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$row["sum1"] = number_format((float)$row["sum1"], 2, '.', ',');
		$grosslm = $row["sum1"];
	}
}
$ajax = $ajax . "###" . 'Rs<br>' . $grosslm;
$row["sum1"] = 0.00;
$row["sum2"] = 0.00;
$date = date('Y-m',(strtotime ( '-0 days' , strtotime ($d) ) ));
$date = date('Y-m',(strtotime ( '-1 month' , strtotime ($date) ) ));
$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3  from sales where Date like '$date%' and Branch = '" . $n . "'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$row["sum3"] = number_format((float)$row["sum3"], 2, '.', ',');
		$returnlm = $row["sum3"];
	}
}
$ajax = $ajax . "###" . 'Rs<br>' . $returnlm;
echo $ajax;

}
?>