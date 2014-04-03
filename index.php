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
  <button class='new_project success'>Start a projet</button>
  <button class='edit_project'>Edit projets</button>
  <a href="/phpmyadmin"><button>PhpMyAdmin</button></a>
  <?php 
  if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){
      $dos = $_GET['name'];
      //  echo $dos;
      $db->query("DELETE FROM changelog WHERE name_project = '$dos' ");
      clearDir('projets/'.$dos);
      ?>
      <div data-alert class="alert-box success ">
       Le projet <?php echo $dos; ?> et son changelog ont bien été supprimer !
     </div>
     <?php
   }else{}
 }
 function clearDir($dossier) {
  $ouverture=@opendir($dossier);
  if (!$ouverture) return;
  while($fichier=readdir($ouverture)) {
    if ($fichier == '.' || $fichier == '..') continue;
    if (is_dir($dossier."/".$fichier)) {
      $r=clearDir($dossier."/".$fichier);
      if (!$r) return false;
    }
    else {
      $r=@unlink($dossier."/".$fichier);
      if (!$r) return false;
    }
  }
  closedir($ouverture);
  $r=@rmdir($dossier);
  if (!$r) return false;
  return true;
}
if(isset($_POST['new_project_create'])){ // si il clique
  $name = $_POST['name'];
  $kit = $_POST['kit']; // on recupere
  if($name !='' || $kit !=''){  // on check si les donnée sont pas vide
   $db->query("INSERT INTO changelog VALUES ('".$name."','Merci d\'utiliser EasyStart by Takylo') ");
   mkdir('projets/' . $name); // creation du dossier
   mkdir('projets/' . $name . '/css');
   mkdir('projets/' . $name . '/js');
   switch ($kit) {
     case 1:

     mkdir('projets/' . $name . '/pages');
     mkdir('projets/' . $name . '/config');
     $css = 'data/bootstrap/css/bootstrap.css';
     $ccss = "projets/" .$name. "/css/style.css";
     $jquery = 'data/bootstrap/js/jquery.js';
     $cjquery = "projets/" .$name. "/js/jquery.js";
     $bjs = 'data/bootstrap/js/bootstrap.min.js';
     $cbjs = "projets/" .$name. "/js/bootstrap.js";
     $index = 'data/p/index.php';
     $cindex = "projets/" .$name. "/index.php";
     $home = 'data/p/home.php';
     $chome = "projets/" .$name. "/pages/home.php";
     $db = 'data/p/db.php';
     $cdb = "projets/" .$name. "/config/db.php";
     $error = 'data/p/404.php';
     $cerror = "projets/" .$name. "/pages/404.php";
     copy($css, $ccss);
     copy($jquery, $cjquery);
     copy($bjs, $cbjs);
    //page
     copy($index, $cindex);
     copy($home, $chome);
     copy($db, $cdb);
     copy($error, $cerror);

     break;

     case 2:
     mkdir('projets/' . $name . '/pages');
     mkdir('projets/' . $name . '/config');
     $css = 'data/foundation/css/foundation.css';
     $ccss = "projets/" .$name. "/css/style.css";
     $jquery = 'data/bootstrap/js/jquery.js';
     $cjquery = "projets/" .$name. "/js/jquery.js";
     $index = 'data/p/index.php';
     $cindex = "projets/" .$name. "/index.php";
     $home = 'data/p/home.php';
     $chome = "projets/" .$name. "/pages/home.php";
     $db = 'data/p/db.php';
     $cdb = "projets/" .$name. "/config/db.php";
     $error = 'data/p/404.php';
     $cerror = "projets/" .$name. "/pages/404.php";
     copy($css, $ccss);
     copy($jquery, $cjquery);

     copy($index, $cindex);
     copy($home, $chome);
     copy($db, $cdb);
     copy($error, $cerror);

     break;
     default:
     echo '';
     break;
   }
   ?>
   <div data-alert class="alert-box success ">
    You project <?php echo $name; ?> with <?php echo $kit; ?> was succefull created
  </div>
     <div data-alert class="alert-box success ">
    The changelog of your project is available <a href="changelog.php?project=<?php echo $name; ?>">here</a>
  </div>
  <?php 
}else{
  echo "Erreur veuillez tout remplir";
}
}else{}
?>
<div class="edit" style='display:none;'>
 <table style='width:100%;'>
  <thead>
    <tr>
      <th>Name of project</th>
      <th>Look</th>
      <th>Changelog</th>
      <th>Action</th>
    </tr>
  </thead>
  <?php 
  $dir = "projets/";
  if (is_dir($dir)) 
    if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
        if (is_dir($file)) {
        }else {
          ?>
          <tbody>
            <tr>
              <td><?php echo $file; ?></td>
              <td><a href="projets/<?php echo $file ; ?>">View </a></td>
              <td><a href="changelog.php?project=<?php echo $file; ?>">Changelog</a></td>
              <td><a href="index.php?action=delete&name=<?php echo $file ; ?>">Delete</a></td>
            </tr>

          </tbody>
          <?php
        }
      }
      closedir($dh);
    }
    ?>
  </table>
</div>
<form class="form_project" style='display:none;' method='post'>
  <label for="name">Name of project</label>
  <input type="text" name='name'>
  <label for="kit">Kit</label>
  <select name="kit">
   <option value="1">Bootstrap</option>
   <option value="2">Foundation</option>
   <option value="3" disabled>None [Last update]</option>
 </select>
 <input type="submit" name='new_project_create' value='Start project'>
</form>
<br>

</div>


<script>
$('.new_project').click(function(){
  $('.form_project').fadeIn(1000);
  $('.edit').css('display','none');
});
$('.edit_project').click(function(){
  $('.edit').fadeIn(1000);
  $('.form_project').css('display','none');
});
</script>
