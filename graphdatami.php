<?php
include "config.php";
?>
<?php


if (isset($_GET['n'])) {
	$ng = $_GET['n'];
	$d = $_GET['day'];
	if($ng=="t"){
	$year = date('Y',(strtotime ( '-0 day' , strtotime ($d) ) ));
			for ($j = 0; $j <= 11; $j++) {
			$j++;
				if ($j < 10) {
				
					$sql1 = "select sum(Invoice_Volume) as sum1 from sales where Date like '$year-0$j%'";
				} else {
					$sql1 = "select sum(Invoice_Volume) as sum1 from sales where Date like '$year-$j%'";
				}
				$j--;
				$result = mysqli_query($conn, $sql1);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$graph[$j] = $row["sum1"];
					}
				}
			}

for ($j = 0; $j <= 11; $j++) {
				if ($graph[$j] == "") {
					$graph[$j] = 0;
				}
			}
		
	}else{

	$year = date('Y',(strtotime ( '-0 day' , strtotime ($d) ) ));
			for ($j = 0; $j <= 11; $j++) {
			$j++;
				if ($j < 10) {
					$sql1 = "select sum(Invoice_Volume) as sum1 from sales where Date like '$year-0$j%' and Branch = '" . $ng . "'";
				} else {
					$sql1 = "select sum(Invoice_Volume) as sum1 from sales where Date like '$year-$j%' and Branch = '" . $ng . "'";
				}
				$j--;
				$result = mysqli_query($conn, $sql1);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$graph[$j] = $row["sum1"];
					}
				}
			}

	for ($j = 0; $j <= 11; $j++)  {
				if ($graph[$j] == "") {
					$graph[$j] = 0;
				}
			}
	}
	echo json_encode($graph);
} else {
	echo "0";
}

?> 


