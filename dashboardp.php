<?php
include "config.php";
?>

<html>

<head>

    <title>Dashboard</title>
    <link rel="shortcut icon" href="images/2.png" />


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .table {
        border-collapse: collapse;
        width: 100%;
        position: absolute;

    }

    .t1 {
        color: white;
        margin-top: 0px;
        font-size: 25px;

        font-family: Arial, Helvetica, sans-serif;

    }

    .img1 {
        height: 32px;
        width: 8%;

    }

    .d1 {
        margin-top: 0px;
        padding-top: 0px;
        margin-right: 0px;
        border-color: black;
        color: #999999;
        background: #333333;
        border-radius: 10px;

    }

    .t0 {
        margin-right: 0px;
        padding-right: 0px;
    }

    .tt {
        margin-left: 10px;
    }

    .dash11 {

        padding-left: 100px;
    }

    .div1 {
        margin-right: 900px;
        padding: 5px;
        border-radius: 8px;
    }

    .btn {
        padding-left: 50px;
    }

    .searchbtn {
        background-color: dodgerblue;
        border: none;
        color: white;
        padding: 7px 7px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 100%;
    }


    .searchbtn:hover {
        background-color: RoyalBlue;
    }

    #cash:hover {
        background-color: #ffb3b3;
    }

    #credit:hover {
        background-color: #ffb3b3;
    }

    #cheque:hover {
        background-color: #ffb3b3;
    }

    #card:hover {
        background-color: #ffb3b3;
    }
    </style>
    <?php
	$date2 = date("Y-m-d");
	$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date = '$date2'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$data1 = $row["sum1"]-$row["sum3"];
			$data2 = $row["sum2"];
		}
	}
	$day = array(date("Y-m-01"), date("Y-m-02"), date("Y-m-03"), date("Y-m-04"), date("Y-m-05"), date("Y-m-06"), date("Y-m-07"), date("Y-m-08"), date("Y-m-09"), date("Y-m-10"), date("Y-m-11"), date("Y-m-12"), date("Y-m-13"), date("Y-m-14"), date("Y-m-15"), date("Y-m-16"), date("Y-m-17"), date("Y-m-18"), date("Y-m-19"), date("Y-m-20"), date("Y-m-21"), date("Y-m-22"), date("Y-m-23"), date("Y-m-24"), date("Y-m-25"), date("Y-m-26"), date("Y-m-27"), date("Y-m-28"), date("Y-m-29"), date("Y-m-30"), date("Y-m-31"));
	for ($i = 0; $i <= 30; $i++) {

		$sql1 = "select sum(Sales_Volume) as sum1, sum(Return_m) as sum3 from sales where Date = '$day[$i]'";
		$result = mysqli_query($conn, $sql1);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$graph[$i] = $row["sum1"]-$row["sum3"];
			}
		}
	}
	
	
	
	for ($i = 0; $i <= 30; $i++) {
		if ($graph[$i] == "") {
			$graph[$i] = 0;
		}
	}
	
	
	
	$day = array(date("Y-m-01"), date("Y-m-02"), date("Y-m-03"), date("Y-m-04"), date("Y-m-05"), date("Y-m-06"), date("Y-m-07"), date("Y-m-08"), date("Y-m-09"), date("Y-m-10"), date("Y-m-11"), date("Y-m-12"), date("Y-m-13"), date("Y-m-14"), date("Y-m-15"), date("Y-m-16"), date("Y-m-17"), date("Y-m-18"), date("Y-m-19"), date("Y-m-20"), date("Y-m-21"), date("Y-m-22"), date("Y-m-23"), date("Y-m-24"), date("Y-m-25"), date("Y-m-26"), date("Y-m-27"), date("Y-m-28"), date("Y-m-29"), date("Y-m-30"), date("Y-m-31"));

	for ($i = 0; $i <= 30; $i++) {
		$sql1 = "select sum(Invoice_Volume) as sum1 from sales where Date = '$day[$i]'";
		$result = mysqli_query($conn, $sql1);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$graphi[$i] = $row["sum1"];
			}
		}
	}
	
	for ($i = 0; $i <= 30; $i++) {
		if ($graphi[$i] == "") {
			$graphi[$i] = 0.00;
		}
	}
	$sql = "select Theme from theme where ID = 1";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
		$theme = $row["Theme"];
		}
		}
	
	?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <!--<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
    <script type="text/javascript" src="js/canvasjs.min.js"></script>
    <script type="text/javascript">
    var n = "t";
    var i, j;
    i = "<?php echo "$data1" ?>";
    j = "<?php echo "$data2" ?>";

    i = parseFloat(i);
    j = parseFloat(j);

    google.charts.load('current', {
        'packages': ['gauge']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Sales Rs.', i],

        ]);

        var options = {
            width: 820,
            height: 170,
            minorTicks: 50,
            max: 500000
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_divs'));

        chart.draw(data, options);



        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Invoices', j],

        ]);

        var options = {
            width: 750,
            height: 170,
            minorTicks: 50,
            max: 1000
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_divi'));

        chart.draw(data, options);

    }








    window.onload = function() {

        var chart = new CanvasJS.Chart("chart_div2", {
            animationEnabled: true,
            zoomEnabled: true,
            theme: "dark2",
            title: {
                text: "Date vs Net Sales"
            },
            axisX: {
                title: "Date",
                valueFormatString: "####",
                interval: 1,
                maximum: 31
            },
            axisY: {
                logarithmic: false, //change it to false
                title: "Sales(Rs)",
                titleFontColor: "#6D78AD",
                lineColor: "#6D78AD",
                gridThickness: 0,
                lineThickness: 1,
                labelFormatter: addSymbols,

            },


            data: [{
                    type: "line",
                    lineColor: "#1aff1a",
                    xValueFormatString: "####",
                    showInLegend: false,
                    name: "Total",
                    dataPoints: [{
                            x: 1,
                            y: parseFloat("<?php echo "$graph[0]" ?>")
                        },
                        {
                            x: 2,
                            y: parseFloat("<?php echo "$graph[1]" ?>")
                        },
                        {
                            x: 3,
                            y: parseFloat("<?php echo "$graph[2]" ?>")
                        },
                        {
                            x: 4,
                            y: parseFloat("<?php echo "$graph[3]" ?>")
                        },
                        {
                            x: 5,
                            y: parseFloat("<?php echo "$graph[4]" ?>")
                        },
                        {
                            x: 6,
                            y: parseFloat("<?php echo "$graph[5]" ?>")
                        },
                        {
                            x: 7,
                            y: parseFloat("<?php echo "$graph[6]" ?>")
                        },
                        {
                            x: 8,
                            y: parseFloat("<?php echo "$graph[7]" ?>")
                        },
                        {
                            x: 9,
                            y: parseFloat("<?php echo "$graph[8]" ?>")
                        },
                        {
                            x: 10,
                            y: parseFloat("<?php echo "$graph[9]" ?>")
                        },
                        {
                            x: 11,
                            y: parseFloat("<?php echo "$graph[10]" ?>")
                        },
                        {
                            x: 12,
                            y: parseFloat("<?php echo "$graph[11]" ?>")
                        },
                        {
                            x: 13,
                            y: parseFloat("<?php echo "$graph[12]" ?>")
                        },
                        {
                            x: 14,
                            y: parseFloat("<?php echo "$graph[13]" ?>")
                        },
                        {
                            x: 15,
                            y: parseFloat("<?php echo "$graph[14]" ?>")
                        },
                        {
                            x: 16,
                            y: parseFloat("<?php echo "$graph[15]" ?>")
                        },
                        {
                            x: 17,
                            y: parseFloat("<?php echo "$graph[16]" ?>")
                        },
                        {
                            x: 18,
                            y: parseFloat("<?php echo "$graph[17]" ?>")
                        },
                        {
                            x: 19,
                            y: parseFloat("<?php echo "$graph[18]" ?>")
                        },
                        {
                            x: 20,
                            y: parseFloat("<?php echo "$graph[19]" ?>")
                        },
                        {
                            x: 21,
                            y: parseFloat("<?php echo "$graph[20]" ?>")
                        },
                        {
                            x: 22,
                            y: parseFloat("<?php echo "$graph[21]" ?>")
                        },
                        {
                            x: 23,
                            y: parseFloat("<?php echo "$graph[22]" ?>")
                        },
                        {
                            x: 24,
                            y: parseFloat("<?php echo "$graph[23]" ?>")
                        },
                        {
                            x: 25,
                            y: parseFloat("<?php echo "$graph[24]" ?>")
                        },
                        {
                            x: 26,
                            y: parseFloat("<?php echo "$graph[25]" ?>")
                        },
                        {
                            x: 27,
                            y: parseFloat("<?php echo "$graph[26]" ?>")
                        },
                        {
                            x: 28,
                            y: parseFloat("<?php echo "$graph[27]" ?>")
                        },
                        {
                            x: 29,
                            y: parseFloat("<?php echo "$graph[28]" ?>")
                        },
                        {
                            x: 30,
                            y: parseFloat("<?php echo "$graph[29]" ?>")
                        },
                        {
                            x: 31,
                            y: parseFloat("<?php echo "$graph[30]" ?>")
                        }
                    ]
                },

            ]
        });
        chart.render();

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }
        var chart = new CanvasJS.Chart("chart_div3", {
            animationEnabled: true,
            zoomEnabled: true,
            theme: "dark2",
            title: {
                text: "Date vs Invoices"
            },
            axisX: {
                title: "Date",
                valueFormatString: "####",
                interval: 1,
                maximum: 31
            },
            axisY: {
                logarithmic: false, //change it to false
                title: "Invoices",
                titleFontColor: "#6D78AD",
                lineColor: "#6D78AD",
                gridThickness: 0,
                lineThickness: 1,
                labelFormatter: addSymbols,

            },

            data: [{
                type: "line",
                lineColor: "#1aff1a",
                xValueFormatString: "####",
                showInLegend: false,
                name: "Total",
                dataPoints: [{
                        x: 1,
                        y: parseFloat("<?php echo "$graphi[0]" ?>")
                    },
                    {
                        x: 2,
                        y: parseFloat("<?php echo "$graphi[1]" ?>")
                    },
                    {
                        x: 3,
                        y: parseFloat("<?php echo "$graphi[2]" ?>")
                    },
                    {
                        x: 4,
                        y: parseFloat("<?php echo "$graphi[3]" ?>")
                    },
                    {
                        x: 5,
                        y: parseFloat("<?php echo "$graphi[4]" ?>")
                    },
                    {
                        x: 6,
                        y: parseFloat("<?php echo "$graphi[5]" ?>")
                    },
                    {
                        x: 7,
                        y: parseFloat("<?php echo "$graphi[6]" ?>")
                    },
                    {
                        x: 8,
                        y: parseFloat("<?php echo "$graphi[7]" ?>")
                    },
                    {
                        x: 9,
                        y: parseFloat("<?php echo "$graphi[8]" ?>")
                    },
                    {
                        x: 10,
                        y: parseFloat("<?php echo "$graphi[9]" ?>")
                    },
                    {
                        x: 11,
                        y: parseFloat("<?php echo "$graphi[10]" ?>")
                    },
                    {
                        x: 12,
                        y: parseFloat("<?php echo "$graphi[11]" ?>")
                    },
                    {
                        x: 13,
                        y: parseFloat("<?php echo "$graphi[12]" ?>")
                    },
                    {
                        x: 14,
                        y: parseFloat("<?php echo "$graphi[13]" ?>")
                    },
                    {
                        x: 15,
                        y: parseFloat("<?php echo "$graphi[14]" ?>")
                    },
                    {
                        x: 16,
                        y: parseFloat("<?php echo "$graphi[15]" ?>")
                    },
                    {
                        x: 17,
                        y: parseFloat("<?php echo "$graphi[16]" ?>")
                    },
                    {
                        x: 18,
                        y: parseFloat("<?php echo "$graphi[17]" ?>")
                    },
                    {
                        x: 19,
                        y: parseFloat("<?php echo "$graphi[18]" ?>")
                    },
                    {
                        x: 20,
                        y: parseFloat("<?php echo "$graphi[19]" ?>")
                    },
                    {
                        x: 21,
                        y: parseFloat("<?php echo "$graphi[20]" ?>")
                    },
                    {
                        x: 22,
                        y: parseFloat("<?php echo "$graphi[21]" ?>")
                    },
                    {
                        x: 23,
                        y: parseFloat("<?php echo "$graphi[22]" ?>")
                    },
                    {
                        x: 24,
                        y: parseFloat("<?php echo "$graphi[23]" ?>")
                    },
                    {
                        x: 25,
                        y: parseFloat("<?php echo "$graphi[24]" ?>")
                    },
                    {
                        x: 26,
                        y: parseFloat("<?php echo "$graphi[25]" ?>")
                    },
                    {
                        x: 27,
                        y: parseFloat("<?php echo "$graphi[26]" ?>")
                    },
                    {
                        x: 28,
                        y: parseFloat("<?php echo "$graphi[27]" ?>")
                    },
                    {
                        x: 29,
                        y: parseFloat("<?php echo "$graphi[28]" ?>")
                    },
                    {
                        x: 30,
                        y: parseFloat("<?php echo "$graphi[29]" ?>")
                    },
                    {
                        x: 31,
                        y: parseFloat("<?php echo "$graphi[30]" ?>")
                    }
                ]


            }]
        });
        chart.render();

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }


        var chart = new CanvasJS.Chart("chart_div4", {
            animationEnabled: true,
            zoomEnabled: true,
            theme: "dark2",
            title: {
                text: "Date vs Sales(Rs) and Invoices"
            },
            axisX: {
                title: "Date",
                valueFormatString: "####",
                interval: 1
            },
            axisY: {
                logarithmic: false, //change it to false
                title: "Sales(Rs)",
                titleFontColor: "#6D78AD",
                lineColor: "#6D78AD",
                gridThickness: 0,
                lineThickness: 1,
                labelFormatter: addSymbols
            },
            axisY2: {
                title: "Invoices",
                titleFontColor: "#51CDA0",
                logarithmic: false, //change it to true
                lineColor: "#51CDA0",
                gridThickness: 0,
                lineThickness: 1,
                labelFormatter: addSymbols
            },
            legend: {
                verticalAlign: "top",
                fontSize: 16,
                dockInsidePlotArea: true
            },
            data: [{
                    type: "line",
                    xValueFormatString: "####",
                    showInLegend: true,
                    name: "Sales(Rs)",
                    dataPoints: [{
                            x: 1,
                            y: parseFloat("<?php echo "$graph[0]" ?>")
                        },
                        {
                            x: 2,
                            y: parseFloat("<?php echo "$graph[1]" ?>")
                        },
                        {
                            x: 3,
                            y: parseFloat("<?php echo "$graph[2]" ?>")
                        },
                        {
                            x: 4,
                            y: parseFloat("<?php echo "$graph[3]" ?>")
                        },
                        {
                            x: 5,
                            y: parseFloat("<?php echo "$graph[4]" ?>")
                        },
                        {
                            x: 6,
                            y: parseFloat("<?php echo "$graph[5]" ?>")
                        },
                        {
                            x: 7,
                            y: parseFloat("<?php echo "$graph[6]" ?>")
                        },
                        {
                            x: 8,
                            y: parseFloat("<?php echo "$graph[7]" ?>")
                        },
                        {
                            x: 9,
                            y: parseFloat("<?php echo "$graph[8]" ?>")
                        },
                        {
                            x: 10,
                            y: parseFloat("<?php echo "$graph[9]" ?>")
                        },
                        {
                            x: 11,
                            y: parseFloat("<?php echo "$graph[10]" ?>")
                        },
                        {
                            x: 12,
                            y: parseFloat("<?php echo "$graph[11]" ?>")
                        },
                        {
                            x: 13,
                            y: parseFloat("<?php echo "$graph[12]" ?>")
                        },
                        {
                            x: 14,
                            y: parseFloat("<?php echo "$graph[13]" ?>")
                        },
                        {
                            x: 15,
                            y: parseFloat("<?php echo "$graph[14]" ?>")
                        },
                        {
                            x: 16,
                            y: parseFloat("<?php echo "$graph[15]" ?>")
                        },
                        {
                            x: 17,
                            y: parseFloat("<?php echo "$graph[16]" ?>")
                        },
                        {
                            x: 18,
                            y: parseFloat("<?php echo "$graph[17]" ?>")
                        },
                        {
                            x: 19,
                            y: parseFloat("<?php echo "$graph[18]" ?>")
                        },
                        {
                            x: 20,
                            y: parseFloat("<?php echo "$graph[19]" ?>")
                        },
                        {
                            x: 21,
                            y: parseFloat("<?php echo "$graph[20]" ?>")
                        },
                        {
                            x: 22,
                            y: parseFloat("<?php echo "$graph[21]" ?>")
                        },
                        {
                            x: 23,
                            y: parseFloat("<?php echo "$graph[22]" ?>")
                        },
                        {
                            x: 24,
                            y: parseFloat("<?php echo "$graph[23]" ?>")
                        },
                        {
                            x: 25,
                            y: parseFloat("<?php echo "$graph[24]" ?>")
                        },
                        {
                            x: 26,
                            y: parseFloat("<?php echo "$graph[25]" ?>")
                        },
                        {
                            x: 27,
                            y: parseFloat("<?php echo "$graph[26]" ?>")
                        },
                        {
                            x: 28,
                            y: parseFloat("<?php echo "$graph[27]" ?>")
                        },
                        {
                            x: 29,
                            y: parseFloat("<?php echo "$graph[28]" ?>")
                        },
                        {
                            x: 30,
                            y: parseFloat("<?php echo "$graph[29]" ?>")
                        },
                        {
                            x: 31,
                            y: parseFloat("<?php echo "$graph[30]" ?>")
                        }
                    ]
                },
                {
                    type: "line",
                    xValueFormatString: "####",
                    axisYType: "secondary",
                    showInLegend: true,
                    name: "Invoices",
                    dataPoints: [{
                            x: 1,
                            y: parseFloat("<?php echo "$graphi[0]" ?>")
                        },
                        {
                            x: 2,
                            y: parseFloat("<?php echo "$graphi[1]" ?>")
                        },
                        {
                            x: 3,
                            y: parseFloat("<?php echo "$graphi[2]" ?>")
                        },
                        {
                            x: 4,
                            y: parseFloat("<?php echo "$graphi[3]" ?>")
                        },
                        {
                            x: 5,
                            y: parseFloat("<?php echo "$graphi[4]" ?>")
                        },
                        {
                            x: 6,
                            y: parseFloat("<?php echo "$graphi[5]" ?>")
                        },
                        {
                            x: 7,
                            y: parseFloat("<?php echo "$graphi[6]" ?>")
                        },
                        {
                            x: 8,
                            y: parseFloat("<?php echo "$graphi[7]" ?>")
                        },
                        {
                            x: 9,
                            y: parseFloat("<?php echo "$graphi[8]" ?>")
                        },
                        {
                            x: 10,
                            y: parseFloat("<?php echo "$graphi[9]" ?>")
                        },
                        {
                            x: 11,
                            y: parseFloat("<?php echo "$graphi[10]" ?>")
                        },
                        {
                            x: 12,
                            y: parseFloat("<?php echo "$graphi[11]" ?>")
                        },
                        {
                            x: 13,
                            y: parseFloat("<?php echo "$graphi[12]" ?>")
                        },
                        {
                            x: 14,
                            y: parseFloat("<?php echo "$graphi[13]" ?>")
                        },
                        {
                            x: 15,
                            y: parseFloat("<?php echo "$graphi[14]" ?>")
                        },
                        {
                            x: 16,
                            y: parseFloat("<?php echo "$graphi[15]" ?>")
                        },
                        {
                            x: 17,
                            y: parseFloat("<?php echo "$graphi[16]" ?>")
                        },
                        {
                            x: 18,
                            y: parseFloat("<?php echo "$graphi[17]" ?>")
                        },
                        {
                            x: 19,
                            y: parseFloat("<?php echo "$graphi[18]" ?>")
                        },
                        {
                            x: 20,
                            y: parseFloat("<?php echo "$graphi[19]" ?>")
                        },
                        {
                            x: 21,
                            y: parseFloat("<?php echo "$graphi[20]" ?>")
                        },
                        {
                            x: 22,
                            y: parseFloat("<?php echo "$graphi[21]" ?>")
                        },
                        {
                            x: 23,
                            y: parseFloat("<?php echo "$graphi[22]" ?>")
                        },
                        {
                            x: 24,
                            y: parseFloat("<?php echo "$graphi[23]" ?>")
                        },
                        {
                            x: 25,
                            y: parseFloat("<?php echo "$graphi[24]" ?>")
                        },
                        {
                            x: 26,
                            y: parseFloat("<?php echo "$graphi[25]" ?>")
                        },
                        {
                            x: 27,
                            y: parseFloat("<?php echo "$graphi[26]" ?>")
                        },
                        {
                            x: 28,
                            y: parseFloat("<?php echo "$graphi[27]" ?>")
                        },
                        {
                            x: 29,
                            y: parseFloat("<?php echo "$graphi[28]" ?>")
                        },
                        {
                            x: 30,
                            y: parseFloat("<?php echo "$graphi[29]" ?>")
                        },
                        {
                            x: 31,
                            y: parseFloat("<?php echo "$graphi[30]" ?>")
                        }
                    ]
                }
            ]
        });
        chart.render();

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }
        var colo = "<?php echo "$theme" ?>";
        if (colo == "Dark") {
            document.body.style.backgroundColor = "#0A0A0A";
            document.getElementById("ue").style.color = "white";
            document.getElementById("dash").style.color = "white";
            document.getElementById("theme").style.color = "black";
            document.getElementById("theme").style.backgroundColor = "#ffffcc";
            document.getElementById("theme").innerHTML = "Bright";
            document.getElementById("pane12").style.backgroundColor = "Grey";
            document.getElementById("pane13").style.backgroundColor = "Grey";
            document.getElementById("pane14").style.backgroundColor = "Grey";
            document.getElementById("pane15").style.backgroundColor = "Grey";
            document.getElementById("head1").style.color = "Black";
            document.getElementById("head11").style.color = "Black";
            document.getElementById("head12").style.color = "Black";
            document.getElementById("head2").style.color = "Black";
            document.getElementById("head21").style.color = "Black";
            document.getElementById("head22").style.color = "Black";
            document.getElementById("head3").style.color = "Black";
            document.getElementById("head31").style.color = "Black";
            document.getElementById("head32").style.color = "Black";
            document.getElementById("head4").style.color = "Black";
            document.getElementById("chart_divts").style.backgroundColor = "#a6a6a6";
            document.getElementById("tsf").style.backgroundColor = "#9999ff";

        } else {
            document.body.style.backgroundColor = "#ffffe6";
            document.getElementById("ue").style.color = "black";
            document.getElementById("dash").style.color = "black";
            document.getElementById("theme").style.color = "white";
            document.getElementById("theme").style.backgroundColor = "black";
            document.getElementById("theme").innerHTML = "Dark";
            document.getElementById("pane12").style.backgroundColor = "#ffeb99";
            document.getElementById("pane13").style.backgroundColor = "#ffeb99";
            document.getElementById("pane14").style.backgroundColor = "#ffeb99";
            document.getElementById("pane15").style.backgroundColor = "#ffeb99";
            document.getElementById("head1").style.color = "black";
            document.getElementById("head11").style.color = "black";
            document.getElementById("head12").style.color = "black";
            document.getElementById("head2").style.color = "black";
            document.getElementById("head21").style.color = "black";
            document.getElementById("head22").style.color = "black";
            document.getElementById("head3").style.color = "black";
            document.getElementById("head31").style.color = "black";
            document.getElementById("head32").style.color = "black";
            document.getElementById("head4").style.color = "black";
            document.getElementById("chart_divts").style.backgroundColor = "#ffeb99";
            document.getElementById("tsf").style.backgroundColor = "#ffff4d";
        }



    }

    function totalg() {
        $(document).ready(function() {
            $.ajax({
                url: "graphdata.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[i])
                        });
                    }


                    var chart = new CanvasJS.Chart("chart_div2", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Date vs Net Sales(Total)"
                        },
                        axisX: {
                            title: "Date",
                            interval: 1,



                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,


                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            lineColor: "#1aff1a",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });
        $(document).ready(function() {
            $.ajax({
                url: "graphdatai.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[i])
                        });
                    }


                    var chart = new CanvasJS.Chart("chart_div3", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Date vs Invoices(Total)"
                        },
                        axisX: {
                            title: "Date",
                            interval: 1,


                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Invoices",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,


                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            lineColor: "#1aff1a",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });
        $(document).ready(function() {
            $.ajax({
                url: "graphdata2.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {

                    console.log(data);
                    var dataPoints = [];
                    var dataPoints2 = [];

                    for (var i = 0; i < data[0].length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[0][i])
                        });
                    }
                    for (var i = 0; i < data[1].length; i++) {
                        dataPoints2.push({
                            x: i + 1,
                            y: Number(data[1][i])
                        });
                    }


                    var chart = new CanvasJS.Chart("chart_div4", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Date vs Sales(Rs) and Invoices(Total)"
                        },
                        axisX: {
                            title: "Date",
                            valueFormatString: "####",
                            interval: 1
                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        axisY2: {
                            title: "Invoices",
                            titleFontColor: "#51CDA0",
                            logarithmic: false, //change it to true
                            lineColor: "#51CDA0",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            xValueFormatString: "####",
                            showInLegend: true,
                            name: "Sales(Rs)",
                            dataPoints: dataPoints
                        }, {
                            type: "line",
                            xValueFormatString: "####",
                            axisYType: "secondary",
                            showInLegend: true,
                            name: "Invoices",
                            dataPoints: dataPoints2
                        }]
                    });
                    chart.render();

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }
        n = "t";

    }
    var day = "<?php echo date('Y-m-d') ?>";

    function total() {
        $.ajax({
            url: 'branchfuncday.php',
            type: 'GET',
            data: {

                day: day
            },
            success: function(data1) {
                var res1 = data1.split("###");
                $('#yes').html(res1[0]);
                $('#mon').html(res1[1]);
                $('#last').html(res1[2]);
                $('#mom').html(res1[3]);
                $('#cash').html(res1[4]);
                $('#cheque').html(res1[5]);
                $('#card').html(res1[6]);
                $('#credit').html(res1[7]);
                $('#dom-target').html(res1[8]);

                var d3 = document.getElementById("dom-target");
                i = d3.textContent;
                i = parseFloat(i);
                $('#dom-target2').html(res1[9]);
                var d3 = document.getElementById("dom-target2");
                j = d3.textContent;
                j = parseFloat(j);
                drawChart();
                $('#yesg').html(res1[10]);
                $('#yesr').html(res1[11]);
                $('#mong').html(res1[12]);
                $('#monr').html(res1[13]);
                $('#lastg').html(res1[14]);
                $('#lastr').html(res1[15]);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //case error
            }
        });
        n = "t";
    }



    function branch(na) {

        n = na;

        $.ajax({
            url: 'branchfunc.php',
            type: 'GET',
            data: {
                n: n,
                day: day
            },
            success: function(data) {
                var res = data.split("###");
                $('#yes').html(res[0]);
                $('#mon').html(res[1]);
                $('#last').html(res[2]);
                $('#mom').html(res[3]);
                $('#cash').html(res[4]);
                $('#cheque').html(res[5]);
                $('#card').html(res[6]);
                $('#credit').html(res[7]);
                $('#dom-target').html(res[8]);
                var d1 = document.getElementById("dom-target");
                i = d1.textContent;
                i = parseFloat(i);
                $('#dom-target2').html(res[9]);
                var d2 = document.getElementById("dom-target2");
                j = d2.textContent;
                j = parseFloat(j);
                drawChart();
                $('#yesg').html(res[10]);
                $('#yesr').html(res[11]);
                $('#mong').html(res[12]);
                $('#monr').html(res[13]);
                $('#lastg').html(res[14]);
                $('#lastr').html(res[15]);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //case error
            }
        });


    }

    function branchgraph(na) {

        n = na;
        $(document).ready(function() {
            $.ajax({
                url: "graphdata.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[i])
                        });
                    }


                    var chart = new CanvasJS.Chart("chart_div2", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Date vs Net Sales(" + n + ")"
                        },
                        axisX: {
                            title: "Date",
                            interval: 1,



                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,


                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            lineColor: "#1aff1a",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });
        $(document).ready(function() {
            $.ajax({
                url: "graphdatai.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[i])
                        });
                    }


                    var chart = new CanvasJS.Chart("chart_div3", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Date vs Invoices(" + n + ")"
                        },
                        axisX: {
                            title: "Date",
                            interval: 1,


                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Invoices",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,


                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            lineColor: "#1aff1a",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        $(document).ready(function() {
            $.ajax({
                url: "graphdata2.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {

                    console.log(data);
                    var dataPoints = [];
                    var dataPoints2 = [];

                    for (var i = 0; i < data[0].length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[0][i])
                        });
                    }
                    for (var i = 0; i < data[1].length; i++) {
                        dataPoints2.push({
                            x: i + 1,
                            y: Number(data[1][i])
                        });
                    }


                    var chart = new CanvasJS.Chart("chart_div4", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Date vs Sales(Rs) and Invoices(" + n + ")"
                        },
                        axisX: {
                            title: "Date",
                            valueFormatString: "####",
                            interval: 1
                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        axisY2: {
                            title: "Invoices",
                            titleFontColor: "#51CDA0",
                            logarithmic: false, //change it to true
                            lineColor: "#51CDA0",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            xValueFormatString: "####",
                            showInLegend: true,
                            name: "Sales(Rs)",
                            dataPoints: dataPoints
                        }, {
                            type: "line",
                            xValueFormatString: "####",
                            axisYType: "secondary",
                            showInLegend: true,
                            name: "Invoices",
                            dataPoints: dataPoints2
                        }]
                    });
                    chart.render();

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }

    }

    function daily() {


        $(document).ready(function() {
            $.ajax({
                url: "graphdata.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[i])
                        });
                    }

                    if (n == "t") {
                        n = "Total";
                    }
                    var chart = new CanvasJS.Chart("chart_div2", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Date vs Net Sales(" + n + ")"
                        },
                        axisX: {
                            title: "Date",
                            interval: 1,



                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,


                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            lineColor: "#1aff1a",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();
                    if (n == "Total") {
                        n = "t";
                    }

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }


    }


    function monthly() {

        $(document).ready(function() {
            $.ajax({
                url: "graphdatam.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[i])
                        });
                    }

                    if (n == "t") {
                        n = "Total";
                    }
                    var chart = new CanvasJS.Chart("chart_div2", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Month vs Net Sales(" + n + ")"
                        },

                        axisX: {
                            title: "Month",
                            interval: 1,



                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,


                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            lineColor: "#1aff1a",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();
                    if (n == "Total") {
                        n = "t";
                    }

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }



    }


    function yearly() {

        var year = new Date(day);
        year = year.getFullYear();
        var years = [year - 10, year - 9, year - 8, year - 7, year - 6, year - 5, year - 4, year - 3, year - 2, year -
            1, year
        ];


        $(document).ready(function() {
            $.ajax({
                url: "graphdatay.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {

                        dataPoints.push({
                            x: years[i],
                            y: Number(data[i])
                        });
                    }


                    if (n == "t") {
                        n = "Total";
                    }
                    var chart = new CanvasJS.Chart("chart_div2", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Year vs Net Sales(" + n + ")"
                        },

                        axisX: {
                            title: "Year",
                            interval: 1,
                            valueFormatString: "####",



                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,


                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            lineColor: "#1aff1a",
                            xValueFormatString: "####",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();
                    if (n == "Total") {
                        n = "t";
                    }

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }

    }

    function dailyi() {

        $(document).ready(function() {
            $.ajax({
                url: "graphdatai.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {

                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[i])
                        });
                    }


                    if (n == "t") {
                        n = "Total";
                    }
                    var chart = new CanvasJS.Chart("chart_div3", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Date vs Invoices(" + n + ")"
                        },

                        axisX: {
                            title: "Date",
                            interval: 1,
                            xValueFormatString: "####",



                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Invoices",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,

                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            lineColor: "#1aff1a",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();
                    if (n == "Total") {
                        n = "t";
                    }

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }
    }

    function monthlyi() {

        $(document).ready(function() {
            $.ajax({
                url: "graphdatami.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[i])
                        });
                    }

                    if (n == "t") {
                        n = "Total";
                    }
                    var chart = new CanvasJS.Chart("chart_div3", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Month vs Invoices(" + n + ")"
                        },

                        axisX: {
                            title: "Month",
                            interval: 1,
                            valueFormatString: "####",



                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Invoices",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,


                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            lineColor: "#1aff1a",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();
                    if (n == "Total") {
                        n = "t";
                    }

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }



    }

    function yearlyi() {

        var year = new Date(day);
        year = year.getFullYear();
        var years = [year - 10, year - 9, year - 8, year - 7, year - 6, year - 5, year - 4, year - 3, year - 2, year -
            1, year
        ];


        $(document).ready(function() {
            $.ajax({
                url: "graphdatayi.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {
                    console.log(data);
                    var dataPoints = [];


                    for (var i = 0; i < data.length; i++) {

                        dataPoints.push({
                            x: Number(years[i]),
                            y: Number(data[i])
                        });
                    }


                    if (n == "t") {
                        n = "Total";
                    }
                    var chart = new CanvasJS.Chart("chart_div3", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Year vs Invoices(" + n + ")"
                        },

                        axisX: {
                            title: "Year",
                            interval: 1,
                            valueFormatString: "####",



                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Invoices",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols,


                        },

                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            xValueFormatString: "####",
                            lineColor: "#1aff1a",
                            dataPoints: dataPoints
                        }]
                    });
                    chart.render();
                    if (n == "Total") {
                        n = "t";
                    }

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }

    }

    function dailyb() {
        $(document).ready(function() {
            $.ajax({
                url: "graphdata2.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {

                    console.log(data);
                    var dataPoints = [];
                    var dataPoints2 = [];

                    for (var i = 0; i < data[0].length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[0][i])
                        });
                    }
                    for (var i = 0; i < data[1].length; i++) {
                        dataPoints2.push({
                            x: i + 1,
                            y: Number(data[1][i])
                        });
                    }

                    if (n == "t") {
                        n = "Total";
                    }
                    var chart = new CanvasJS.Chart("chart_div4", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Date vs Sales(Rs) and Invoices(" + n + ")"
                        },
                        axisX: {
                            title: "Date",
                            valueFormatString: "####",
                            interval: 1
                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        axisY2: {
                            title: "Invoices",
                            titleFontColor: "#51CDA0",
                            logarithmic: false, //change it to true
                            lineColor: "#51CDA0",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            xValueFormatString: "####",
                            showInLegend: true,
                            name: "Sales(Rs)",
                            dataPoints: dataPoints
                        }, {
                            type: "line",
                            xValueFormatString: "####",
                            axisYType: "secondary",
                            showInLegend: true,
                            name: "Invoices",
                            dataPoints: dataPoints2
                        }]
                    });
                    chart.render();
                    if (n == "Total") {
                        n = "t";
                    }

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }

    }

    function monthlyb() {
        $(document).ready(function() {
            $.ajax({
                url: "graphdata2m.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {

                    console.log(data);
                    var dataPoints = [];
                    var dataPoints2 = [];

                    for (var i = 0; i < data[0].length; i++) {
                        dataPoints.push({
                            x: i + 1,
                            y: Number(data[0][i])
                        });
                    }
                    for (var i = 0; i < data[1].length; i++) {
                        dataPoints2.push({
                            x: i + 1,
                            y: Number(data[1][i])
                        });
                    }

                    if (n == "t") {
                        n = "Total";
                    }
                    var chart = new CanvasJS.Chart("chart_div4", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Month vs Sales(Rs) and Invoices(" + n + ")"
                        },
                        axisX: {
                            title: "Month",
                            valueFormatString: "####",
                            interval: 1
                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        axisY2: {
                            title: "Invoices",
                            titleFontColor: "#51CDA0",
                            logarithmic: false, //change it to true
                            lineColor: "#51CDA0",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            xValueFormatString: "####",
                            showInLegend: true,
                            name: "Sales(Rs)",
                            dataPoints: dataPoints
                        }, {
                            type: "line",
                            xValueFormatString: "####",
                            axisYType: "secondary",
                            showInLegend: true,
                            name: "Invoices",
                            dataPoints: dataPoints2
                        }]
                    });
                    chart.render();
                    if (n == "Total") {
                        n = "t";
                    }

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }

    }

    function yearlyb() {
        var year = new Date(day);
        year = year.getFullYear();
        var years = [year - 10, year - 9, year - 8, year - 7, year - 6, year - 5, year - 4, year - 3, year - 2, year -
            1, year
        ];
        $(document).ready(function() {
            $.ajax({
                url: "graphdata2y.php",
                method: "GET",
                dataType: 'json',
                data: {
                    n: n,
                    day: day
                },
                success: function(data) {

                    console.log(data);
                    var dataPoints = [];
                    var dataPoints2 = [];

                    for (var i = 0; i < data[0].length; i++) {
                        dataPoints.push({
                            x: years[i],
                            y: Number(data[0][i])
                        });
                    }
                    for (var i = 0; i < data[1].length; i++) {
                        dataPoints2.push({
                            x: years[i],
                            y: Number(data[1][i])
                        });
                    }

                    if (n == "t") {
                        n = "Total";
                    }
                    var chart = new CanvasJS.Chart("chart_div4", {
                        animationEnabled: true,
                        zoomEnabled: true,
                        theme: "dark2",
                        title: {
                            text: "Year vs Sales(Rs) and Invoices(" + n + ")"
                        },
                        axisX: {
                            title: "Year",
                            valueFormatString: "####",
                            interval: 1
                        },
                        axisY: {
                            logarithmic: false, //change it to false
                            title: "Sales(Rs)",
                            titleFontColor: "#6D78AD",
                            lineColor: "#6D78AD",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        axisY2: {
                            title: "Invoices",
                            titleFontColor: "#51CDA0",
                            logarithmic: false, //change it to true
                            lineColor: "#51CDA0",
                            gridThickness: 0,
                            lineThickness: 1,
                            labelFormatter: addSymbols
                        },
                        legend: {
                            verticalAlign: "top",
                            fontSize: 16,
                            dockInsidePlotArea: true
                        },
                        data: [{
                            type: "line",
                            xValueFormatString: "####",
                            showInLegend: true,
                            name: "Sales(Rs)",
                            dataPoints: dataPoints
                        }, {
                            type: "line",
                            xValueFormatString: "####",
                            axisYType: "secondary",
                            showInLegend: true,
                            name: "Invoices",
                            dataPoints: dataPoints2
                        }]
                    });
                    chart.render();
                    if (n == "Total") {
                        n = "t";
                    }

                },
                error: function(data) {
                    console.log(data);
                }


            });


        });

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];

            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
            if (order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }

    }




    function themedb() {

        $.ajax({
            url: 'theme.php',
            type: 'GET',
            data: {


            },
            success: function(data) {
                theme(data);

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //case error
            }
        });
    }

    function theme(col) {

        if (col == "Dark") {
            document.body.style.backgroundColor = "#0A0A0A";
            document.getElementById("ue").style.color = "white";
            document.getElementById("dash").style.color = "white";
            document.getElementById("theme").style.color = "black";
            document.getElementById("theme").style.backgroundColor = "#ffffcc";
            document.getElementById("theme").innerHTML = "Bright";
            document.getElementById("pane12").style.backgroundColor = "Grey";
            document.getElementById("pane13").style.backgroundColor = "Grey";
            document.getElementById("pane14").style.backgroundColor = "Grey";
            document.getElementById("pane15").style.backgroundColor = "Grey";
            document.getElementById("head1").style.color = "Black";
            document.getElementById("head11").style.color = "Black";
            document.getElementById("head12").style.color = "Black";
            document.getElementById("head2").style.color = "Black";
            document.getElementById("head21").style.color = "Black";
            document.getElementById("head22").style.color = "Black";
            document.getElementById("head3").style.color = "Black";
            document.getElementById("head31").style.color = "Black";
            document.getElementById("head32").style.color = "Black";
            document.getElementById("head4").style.color = "Black";
            document.getElementById("chart_divts").style.backgroundColor = "#a6a6a6";
            document.getElementById("tsf").style.backgroundColor = "#9999ff";
        } else {
            document.body.style.backgroundColor = "#ffffe6";
            document.getElementById("ue").style.color = "black";
            document.getElementById("dash").style.color = "black";
            document.getElementById("theme").style.color = "white";
            document.getElementById("theme").style.backgroundColor = "black";
            document.getElementById("theme").innerHTML = "Dark";
            document.getElementById("pane12").style.backgroundColor = "#ffeb99";
            document.getElementById("pane13").style.backgroundColor = "#ffeb99";
            document.getElementById("pane14").style.backgroundColor = "#ffeb99";
            document.getElementById("pane15").style.backgroundColor = "#ffeb99";
            document.getElementById("head1").style.color = "black";
            document.getElementById("head11").style.color = "black";
            document.getElementById("head12").style.color = "black";
            document.getElementById("head2").style.color = "black";
            document.getElementById("head21").style.color = "black";
            document.getElementById("head22").style.color = "black";
            document.getElementById("head3").style.color = "black";
            document.getElementById("head31").style.color = "black";
            document.getElementById("head32").style.color = "black";
            document.getElementById("head4").style.color = "black";
            document.getElementById("chart_divts").style.backgroundColor = "#ffeb99";
            document.getElementById("tsf").style.backgroundColor = "#ffff4d";
        }
    }

    function datesub() {
        day = document.getElementById("date").value;
        alert("Total Sales Details of Date " + day + " Loading...")
        n = "t";
        $.ajax({
            url: 'branchfuncday.php',
            type: 'GET',
            data: {

                day: day
            },
            success: function(data) {
                var res = data.split("###");
                $('#yes').html(res[0]);
                $('#mon').html(res[1]);
                $('#last').html(res[2]);
                $('#mom').html(res[3]);
                $('#cash').html(res[4]);
                $('#cheque').html(res[5]);
                $('#card').html(res[6]);
                $('#credit').html(res[7]);
                $('#dom-target').html(res[8]);
                var d1 = document.getElementById("dom-target");
                i = d1.textContent;
                i = parseFloat(i);
                $('#dom-target2').html(res[9]);
                var d2 = document.getElementById("dom-target2");
                j = d2.textContent;
                j = parseFloat(j);
                drawChart();
                $('#yesg').html(res[10]);
                $('#yesr').html(res[11]);
                $('#mong').html(res[12]);
                $('#monr').html(res[13]);
                $('#lastg').html(res[14]);
                $('#lastr').html(res[15]);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //case error
            }
        });
    }

    function tsales(method) {
        localStorage.setItem("storageName1", n);
        localStorage.setItem("storageName2", day);
        localStorage.setItem("storageName3", method);
        $(document).ready(function() {
            $.colorbox({
                innerWidth: "850px",
                innerHeight: "620px",
                iframe: true,
                href: "todaysalereport.php"
            });
        });
    }
    </script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="/scripts/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="js/colorbox.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/jquery.colorbox.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body style="background-color:#0A0A0A; ">





    <div id="loader" class="loader" style="display:none;">

        <!--<img id="loading-image" src="design/msys/sirh_home/loaderoptimized.gif" alt="Loading..." style="width:10%;height:auto;" />

<img id="loading-image2" src="design/msys/sirh_home/loading.gif" alt="Loading..." style="width:30%;height:auto;" />

-->
    </div>

    <div>

        <table class="table table-responsive">
            <tr>
                <th class="t0"><img src="images/2.png"
                        style="height:47px; width:47%; margin-left:10px; margin-left:0px;"><button id="theme"
                        style="border-radius:40px; height:40px; width 40px; background-color:#ffffcc;"
                        onclick="themedb();">Bright</button></th>
                <th class="t1" id="ue">Unique ERP</th>
                <th class="tt"><a href="dashboardp.php"><img src="images/1.png" class="img1" style=" width:97%;"></a>
                </th>

                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th class="searchbar"><input type="date" id="date" value="<?php echo date('Y-m-d'); ?>" class="d1"></th>
                <th> <button type="submit" class="searchbtn" name="submitdate" onclick="datesub(); totalg();"><i
                            class="fa fa-search"></i></button></th>

                <th style="color:white" id="dash" class="dash11">DASHBOARD</th>
            </tr>
        </table>
    </div>

    <br><br><br><br>

    <div id="pane1" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 maindivstyle">

        <table style="margin-left:75px;">
            <tr>
                <td>
                    <div id="pane12" class="col-xs-12 col-sm-11 col-md-11 col-lg-11 nopaddingbuttopmargin panel"
                        style="background-color:grey; border-radius:8px;  height: 272px; width: 260px; padding:8px 10px 10px 10px">
                        <h4 align="center" style="padding:0px 20px 0px 20px" id="head1">Yesterday</h4>
                        <p style="margin:20px"><b><?php
													
														
														$date2 = date('Y-m-d',strtotime("-1 days"));
														$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date = '$date2'";
														$result = mysqli_query($conn, $sql);
														if ($result->num_rows > 0) {
															while ($row = $result->fetch_assoc()) {
																$nety = $row["sum1"] - $row["sum3"];
																$nety = number_format((float)$nety, 2, '.', ',');
																echo '<center><p id = "yes" style = "font-size:28px; color:#1aff1a">Rs<br>' . $nety . '<br>Inv ' . $row["sum2"] . '</p></center>';
															}
														}
														?>
                                <br>
                                <table>
                                    <tr>
                                        <td>
                                            <h6 style="margin-left:20px; font-size: 14px;" id="head11">
                                                <center>Gross Sales</center><br><?php
																					$date2 = date('Y-m-d',strtotime("-1 days"));
																					$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2 from sales where Date = '$date2'";
																					$result = mysqli_query($conn, $sql);
																					if ($result->num_rows > 0) {
																						while ($row = $result->fetch_assoc()) {
																							$row["sum1"] = number_format((float)$row["sum1"], 2, '.', ',');
																							echo '<center><p id = "yesg" style = "font-size: 13px;">Rs<br>' . $row["sum1"] . '</p></center>';
																						}
																					} ?>
                                            </h6>
                                        </td>
                                        <td style="padding-left:20px;">
                                            <h6 style="margin-left:20px; font-size: 14px;" id="head12">Return<br><br><?php
																								$date2 = date('Y-m-d',strtotime("-1 days"));
																							$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date = '$date2'";
																							$result = mysqli_query($conn, $sql);
																							if ($result->num_rows > 0) {
																								while ($row = $result->fetch_assoc()) {
																									$row["sum3"] = number_format((float)$row["sum3"], 2, '.', ',');
																									echo '<center><p id = "yesr" style = "font-size: 13px;">Rs<br>' . $row["sum3"] . '</p></center>';
																								}
																							} ?> </h6>
                                        </td>
                                        </center>
                                    </tr>
                                </table>
                            </b></p>
                    </div>
                </td>

                <td>
                    <div id="pane13" class="col-xs-12 col-sm-11 col-md-11 col-lg-11 nopaddingbuttopmargin panel"
                        style="background-color:grey; border-radius:8px;  height: 272px; width: 280px; padding:8px 10px 10px 10px">
                        <h4 align="center" style="padding:0px 20px 0px 20px" id="head2">This Month</h4>
                        <p style="margin:20px"><b><?php
														$row["sum1"] = 0.00;
														$row["sum2"] = 0.00;
														$row["sum3"] = 0.00;
														$date2 = date("Y-m");
														$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3  from sales where Date like '$date2%'";
														$result = mysqli_query($conn, $sql);
														if ($result->num_rows > 0) {
															while ($row = $result->fetch_assoc()) {
																$netm = $row["sum1"] - $row["sum3"];
																$netm = number_format((float)$netm, 2, '.', ',');
																echo '<center><p id = "mon" style = "font-size:28px; color:#1aff1a">Rs<br>' . $netm . '<br>Inv ' . $row["sum2"] . '</p></center>';
															}
														}
														?>
                                <br>
                                <table>
                                    <tr>
                                        <td>
                                            <h6 style="margin-left:27px; font-size: 14px;" id="head21">
                                                <center>Gross Sales<br><br></center><?php
																						$row["sum1"] = 0.00;
																						$row["sum2"] = 0.00;
																						$date2 = date("Y-m");
																						$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3  from sales where Date like '$date2%'";
																						$result = mysqli_query($conn, $sql);
																						if ($result->num_rows > 0) {
																							while ($row = $result->fetch_assoc()) {
																								$row["sum1"] = number_format((float)$row["sum1"], 2, '.', ',');
																								echo '<center><p id = "mong" style = "font-size: 13px;">Rs<br>' . $row["sum1"] . '</p></center>';
																							}
																						} ?>
                                            </h6>
                                        </td>
                                        <td style="padding-left:20px;">
                                            <h6 style="margin-left:27px; font-size: 14px;" id="head22">Return<br><br><?php
																							$row["sum1"] = 0.00;
																							$row["sum2"] = 0.00;
																							$date2 = date("Y-m");
																							$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3  from sales where Date like '$date2%'";
																							$result = mysqli_query($conn, $sql);
																							if ($result->num_rows > 0) {
																								while ($row = $result->fetch_assoc()) {
																									$row["sum3"] = number_format((float)$row["sum3"], 2, '.', ',');
																									echo '<center><p id = "monr" style = "font-size: 13px;">Rs<br>' . $row["sum3"] . '</p></center>';
																								}
																							} ?></h6>
                                        </td>
                                    </tr>
                                </table>
                            </b></p>
                    </div>
                </td>
                <td>
                    <div id="pane14" class="col-xs-12 col-sm-11 col-md-11 col-lg-11 nopaddingbuttopmargin panel"
                        style="background-color:grey; border-radius:8px; height: 272px; width: 290px; padding:8px 10px 10px 10px">
                        <h4 align="center" id="head3">Last Month</h4>
                        <p style="margin:20px"><b><?php
														$row["sum1"] = 0.00;
														$row["sum2"] = 0.00;
														$row["sum3"] = 0.00;
														$d = date("Y-m-d");
														$date = date('Y-m',(strtotime ( '-0 days' , strtotime ($d) ) ));
														$date = date('Y-m',(strtotime ( '-1 month' , strtotime ($date) ) ));
														$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date like '$date%'";
														$result = mysqli_query($conn, $sql);
														if ($result->num_rows > 0) {
															while ($row = $result->fetch_assoc()) {
																$netl = $row["sum1"] - $row["sum3"];
																$netl = number_format((float)$netl, 2, '.', ',');
																echo '<center><p id = "last" style = "font-size:28px; color:#1aff1a">Rs<br>' . $netl . '<br>Inv ' . $row["sum2"] . '</p></center>';
															}
														}
														?>
                                <br>
                                <table>
                                    <tr>
                                        <td>
                                            <h6 style="margin-left:27px; font-size: 14px;" id="head31">
                                                <center>Gross Sales</center><br><?php
																					$row["sum1"] = 0.00;
																					$row["sum2"] = 0.00;
																					$date3 = date("m");
																					$d = date("Y-m-d");
																					$date = date('Y-m',(strtotime ( '-0 days' , strtotime ($d) ) ));
																					$date = date('Y-m',(strtotime ( '-1 month' , strtotime ($date) ) ));
																					$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3  from sales where Date like '$date%'";
																					$result = mysqli_query($conn, $sql);
																					if ($result->num_rows > 0) {
																						while ($row = $result->fetch_assoc()) {
																							$row["sum1"] = number_format((float)$row["sum1"], 2, '.', ',');
																							echo '<center><p id = "lastg" style = "font-size: 13px;">Rs<br>' . $row["sum1"] . '</p></center>';
																						}
																					} ?>
                                            </h6>
                                        </td>
                                        <td style="padding-left:20px;">
                                            <h6 style="margin-left:27px; font-size: 14px; " id="head32">Return<br><br><?php
																							$row["sum1"] = 0.00;
																							$row["sum2"] = 0.00;
																							$date3 = date("m");

																							$d = date("Y-m-d");
																							$date = date('Y-m',(strtotime ( '-0 days' , strtotime ($d) ) ));
																							$date = date('Y-m',(strtotime ( '-1 month' , strtotime ($date) ) ));
																							$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3  from sales where Date like '$date%'";
																							$result = mysqli_query($conn, $sql);
																							if ($result->num_rows > 0) {
																								while ($row = $result->fetch_assoc()) {
																									$row["sum3"] = number_format((float)$row["sum3"], 2, '.', ',');
																									echo '<center><p id = "lastr" style = "font-size: 13px;">Rs<br>' . $row["sum3"] . '</p></center>';
																								}
																							} ?></h6>
                                        </td>
                                    </tr>
                                </table>
                            </b></p>
                    </div>
                </td>
                <td>
                    <div id="pane15" class="col-xs-12 col-sm-11 col-md-11 col-lg-11 nopaddingbuttopmargin panel"
                        style="background-color:grey; border-radius:8px; height: 272px; width: 310px; padding:8px 10px 10px 10px">
                        <h4 align="center" style="padding:0px 20px 0px 20px" id="head4">MOM Variance</h4>
                        <p style="margin:20px">
                            <b><?php
									$d = date("Y-m-d");																				
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


									$sql5 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date BETWEEN '$date44444' AND '$datelast'";
									$result = mysqli_query($conn, $sql5);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											$sale1 = $row["sum1"]-$row["sum3"];
										}
									}
									$ly = date('Y-m', strtotime('last day of previous month', strtotime ($d) ) );
																		if( date('d', strtotime('last day of previous month', strtotime ($d) ) ) >= $date44){
										$sql6 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date BETWEEN '$date444' AND '$date4'";
										}else{
										$sql6 = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Date like '$ly%'";
										
										}
									$result = mysqli_query($conn, $sql6);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											$sale2 = $row["sum1"]-$row["sum3"];
										}
									}
									if($sale2 == 0.0){
										
										$sale2 = 1;
									}
									$sale =  number_format((float)$sale1 - $sale2, 2, '.', '');
									$salep = (($sale / $sale2) * 100);
									$salep = number_format((float)$salep, 2, '.', ',');
									$sale =  number_format((float)$sale1 - $sale2, 2, '.', ',');
									if ($sale1 == 0.00) {
		$sale = number_format((float)$sale1 - $sale2, 2, '.', '');
		$salep = - $sale2;
		$salep = number_format((float)$salep, 2, '.', ',');
		$sale = number_format((float)$sale1 - $sale2, 2, '.', ',');
	}
	if ($sale2 == 0.00) {
		$sale = number_format((float)$sale1 - $sale2, 2, '.', '');
		$salep = $sale1;
		$salep = number_format((float)$salep, 2, '.', ',');
		$sale = number_format((float)$sale1 - $sale2, 2, '.', ',');
	}
	if ($sale2 == 0.00 && $sale1 == 0.00) {
		$sale = 0.00;
		$salep = 0.00;
		$salep = number_format((float)$salep, 2, '.', ',');
		$sale = number_format((float)$sale1 - $sale2, 2, '.', ',');
	}
	if ($sale2 > 0.00 && $sale1 > 0.00) {
		$sale = number_format((float)$sale1 - $sale2, 2, '.', '');
		$salep = (($sale / $sale2) * 100);
		$salep = number_format((float)$salep, 2, '.', ',');
		$sale = number_format((float)$sale1 - $sale2, 2, '.', ',');
	}
									if ($sale > 0) {
										echo '<center><p  id = "mom" style = "font-size:28px; color:#1aff1a">Rs<br>' . $sale . '<br>Percentage<br>' . $salep . '%<br><i class="fas fa-angle-double-up" style="font-size:58px;color:green"></i></center></p>';
									} else if ($sale <= 0) {
										echo '<center><p id = "mom" style = "font-size:28px; color:#1aff1a">Rs<br>' . $sale . '<br>Percentage<br>' . $salep . '%<br><i class="fas fa-angle-double-down" style="font-size:58px;color:red"></i></center></p>';
									}
									?>
                        </p>
                    </div>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                    <table style="margin-left:40px;">
                        <tr>
                            <td>

                                <button class="btn btn-outline-danger btn-rounded waves-effect"
                                    onclick="total(); totalg();"
                                    style="padding:2px 35px 2px 33px; width: 100px"><b>Total</b></button>
                            </td><br><br>
                            <?php
								$sql = "select Branch from branch";
								$result = mysqli_query($conn, $sql);
								if ($result->num_rows > 0) {
									$i3 = 1;
									while ($row = $result->fetch_assoc()) {
										if ($i3 % 2 == 0) echo '<tr>';
										echo '<td><button class="btn btn-outline-info btn-rounded waves-effect" onclick = "branch(\'' . $row["Branch"] . '\'); branchgraph(\'' . $row["Branch"] . '\'); call(\'' . $row["Branch"] . '\');" style = "width: 100px; padding:2px 18px 2px 18px;"><b>' . $row["Branch"] . '</b></button></td>';
										if ($i3 % 2 == 1) echo '</tr>';
										$i3++;
									}
								}
								?>
                        </tr>
                    </table>
                </td>
                <td><br><br><br>
                    <div id="chart_divts" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 maindivstyle"
                        style="background-color:#a6a6a6; margin:0px 100px 0px 70px; padding:2px 40px 20px 8px;border-radius:8px;">
                        <h3>
                            <center>Today Sales</center>
                        </h3><br>
                        <center>
                            <div id="chart_div" style="width: 300px; height: 157px;">
                                <table>
                                    <tr>
                                        <td id="chart_divs"></td>
                                        <td id="chart_divi"></td>
                                    </tr>
                                </table>
                            </div>
                        </center>
                    </div>
                </td>

                </td>
                <td>
                    <div id="tsf" class="col-xs-9 col-sm-9 col-md-9 col-lg-9 maindivstyle"
                        style="background-color:#9999ff; margin:60px 0px 0px 140px; border-radius:8px">
                        <?php
							$cash = 0.00;
							$credit = 0.00;
							$cheque = 0.00;
							$card = 0.00;
							$today = date("Y-m-d");
							$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Method = 'Cash' and Date = '$today'";
							$result = mysqli_query($conn, $sql);
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									$cash = $row["sum1"] - $row["sum3"];
								}
							}
							$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Method = 'Cheque' and Date = '$today'";
							$result = mysqli_query($conn, $sql);
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									$cheque = $row["sum1"] - $row["sum3"];
								}
							}
							$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Method = 'Card' and Date = '$today'";
							$result = mysqli_query($conn, $sql);
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									$card = $row["sum1"] - $row["sum3"];
								}
							}
							$sql = "select sum(Sales_Volume) as sum1, sum(Invoice_Volume) as sum2, sum(Return_m) as sum3 from sales where Method = 'Credit' and Date = '$today'";
							$result = mysqli_query($conn, $sql);
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									$credit = $row["sum1"] - $row["sum3"];
								}
							}
							if ($credit == "") {
								$creditc = 0.00;
							}
							if ($cheque == "") {
								$cheque = 0.00;
							}
							if ($card == "") {
								$card = 0.00;
							}
							if ($cash == "") {
								$cash = 0.00;
							}

							$credit = number_format((float)$credit, 2, '.', ',');
							$cheque = number_format((float)$cheque, 2, '.', ',');
							$card = number_format((float)$card, 2, '.', ',');
							$cash = number_format((float)$cash, 2, '.', ',');

							?>
                        <h4>
                            <center>Today Sales
                        </h4><br>
                        <table class="table-striped">
                            <tr>
                                <th style="padding:3px 50px 3px 50px">Cash Total</th>
                                <th style="padding:3px 30px 3px 50px; color:#cc0000; font-size:17.5px" id="cash"
                                    onclick="tsales('Cash')"><?php echo "$cash"; ?></th>
                            </tr>
                            <tr>
                                <th style="padding:3px 50px 3px 50px">Cheque Total</th>
                                <th style="padding:3px 30px 3px 50px; color:#cc0000; font-size:17.5px" id="cheque"
                                    onclick="tsales('Cheque')"><?php echo "$cheque"; ?></th>
                            </tr>
                            <tr>
                                <th style="padding:3px 50px 3px 50px">Card Total</th>
                                <th style="padding:3px 30px 3px 50px; color:#cc0000; font-size:17.5px" id="card"
                                    onclick="tsales('Card')"><?php echo "$card"; ?></th>
                            </tr>
                            <tr>
                                <th style="padding:3px 50px 3px 50px">Credit Total</th>
                                <th style="padding:3px 30px 3px 50px; color:#cc0000; font-size:17.5px" id="credit"
                                    onclick="tsales('Credit')"><?php echo "$credit"; ?></th>
                            </tr>
                            <tr>
                                <th style="padding:3px 50px 5px 50px">Total OS</th>
                                <th style="padding:3px 30px 5px 50px; color:#cc0000; font-size:17.5px"></th>
                            </tr>
                            <tr>
                                <th style="padding:3px 50px 5px 50px">Over Due OS</th>
                                <th style="padding:3px 30px 7px 50px; color:#cc0000; font-size:17.5px"></th>
                            </tr>

                    </div>
                </td>
        </table>
        </table>
        <table>
            <br><br>
            <div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" onclick="daily()" id="daily">Daily</button>
                    <button type="button" class="btn btn-primary" onclick="monthly()">Monthly</button>
                    <button type="button" class="btn btn-primary" onclick="yearly()">Yearly</button>
                </div><br>
                <div id="chart_div2" style="width: 100%; height: 400px; border-radius:7px;"></div>
            </div>
        </table>
        <table>
            <br><br>
            <div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" onclick="dailyi()" id="daily">Daily</button>
                    <button type="button" class="btn btn-primary" onclick="monthlyi()">Monthly</button>
                    <button type="button" class="btn btn-primary" onclick="yearlyi()">Yearly</button>
                </div><br>
                <div id="chart_div3" style="width: 100%; height: 400px; border-radius:7px;"></div>
            </div>
        </table>
        <table>
            <br><br>
            <div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" onclick="dailyb()" id="daily">Daily</button>
                    <button type="button" class="btn btn-primary" onclick="monthlyb()">Monthly</button>
                    <button type="button" class="btn btn-primary" onclick="yearlyb()">Yearly</button>
                </div><br>
                <div id="chart_div4" style="width: 100%; height: 400px; border-radius:7px;"></div>
            </div>
        </table>
    </div>
    <div id="dom-target" style="display: none;"></div>
    <div id="dom-target2" style="display: none;"></div>
</body>

</html>