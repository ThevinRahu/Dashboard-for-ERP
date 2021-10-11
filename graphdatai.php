<?php
include "config.php";
?>
<?php


if (isset($_GET['n'])) {
	$ng = $_GET['n'];
	$d = $_GET['day'];
	if($ng=="t"){
	$date2 = date('Y-m',(strtotime ( '-0 day' , strtotime ($d) ) ));
	$day = array("$date2-01", "$date2-02", "$date2-03", "$date2-04", "$date2-05", "$date2-06", "$date2-07", "$date2-08", "$date2-09", "$date2-10", "$date2-11", "$date2-12", "$date2-13", "$date2-14", "$date2-15", "$date2-16", "$date2-17", "$date2-18", "$date2-19", "$date2-20", "$date2-21", "$date2-22", "$date2-23", "$date2-24", "$date2-25", "$date2-26", "$date2-27", "$date2-28", "$date2-29", "$date2-30", "$date2-31");
	for ($i = 0; $i <= 30; $i++) {

		$sql1 = "select sum(Invoice_Volume) as sum1 from sales where Date = '$day[$i]'";
		$result = mysqli_query($conn, $sql1);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$graph[$i] = $row["sum1"];
			}
		}
	}

	for ($i = 0; $i <= 30; $i++) {
		if ($graph[$i] == "") {
			$graph[$i] = 0;
		}
	}
		
	}else{

	$date2 = date('Y-m',(strtotime ( '-0 day' , strtotime ($d) ) ));
	$day = array("$date2-01", "$date2-02", "$date2-03", "$date2-04", "$date2-05", "$date2-06", "$date2-07", "$date2-08", "$date2-09", "$date2-10", "$date2-11", "$date2-12", "$date2-13", "$date2-14", "$date2-15", "$date2-16", "$date2-17", "$date2-18", "$date2-19", "$date2-20", "$date2-21", "$date2-22", "$date2-23", "$date2-24", "$date2-25", "$date2-26", "$date2-27", "$date2-28", "$date2-29", "$date2-30", "$date2-31");
	for ($i = 0; $i <= 30; $i++) {

		$sql1 = "select sum(Invoice_Volume) as sum1 from sales where Date = '$day[$i]'and Branch = '" . $ng . "'";
		$result = mysqli_query($conn, $sql1);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$graph[$i] = $row["sum1"];
			}
		}
	}

	for ($i = 0; $i <= 30; $i++) {
		if ($graph[$i] == "") {
			$graph[$i] = 0;
		}
	}
	}
	echo json_encode($graph);
} else {
	echo "0";
}

?> 