<?php
  if(isset($_GET["qID"]))
  {    

      try 
      {
        require('connection.php');
        $db->beginTransaction();
        $qID=$_GET["qID"];

        $sql1="DELETE FROM votes WHERE qID=:qID";
        $stmt1=$db->prepare($sql1);
        $stmt1->bindParam(":qID",$qID);
            
        $sql2="DELETE FROM choices WHERE qID=:qID";
        $stmt2=$db->prepare($sql2);
        $stmt2->bindParam(":qID",$qID);

        $sql3="DELETE FROM questions WHERE qID=:qID";
        $stmt3=$db->prepare($sql3);
        $stmt3->bindParam(":qID",$qID);

            
        if($stmt1->execute()&& $stmt2->execute() && $stmt3->execute()){
          header("location: myOwnPolls.php");
        }

        $db->commit();

    }
            
    catch(PDOException $e)
    {
      $db->rollBack();
      die("Error: " . $e->getMessage());
    }
  }

?>


