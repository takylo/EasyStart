<!-- 
Author : Takylo
Version : 0.1
Website : https://www.team-torrent.com

Dont delete this copyright please
 -->
<!-- Tool By Takylo -->

<link rel="stylesheet" href="data/foundation/css/foundation.css">
<script src='data/bootstrap/js/jquery.js'></script>
<meta charset='utf-8'>
<style>

body{background-color: #2c2c2c;}
</style>
<br><br>
<title>Acceuil | By Takylo</title> 
<center><a href="index.php"><img src="data/logo.png" alt="EasyStart"></a></center>
<div class="root" style='min-height:600px;background-color:white;height:auto;padding:20px;margin-left:auto;margin-right:auto;width:50%;'>
<?php 
include 'data/p/db.php';
$wampConfFile = '../wampmanager.conf';
if (!is_file($wampConfFile))
  die ('Unable to open WampServer\'s config file, please change path in index.php file');
$fp = fopen($wampConfFile,'r');
$wampConfFileContents = fread ($fp, filesize ($wampConfFile));
fclose ($fp);
//on récpères les versions des applis
preg_match('|phpVersion = (.*)\n|',$wampConfFileContents,$result);
$phpVersion = str_replace('"','',$result[1]);
preg_match('|apacheVersion = (.*)\n|',$wampConfFileContents,$result);
$apacheVersion = str_replace('"','',$result[1]);
preg_match('|mysqlVersion = (.*)\n|',$wampConfFileContents,$result);
$mysqlVersion = str_replace('"','',$result[1]);
preg_match('|wampserverVersion = (.*)\n|',$wampConfFileContents,$result);
$wampserverVersion = str_replace('"','',$result[1]);
?>
<div class="alert-box info">
PHP : <?php echo $phpVersion; ?><br>
MYSQL : <?php echo $mysqlVersion; ?><br>
APACHE : <?php echo $apacheVersion; ?><br>
WAMP : <?php echo $wampserverVersion; ?><br>
</div>
<center>

  <br>
  <?php 
  $project = $_GET['project'];

  $sql = $db->query("SELECT * FROM changelog WHERE name_project = '$project' ");
  $req = $sql->fetch();
  ?>
  <div class="panel callout radius">

    <p><?php echo $req['changelog']; ?></p>
  </div>
  <?php
if(isset($_POST['save'])){
  $changelog = nl2br(addslashes($_POST['changelog']));
  $db->query("UPDATE changelog SET changelog = '$changelog' WHERE name_project = '$project' ");
  ?>
    <div class="alert-box success">
    You changelog has been edit . <a href="changelog.php?project=<?php echo $project ; ?>"> Please click to refresh</a>
  </div>

  <?php
}
  ?>
<button class='edit'>Edit</button>
<form method="post" class="edit_form" style="display:none;">
<textarea name="changelog" id="" cols="30" rows="10"><?php echo $req['changelog']; ?></textarea>  
<input type="submit" name='save'value="Save changelog">
</form>

</div>

<script>
  $('.edit').click(function(){
    $('.edit_form').fadeIn(1000);
  });
</script>