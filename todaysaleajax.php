<?php
include "config.php";
?>
<?php
$ng = $_GET['a'];
	$day = $_GET['b'];
	$method = $_GET['c'];
if($ng=="t"){
		$sql1 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date = '$day' and Method = '$method'";
		$result = mysqli_query($conn, $sql1);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$netsale = $row["sum1"]-$row["sum3"];
				$invoice = $row["sum2"];
				$grosssale = $row["sum1"];
				$return = $row["sum3"];
			}
		}
	
		
	}else{

		$sql1 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date = '$day' and Method = '$method' and Branch = '$ng'";
		$result = mysqli_query($conn, $sql1);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$netsale = $row["sum1"]-$row["sum3"];
				$invoice = $row["sum2"];
				$grosssale = $row["sum1"];
				$return = $row["sum3"];
			}
		}
	}
	if($netsale == ""){
		$netsale = 0;
				$invoice = 0;
				$grosssale = 0;
				$return = 0;
	}
	$netsale = number_format((float)$netsale, 2, '.', ',');
	
	$grosssale = number_format((float)$grosssale, 2, '.', ',');
	$return = number_format((float)$return, 2, '.', ',');
$ajax =  $day . "###" .$netsale . "###" . $invoice."###".$grosssale . "###" . $return. "###" . $netsale;
echo $ajax;
?>