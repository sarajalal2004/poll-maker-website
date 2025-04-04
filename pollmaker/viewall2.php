<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/vAll2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="jquery-nav.css">
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
                            
                        <div class='mob-wrapper'>
                            <img src='images/icons8-menu.svg' alt='Mobile Menu Icon' style='width: 40px;' class='menu' />
                            <div class='hide' style='display:none;'>
                                <a href='cp1.php'>Create new poll</a>
                                <a href='myownpolls.php'>My Own Polls</a>
                                <a href='logout.php'>Logout</a>
                            </div>
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
                        
                        <img src='images/icons8-menu.svg' alt='Mobile Menu Icon' style='width: 40px; display:none;' class='menu' />
                        

                        <img src='images/icons.png' alt='LOGO'>
                        <button onClick='location.href=\"homepage.php\"' class='homepage'>Your Creation</button> 
                    </div>    
                    
                    <div class='hide' style='display:none;'>
                            <a href='cp1.php'>Create new poll</a>
                            <a href='myownpolls.php'>My Own Polls</a>
                            <a href='logout.php'>Logout</a>
                    </div>

                    <nav>
                        <div class='btn'>
                            <button onclick='location.href=\"login.php\"' class='login'>Log In</button>
                        </div>
                    
                        <div class='btn'>
                            <button onclick='location.href=\"signup.php\"' class='signup'>Sign Up</button> 
                        </div>
                    </nav>

                    <div class='mob-wrapper'>
                            <img src='images/icons8-menu.svg' alt='Mobile Menu Icon' style='width: 40px;' class='menu' />
                            <div class='hide' style='display:none;'>
                                <a href='login.php'>Login</a>
                                <a href='signup.php'>Sign Up</a>
                            </div>
                    </div>

                    
                </header>";
        }

      
        echo "<main>";

        try 
        {
            require('connection.php');

            $sql = "SELECT * FROM questions";
            $result = $db->prepare($sql);
            $result->execute();
            $count = $result->rowCount();
            
            if($count > 0)
            {
                $records = $result->fetchAll(PDO::FETCH_ASSOC);
                foreach($records as $record)
                {
                    extract($record);
                    
                    echo "<div class='qBox' onClick='location.href=\"viewquestion2.php?qID=$qID\"'>";
                                
                    echo "<div class='questionAndLock' > <div class='question'>$question</div>";
                    

                    echo "</div>";

                    
                        
                    echo "<div class='info'>";
                    
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
                    
                    echo "<div class='icons'>";
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
                    echo " <div class='eye'> 
                                <i id='eye' class='fa-solid fa-eye'></i> 
                            </div> ";

                    echo "<div/>"; //end icons div
                    
                    echo "</div>"; //end info div

                    echo "</div>"; 
                    echo "</div>"; 
                    echo "</div>"; //end qBox div
                }
            }
            else
            {
                echo "<div class='qBox'>No Questions Avaiable</div>";
            }
            //echo "</div>";
            $db = NULL;

        } catch(PDOException $e)
        {
            die("Error: " . $e->getMessage());
        }

        echo "</main>";
    ?>
    

    </div> <!--container div end-->

    <img src='images/icons8-menu.svg' alt='Mobile Menu Icon' style='width: 40px;' class='menu' />


    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <script src="jquery-nav.js"></script>
</body>
</html>
