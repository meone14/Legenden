<?php
	require("dbconnect.php");
	session_start();

	if(!isset($_SESSION['bruger'])){
		header("Location: index.php");
	} else {
		$bruger = $_SESSION['bruger'];
	}

?>


<html>
	<head>
		<title>Profilside</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	
	<body>

		<?php
		echo "<h3> Velkommen " . $bruger['brugernavn'] . "</h3>";
			//henter id'ene på de kort brugeren har
			$sql = mysql_query("SELECT * FROM `brugere` WHERE `brugernavn` = '".$bruger['brugernavn']."'");
    		$kortres = mysql_fetch_array($sql);
			
			//aray der indeholder alle ids på brugerens kort
			$kortArray = explode(',', $kortres['kort']);
		
			echo "<h3>Mine kort</h3>";
			echo "<div class='minekort'>";
			echo "<table><tr>";
			echo "<th>Bil</th><th>Billede</th><th>Hestekræfter</th><th>0-100 km/t</th><th>Topfart</th>";
			foreach($kortArray as $kort){
				$bilsql = mysql_query("SELECT * FROM `biler` WHERE `id` = '$kort'");
				while($bil = mysql_fetch_array($bilsql)){
					echo "<tr>";
					echo "<td>" . $bil['brand'] . " " . $bil['model'] . "</td>";
					echo "<td> <img src='".$bil['billed']."' style='height:128; width: 128;'></td>";
					echo "<td>".$bil['horsepower']." hk</td>";
					echo "<td>0-100 på ".$bil['acceleration']." sek</td>";
					echo "<td>".$bil['topfart']."</td>";
					echo "</tr>";
				}
			}
			echo "</tr>";
			
			echo "</table>";
			echo "</div>";
		?>
	</body>

</html>