<?php
    session_start();
    
    //unset all previous sessions used 
    unset($_SESSION['question']);
    if(isset($_SESSION['option']))
    {
        foreach($_SESSION['option'] as $key => $op)
        {
            unset($_SESSION['option'][$key]);
        }
    }
    unset($_SESSION['option']);
    unset($_SESSION['endDate']);
    unset($_SESSION['error'][0]);
    unset($_SESSION['error'][1]);
    unset($_SESSION['error'][2]);
    unset($_SESSION['error']);
    
    

    if (isset($_POST['sbtn'])) 
    {
        $uid = $_SESSION['currentUser'];

        //define variables used with empty 
        $question = '';
        $options = [];
        $endDate = null;
        $print = false;

        if (isset($_POST['question'])) 
        {
            $reg="/\?$/";            
            if(preg_match($reg,$_POST['question'])){
            $question = $_POST['question'];
            }

        }

        if (isset($_POST['op'])) 
        {
            $options = $_POST['op'];
            foreach($options as $key => $option)
            {
                $options[$key] = $option;
            }
        }

        if (isset($_POST['endDate']) && $_POST['endDate']!=null) 
        {
            $endDate = $_POST['endDate'];
            $_SESSION['endDate'] = $endDate;
        } else {
            $endDate = '0000-00-00';
        }

        //validation:
        if (trim($question) == "") 
        {
            //save error
            $_SESSION['error'][0] = "* Question that ends with question mark is required";
            $_SESSION['error'][2] = 1;
            $print=true;
        } 
        else 
        {
            $_SESSION['question'] = $question;
        }

        $_SESSION['option'] = [];
        foreach ($options as $index => $option) 
        {
            if (trim($option) == "") 
            {
                $_SESSION['error'][1] = "*All Option must be filled";
                $_SESSION['error'][2] = 1;
                $print=true;
            }

            $_SESSION['option'][$index] = $option;
        }

        if(isset($_SESSION['error'][2]))
        {
            if ($_SESSION['error'][2] == 1) //if there was error, then save endate too since we will tranfare user back to form with inputs
            {
                $_SESSION['error'][2] = 1; //flag for visited due to error error
                header('location:cp1.php');
            }
        }
        

        
        if(!$print) 
        {
            try 
            {
                require("connection.php");
                $db->beginTransaction();

                $sql = "INSERT INTO questions (question, endDate, uID) VALUES (:question, :endDate, :uid)";
                $stmt = $db->prepare($sql);

                $stmt->bindParam(":question", $question);
                $stmt->bindParam(":endDate", $endDate);
                $stmt->bindParam(":uid", $uid);
                $stmt->execute();

                $qID = $db->lastInsertId();

                $sql = "INSERT INTO choices (qid, choice) VALUES (:qid, :choice)";
                $stmt2 = $db->prepare($sql);
                $stmt2->bindParam(":qid", $qID);

                foreach ($options as $option) {
                    $stmt2->bindParam(":choice", $option);
                    $stmt2->execute();
                }

                $db->commit();
                unset($_SESSION['question']);
                if(isset($_SESSION['option']))
                {
                    foreach($_SESSION['option'] as $key => $op)
                    {
                        unset($_SESSION['option'][$key]);
                    }
                }
                unset($_SESSION['option']);
                unset($_SESSION['endDate']);
                unset($_SESSION['error'][0]);
                unset($_SESSION['error'][1]);
                unset($_SESSION['error'][2]);
                header('location:viewAll2.php');
                exit();
            } 
            catch (PDOException $e) 
            {
                $db->rollBack();
                die("Error " . $e->getMessage());
            }
        }

    }     

?>
