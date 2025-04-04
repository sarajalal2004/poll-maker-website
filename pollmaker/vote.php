<?php
    try 
    {
        require('connection.php');
        //check if the user select choice
        if(isset($_POST["cID"]))
        {
            $uID=$_POST["uID"];
            $qID=$_POST["qID"];
            $cID=$_POST["cID"];

            $sql="INSERT INTO votes (uID,qID,cID) VALUES (:uID,:qID,:cID)";
            $stmt2=$db->prepare($sql);
            $stmt2->bindParam(":uID",$uID);
            $stmt2->bindParam(":qID",$qID);
            $stmt2->bindParam(":cID",$cID);

            if($stmt2->execute())
            {
                header("location: viewall2.php?status=1");
            }
            else
            {
                header("location: viewall2.php?status=0"); 
            }

        } 
        else  // if the user doesnt select choice
        {
            $qID=$_POST["qID"];
            header("location: viewquestion.php?qID=$qID");    
        } 

        $db = NULL;
    }       
    catch(PDOException $e)
    {
        die("Error: " . $e->getMessage());
    }
?>


