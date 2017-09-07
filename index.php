<?php
	session_start();
	require("dbconnect.php");

	if(isset($_POST["opret"])){
		$fornavn = $_POST["fornavn"];
		$efternavn = $_POST["efternavn"];
		$brugernavn = $_POST["brugernavn"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$kort = $_POST["kort"];
		
		if(strlen($fornavn) == 0){
			echo "Angiv venligst et fornavn";
		} else if(strlen($efternavn) == 0){
			echo "Angiv venligst et efternavn";
		} else if(strlen($brugernavn) < 5 or strlen($brugernavn) > 20){
			echo "Brugernavnet skal være mellem 5 og 20 tegn";
		} else if(strlen($password) < 6 or strlen($password) > 20){
			echo "Passworder skal være mellem 6 og 20 tegn";
		} else {
			$sql = "INSERT INTO `brugere`(`fornavn`, `efternavn`, `brugernavn`, `email`, `password`, `kort`) VALUES ('".$fornavn."','".$efternavn."','".$brugernavn."','".$email."','".$password."','".$kort."')";
			mysql_query($sql);
			header("Location: profilside.php");
		}
	}

	if(isset($_POST["logind"])){
		$brugernavn = $_POST["brugernavn"];
		$password = $_POST["password"];
		
		$bruger = mysql_query("SELECT `brugernavn`, `password` FROM `brugere` WHERE `brugernavn` = '".$brugernavn."'");
		$brugerres = mysql_fetch_array($bruger);
		
		// til at bruge på profilside.php til at bruge informationerne
        $_SESSION['bruger'] = $brugerres;
        
        if ($password == $brugerres['password']){
            header ("Location: profilside.php");
        } else {
            echo "Forkert brugernavn eller password";
        }
		
	}
?>

<html>
	<head>
		<title>Bilkort</title>
	</head>

	<body>
		
		<div class="opretbruger">
			<h3>Opret bruger</h3>
			<form method="post" action="index.php">
				<input type="text" name="fornavn" placeholder="Fornavn">
				<input type="text" name="efternavn" placeholder="Efternavn">
				<input type="text" name="brugernavn" placeholder="Brugernavn">
				<input type="email" name="email" placeholder="Email">
				<input type="password" name="password" placeholder="Password">
				<input type="hidden" name="kort" value="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15">
				<input type="submit" name="opret" value="Opret bruger">
			</form>
		</div>
		
		<div class="logind">
			<h3>Log ind</h3>
			<form method="post" action="index.php">
				<input type="text" name="brugernavn" placeholder="brugernavn">
				<input type="password" name="password" placeholder="Password">
				<input type="submit" name="logind" value="Log ind">
			</form>
		</div>
	</body>


</html>