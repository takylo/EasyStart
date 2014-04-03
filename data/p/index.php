<meta charset="utf-8">
<title> Bienvenue sur votre projet | Default Page by Takylo </title>
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

<?php include 'config/db.php' ?>


<?php  
if(empty($_GET['page']))
	$_GET['page'] = 'home';	
if(!file_exists("pages/".$_GET["page"].".php")) 
	$_GET["page"]="404";
$urlInclusion = 'pages/'.$_GET['page'].'.php';
include $urlInclusion;
?>