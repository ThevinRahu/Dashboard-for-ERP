
<html>
<head>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  <script  src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script  src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="jquery-3.5.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
  
<script type="text/javascript">

var dataSet = [ ];
 
$(function(){
    $("#example").dataTable();
  })
var a = localStorage.getItem('storageName1');
var b = localStorage.getItem('storageName2');
var c = localStorage.getItem('storageName3');

		$.ajax({
				url: 'todaysaleajax.php',
				type: 'GET',
				data: {
					a: a,
					b: b,
					c: c
				},
				success: function(data) {
				console.log(data);
				var dataSet = [ ];
					var res = data.split("###");
					$('#t1').html(res[0]);
					$('#t2').html(res[1]);
					$('#t3').html(res[2]);
					$('#t4').html(res[3]);
					$('#t5').html(res[4]);
					$('#t6').html(res[5]);
					
				
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					//case error
				}
			});
</script>
</head>
<body>
<center><h1>Today Sales</h1></center>
<table id="example" class="display table" style="width:100%;">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Net Sales(Rs)</th>
                <th>Invoices</th>
                <th>Gross Sales(Rs)</th>
                <th>Return(Rs)</th>
                <th>Total Net Sales(Rs)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th id = "t1"></th>
                <th id = "t2"></th>
                <th id = "t3"></th>
                <th id = "t4"></th>
                <th id = "t5"></th>
                <th id = "t6"></th>
            </tr>
        </tbody>
    </table>
</body>
</html>