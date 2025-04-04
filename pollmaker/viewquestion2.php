<?php
    session_start();  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewquestion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <title>Create Poll</title>
</head>
<body>
    <div class="container">

    <?php 
        if(isset($_SESSION['currentUser']))
        {
            echo "  <header>
                        <div class='webname'>
                            <img src='images/icons.png' alt='LOGO'>
                            <button onClick='location.href=\"homepage.php\"' class='homepage'>Your Creation</button> 
                        </div>    

                        <nav>
                            <div class='btn'>
                                <button onclick='location.href=\"cp1.php\"' class='login'>Create New Poll</button>
                            </div>
                                    
                            <div class='btn'>
                                <button onclick='location.href=\"myOwnPolls.php\"' class='signup'>My Own Polls</button> 
                            </div>

                            <div class='btn'>
                                <button onclick='location.href=\"Logout.php\"' class='Loogout'>Logout</button> 
                            </div>
                        </nav>
                </header>";
        }
        else
        {
            echo "<header>
                    <div class='webname'>
                            <img src='icons.png' alt='LOGO'>
                            <button onClick='location.href=\"homepage.php\"' class='homepage'>Your Creation</button> 
                    </div>    

                    <nav>
                        <div class='btn'>
                            <button onclick='location.href=\"login.php\"' class='login'>Log In</button>
                        </div>
                    
                        <div class='btn'>
                            <button onclick='location.href='#'' class='signup'>Sign Up</button> 
                        </div>
                    </nav>
                </header>";
        }
    ?>
<div class="backColor">
    <main>
    <?php
        if(isset($_SESSION["currentUser"]))
        {   
            $uID=$_SESSION["currentUser"];
        }

        //check for the qID
        if(isset($_GET["qID"]))
        {  
            //get the question id
            $qID=$_GET["qID"];
            try 
            {
                require('connection.php');
            
                //(1): print the question that the user selected
                $sql="SELECT question,endDate FROM questions where qid=?";
                $stmt=$db->prepare($sql);
                $stmt->bindParam(1,$qID);
                $rs=$stmt->execute();
                //print the question
                if(!$stmt)
                    header('location: viewAll2.php');

                if($rs==1)
                {
                    $row=$stmt->fetch();
                    echo "<div class='question'>";
                    echo $row['question']."<br>"."<br>";
                    echo "</div>";
                    $endDate=$row["endDate"];
                } 
                

                //(2): check whether the question is active or ended
                if($endDate >= date("Y-m-d") || $endDate == '0000-00-00')
                {
                    $status = "Active";
                }
                else
                {
                    $status = "Ended";
                }
                        
                //(3): check if the user have previously voted
                //$votedPreviously = false;
                $selectedChoice = -1;
                if(isset($_SESSION["currentUser"]))
                {       
                    $sql="SELECT * FROM votes WHERE uID=:uID AND qID=:qID";
                    $result=$db->prepare($sql);
                    $result->bindParam(":uID",$uID);
                    $result->bindParam(":qID",$qID);
                    $result->execute();
                    
                    //if yes ,then disable choices and vote button
                    if($result->rowCount() != 0)
                    {
                        //$votedPreviously=true;
                        $row=$result->fetch(PDO::FETCH_ASSOC);
                        $selectedChoice = $row['cID'];
                    } 
                } 

                //(4): print the choices for the specified question
                $query2="SELECT * FROM choices where qid=?";
                $stmt2=$db->prepare($query2);
                $stmt2->bindParam(1,$qID);
                $rs=$stmt2->execute();
                
                ?>
     
                <?php
                
                echo "<form action='vote.php' method='post'>";
                
                
                if($rs>0)
                {
                    //CASE 1: user can vote if he is logged in AND question is active AND not voted previously
                    if(isset($_SESSION["currentUser"]) && $status == "Active" && $selectedChoice==-1)
                    {
                        echo "<div class='options' >";
                        while($row2=$stmt2->fetch())
                        {
                            $cID=$row2['cID'];

                            echo "<div class='option'> <input class='choice'  onfocus='optionEnter(this)' onBlur='optionReset(this)' type='radio' name='cID' value='$cID'><label for='$cID' class='optionText'> ";
                            echo "{$row2['choice']}</label> </div>"; 
                                
                            //In this case, user can vote so we wil send qid,uid,cid to vote.php in case he decided to vote
                            echo  "<input type='hidden' name='qID' value='$qID'>";
                            echo  "<input type='hidden' name='uID' value='$uID'>";
                        }
                        echo "</div>"; //options div 
                        
                        echo "<div class='MainBtn'> <button class='vote' type='submit' name='sbtn'>Vote</button>";  
                    }
                    else  //CASE 2: user is guest or previously voted or question is ended, then print choices as disabed
                    {
                        echo "<div class='options'>";
                        
                        while($row2=$stmt2->fetch())
                        {
                            $cID=$row2['cID'];
                            if(isset($_SESSION["currentUser"]) && $selectedChoice == $cID)
                                echo "<div class='option'> <input type='radio' name='cID' value='$cID' checked='checked' disabled> <label class='optionText' for='$cID'> {$row2['choice']}</label> </div>";
                            else
                                echo "<div class='option'> <input type='radio' name='cID' value='$cID' disabled> <label class='optionText' for='$cID'> {$row2['choice']}</label><br><br> </div>";
                        }   
                        
                        echo "</div>"; //options div 
                        echo "<div class='MainBtn'>";
                        echo "<div class='voteDisbaled' disabled>Vote</div>";
                    }    
                }


                //Show result button
                if((!isset($_SESSION["currentUser"]) && $status=="Active"))
                {
                    echo "<div class='resultbtnDisabled'> Show Result </div>";
                    echo "</div>"; //end btn class
                }    
                else
                {
                    echo "<div class='resultbtn' onClick='location.href=\"showresults2.php?qID=$qID\"'> Show result </div>";
                    echo "</div>"; //end btn class
                }
                    

                echo "</form>";  
                

                $db = NULL;
            }    
            catch(PDOException $e)
            {
                die("Error: " . $e->getMessage());
            }
        } 
    ?>
        </main>
    </div>
</div> 

<script>
    /* onfocus="optionEnter(this)" onBlur="optionReset(this)" */

    function optionEnter(input) {
        const icon = document.querySelector(input);
        const btn = icon.parentNode;
        btn.style.borderColor = '#8a92fd';
    }

    function optionReset(input) {
        const icon = document.querySelector(input);
        const pt = icon.parentNode;
        pt.style.borderColor = '#3F3F3F';
    }
</script>

</body>
</html>