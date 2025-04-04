<?php
try {
  require('connection.php');
  $sql = "select * from users where email = '".$_POST['email']."'";
  $rs = $db->query($sql);
  if ($r=$rs->fetch())
      echo "taken";
  else
      echo "free";
  $db=null;
}
catch(PDOException $ex){
  die($ex->getMessage());
}
?>

