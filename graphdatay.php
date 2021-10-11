<?php
include "config.php";
?>
<?php


if (isset($_GET['n'])) {
	$ng = $_GET['n'];
	$d = $_GET['day'];
	if($ng=="t"){
	$year = date('Y',(strtotime ( '-0 day' , strtotime ($d) ) ));
			$years = array($year - 10, $year - 9, $year - 8, $year - 7, $year - 6, $year - 5, $year - 4, $year - 3, $year - 2, $year - 1, $year);
			for ($i = 0; $i <= 10; $i++) {

				$sql1 = "select sum(Sales_Volume) as sum1, sum(Return_m) as sum3 from sales where Date like '$years[$i]%'";
				$result = mysqli_query($conn, $sql1);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$graph[$i] = $row["sum1"]-$row["sum3"];
					}
				}
			}

for ($i = 0; $i <= 10; $i++) {
				if ($graph[$i] == "") {
					$graph[$i] = 0;
				}
			}
		
	}else{

		$year = date('Y',(strtotime ( '-0 day' , strtotime ($d) ) ));
			$years = array($year - 10, $year - 9, $year - 8, $year - 7, $year - 6, $year - 5, $year - 4, $year - 3, $year - 2, $year - 1, $year);
			for ($i = 0; $i <= 10; $i++) {

				$sql1 = "select sum(Sales_Volume) as sum1, sum(Return_m) as sum3 from sales where Date like '$years[$i]%' and Branch = '" . $ng . "'";
				$result = mysqli_query($conn, $sql1);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$graph[$i] = $row["sum1"]-$row["sum3"];
					}
				}
			}
			for ($i = 0; $i <= 10; $i++) {
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


