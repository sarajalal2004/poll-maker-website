<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/myownpolls.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>

<body>
    <div class="container">

    <?php 
    //check for the uID
        if(isset($_SESSION["currentUser"]))
        {  
        //get the user id
        $uID=$_SESSION["currentUser"];


        echo "  <header>
                    <div class='webname'>
                        <img src='images/icons.png' alt='LOGO'>
                        <button onClick='location.href=\"homepage.php\"' class='homepage'>Your Creation</button> 
                    </div>    

                    <nav>
                        <div class='btn'>
                            <button onclick='location.href=\"cp1.php\"' class=''>Create New Poll</button>
                        </div>

                        <div class='btn'>
                        <button onclick='location.href=\"myOwnPolls.php\"' class='myownpoll'>My Own Polls</button> 
                        </div>

                        <div class='btn'>
                            <button onclick='location.href=\"Logout.php\"' class='Logout'>Logout</button> 
                        </div>
                    </nav>

                    <div class='mob-wrapper'>
                        <img src='images/icons8-menu.svg' alt='Mobile Menu Icon' style='width: 40px;' class='menu' />
                        <div class='hide' style='display:none;'>
                            <a href='cp1.php' class='here'>Create new poll</a>
                            <a href='myownpolls.php'>My Own Polls</a>
                            <a href='logout.php'>Logout</a>
                        </div>
                    </div>

                </header>";
        } 
        else
        {
            header('location:homepage.php');
        }

        echo "<main>";

    try {

        require('connection.php');

        $sql = "SELECT * FROM questions WHERE uID=?";
        $rs=$db->prepare($sql);
        $rs->bindParam(1,$uID);
        $stmt=$rs->execute();

        //print the PollQuestion the user created
        if($stmt>0)
        {
            $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $row)
            {
                $qID=$row["qID"];
                echo "<div class='qBox'> 
                            <div class='question' onClick='location.href=\"viewquestion2.php?qID=$qID\"'>  ". $row['question']."</div>";
                
                $endDate=$row["endDate"];
    
                echo   "<div class='info'>";
                
                echo "<div class='row1'>";
                $color;
                if($endDate < date("Y-m-d") && $endDate != '0000-00-00')
                {
                    $color = "red";
                    $status = "Ended";
                    echo "<div class='endDate' style='color: {$color}'> $status </div>";
                }

                if($endDate == '0000-00-00')
                {
                    echo "<div class='endDate'> No Due Date </div>";
                }
                else if(strtotime($endDate) >= strtotime(date("Y-m-d")))
                {
                    $today = new DateTime(date("Y-m-d"));
                    $endDateObj = new DateTime($endDate);
                    $interval = $today->diff($endDateObj);
                    echo "<div class='endDate'> Ends in {$interval->format('%a')} days</div>";
                }
                
                
                if(isset($_SESSION['currentUser']))
                {
                    $uID = $_SESSION['currentUser'];
                    $sql2 = "SELECT * FROM votes WHERE uID = :uID AND qID = :qID";
                    $result2 = $db->prepare($sql2);
                    $result2->bindValue(":uID", $uID);
                    $result2->bindValue(":qID", $qID);
                    $result2->execute();
                    $count2 = $result2->rowCount();

                    if($count2 > 0)
                        echo "  <div class='lock'> 
                                    <i class='fa-solid fa-lock'></i>  
                                </div>";
                    else
                        echo "  <div class='lock'> 
                                    <i class='fa-solid fa-unlock-keyhole'></i> 
                                </div>";
                }
                echo " <div> 
                            <i id='eye' class='fa-solid fa-eye'></i> 
                        </div> ";
                echo "</div>"; //end icons (row 1)
                


                echo "  <div class='row2'>
                                <div onClick='location.href=\"stopQuestion.php?qID=$qID\"' class='stop'>
                                    <i class='fa-solid fa-circle-stop'></i>  
                                    <h4>Stop</h4>
                                </div>

                                <div onClick='location.href=\"deleteQuestion.php?qID=$qID\"' class='delete'>
                                    <i class='fa-solid fa-trash'></i> 
                                    <h4>Delete</h4>
                                </div> 
                        </div>";  //end info div

                echo "</div>"; //info div
                echo "</div>"; //qBox
            }
        }
             
            
        $db = NULL;
    }
    catch(PDOEXCEPTION $ex)
    {
        die($ex->getMessage());
    }

    echo "</main>";
    ?>

    </div> <!--container-->

    <img src='images/icons8-menu.svg' alt='Mobile Menu Icon' style='width: 40px;' class='menu' />


    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <script src="jquery-nav.js"></script>


<body>
</html>
