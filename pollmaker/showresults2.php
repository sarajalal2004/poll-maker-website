<?php
    session_start();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/showResult2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<body>
    
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
                        <button onclick='location.href=\"signup.php\"' class='signup'>Sign Up</button> 
                    </div>
                </nav>
            </header>";
    }

    echo "<div class='container'>";
        if(isset($_GET["qID"]))
        {   
            try 
            {
                require('connection.php');

                $qID=$_GET["qID"];
                $arr=[];
                $totalVotes=0;

                //step1: print the question that the user selected
                $sql2="SELECT question FROM questions where qid=?";
                $stmt2=$db->prepare($sql2);
                $stmt2->bindParam(1,$qID);
                $rs=$stmt2->execute();
                //print the question
                if($rs==1)
                {
                    $rowQ=$stmt2->fetch();
                    
                    echo "<div class='question'> ";
                    echo $rowQ["question"]."<br>"."<br>";
                    echo "</div>";
                }
                
                //Step 2: initialize the array with keys (choice id)
                $sql3="SELECT * FROM choices where qid=?";
                $stmt3=$db->prepare($sql3);
                $stmt3->bindParam(1,$qID);
                $rs=$stmt3->execute();

                if($rs>0)
                {
                    while($row=$stmt3->fetch(PDO::FETCH_ASSOC))
                    {
                        $cid = $row['cID'];
                        $choice = $row['choice'];
                        $arr["$cid"] = ["votes"=>0, "name"=>$choice];
                    }
                }
                

                //step 3: count votes for each choice
                //count the number of votes for each choice
                $sql1="SELECT cID,COUNT(cID) AS noVotes FROM votes WHERE qID=:qID GROUP BY cID";
                $stmt1=$db->prepare($sql1);
                $stmt1->bindParam(":qID",$qID);
                $stmt1->execute();

                //add the number of votes to each choice
                
                while($row=$stmt1->fetch(PDO::FETCH_ASSOC))
                {
                    $cid = $row["cID"];
                    $arr[$cid]['votes']=$row["noVotes"];
                    $totalVotes+=$row["noVotes"];
                }
                

                //step 4: print each option and its percentage
                //print the choices for the question4
                //display the percentage for each choice in progress bar
                echo "<div class='responses'>";
                echo "<h3> $totalVotes Responses recieved</h3> <br>";
                echo "</div>";

                $percentage = 0;
                foreach($arr as $cID => $info)
                {
                    if($totalVotes > 0)
                    {
                        // Individual Score / Total Score * 100.
                        $percentage = $info['votes'] / $totalVotes * 100;
                        $percentage = round($percentage,2);
                    }
                    

                    echo "<div class='result'>";
                    echo "<h3 class='choice'> <span id='choiceL'> {$info['name']}</span> <span class='span'> $percentage% ({$info['votes']} votes)</span> </h3>"; //apple
                    // echo "<span> $percentage% ({$info['votes']} votes)</span><br>"; 
                    echo "<progress id='$cID' value='$percentage' max='100'> $percentage </progress><br>";
                    echo "</div>";

                }
            
            
                
                
                $db = NULL;
            }
    
            catch(PDOException $e)
            {
                die("Error: " . $e->getMessage());
            }

        }
        else
        {
            header('location: viewAll2.php');
        }
    echo "</div>";
?>
</body>
</html>
