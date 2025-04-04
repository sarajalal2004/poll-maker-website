<?php
   if(isset($_GET["qID"])){   

    try 
    {

      require('connection.php');
       
      $qID=$_GET["qID"];
      $query="UPDATE questions SET endDate = :endDate WHERE qID = :qID";
      $endDate="2000-01-02"; //change endDate to a date in past
      $stmt=$db->prepare($query);
      $stmt->bindParam(":endDate",$endDate);
      $stmt->bindParam(":qID",$qID);
      if($stmt->execute()){
        header("location: myOwnPolls.php");
      }
      
      $db = NULL;
    }
            
    catch(PDOException $e)
    {
      die("Error: " . $e->getMessage());
    }

  }
?>


