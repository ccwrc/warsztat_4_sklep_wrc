<?php
session_start();

if (!isset($_SESSION['loggedAdminId'])) {
    header("location: panelAdmin.php");
    exit;
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title> przedmioty - administracja </title>
<!--	
	<meta name="description" content="krotki opis" />
	<meta name="keywords" content="kluczowe" />
	<meta name="author" content="WR & ccwrc">
	
	<link rel="stylesheet" href="css/style.css" type="text/css" />	
	<script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/app.js"></script>	-->
</head>

<body>
  <div class="container">
	  
    <div class="logo"> 
    </div>

    <div class="content">
    <!-- Zarządzanie przedmiotami Administrator powinien mieć możliwość dodania
    lub usunięcia przedmiotów. -->



        <div class ="footer">
            <br/><br/>
            <a href="../index.php">Powrót do...</a> 
        </div>      
          
    </div>
  </div>  
</body>
</html>


