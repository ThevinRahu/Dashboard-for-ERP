<?php
include "config.php";
?>
<?php
		$sql = "select Theme from theme where ID = 1";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
		$theme = $row["Theme"];
		}
		}
		if($theme == "Bright"){
		$sql = "UPDATE theme SET Theme ='Dark' WHERE ID=1";
				if ($conn->query($sql) === TRUE) {

}else{

		}
		}else{
		$sql = "UPDATE theme SET Theme ='Bright' WHERE ID=1";
		if ($conn->query($sql) === TRUE) {
		

}else{

		}
		}
		$sql = "select Theme from theme where ID = 1";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
		$theme = $row["Theme"];
		}
		}
		
		echo $theme;
		?>