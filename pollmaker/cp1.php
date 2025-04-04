<?php 
session_start();
if(isset($_SESSION['currentUser']))
{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/createpoll.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <title>Create Poll</title>
</head>
<body>
    <div class="container">
            <header>
                    <div class='webname'>
                        <img src='images/icons.png' alt='LOGO'>
                        <button onClick='location.href="homepage.php"' class='homepage'>Your Creation</button> 
                    </div>    

                    <nav>
                        <div class='btn'>
                            <button onclick='location.href="cp1.php"' class="createPoll">Create New Poll</button>
                        </div>

                        <div class='btn'>
                            <button onclick='location.href="myOwnPolls.php"' class=''>My Own Polls</button>
                        </div>

                        <div class='btn'>
                            <button onclick='location.href="Logout.php"' class='Logout'>Logout</button> 
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
            </header>


        <?php /*
            if(isset($_SESSION['error'][2]))
                echo "You visited this page again due to error, you previous inputs is saved <br>";
            else
                echo "You visited thispage on you own or by button <br>";
            */
        ?>

        
        <main>
            <form method="post" action="cp1process.php">
                <h1>Create poll</h1>

                <div class="question">
                    <h3>Enter your question</h3>
                    <textarea id="questionInput" name="question" cols="40" placeholder=" question" rows="3" onfocus="questionEnter(this)" onBlur="questionReset(this)"><?php if(isset($_SESSION['error'][2])) if(isset($_SESSION['question'])) echo $_SESSION['question']; ?></textarea><br>
                </div>
                <span id='question' style='color:red;'><?php if(isset($_SESSION['error'][0]) && isset($_SESSION['error'][2])) echo $_SESSION['error'][0];?></span>

                <div id="options">
                    <h3>Enter your options</h3>

                    <?php
                    if(isset($_SESSION['error'][2]))
                    {
                        echo "there is " . count($_SESSION['option']) . " options";
                        foreach ($_SESSION['option'] as $index => $option) 
                        {
                    ?>
                        <div class="option" id="option">
                            <input onfocus="optionEnter(this)" onBlur="optionReset(this)" class="op" type="text" name="op[]" id="optionInput <?php echo $index + 1; ?>" placeholder="Option <?php echo $index + 1; ?>" value="<?php if(isset($_SESSION['option'][$index])) echo $_SESSION['option'][$index]; ?>"><br><br>
                        </div>
                    <?php
                        }
                    
                    }
                    else
                    {
                    ?>
                            <div class="option" id="option">
                                <input  onfocus="optionEnter(this)" onBlur="optionReset(this)" class="op" type="text" name="op[]" id="1" placeholder="Option 1"><br><br>
                            </div>

                            <div class="option" id="option">
                                <input  onfocus="optionEnter(this)" onBlur="optionReset(this)" class="op" type="text" name="op[]" id="2" placeholder="Option 2"><br><br>
                            </div>
                    <?php
                    
                    }
                    ?>  
                </div>
                <span style='color:red;'><?php if(isset($_SESSION['error'][1])) if(isset($_SESSION['error'][2])) echo $_SESSION['error'][1];?></span>
                
                <br>
                <div class="addMoreOption">
                    <button type="button" class="addOption" onclick="addMoreOptions()"> <i class="fa-solid fa-plus"></i>  Add more options</button>
                </div>

                <div class="date">
                    <?php 
                        if(isset($_SESSION['error'][2]))
                        {   if(isset($_SESSION['endDate']))
                            {
                    ?>
                                <label class="ckbox"><input type="checkbox" name="date" id="date" onChange="show();" checked><span class="mark"></span></label>
                                <h3>Enter end Date of poll</h3>
                                <input type="date" id="endDate" name="endDate" min="<?php echo date('Y-m-d') ?>" value="<?php echo $_SESSION['endDate'];?>" >     
                    <?php   }
                            else
                            { 
                    ?>          <label class="ckbox"><input type="checkbox" name="date" id="date" onChange="show();"><span class="mark"></span></label>
                                <h3>Enter end Date of poll</h3>
                                <input type="date" id="endDate" name="endDate" min="<?php echo date('Y-m-d');?>" value="" style="display: none;">
                    <?php   }
                        }
                        else
                        {   
                    ?>      
                                <label class="ckbox"><input type="checkbox" name="date" id="date" onChange="show();"><span class="mark"></span></label>
                                <h3>Enter end Date of poll</h3>
                                <input type="date" id="endDate" name="endDate" min="<?php echo date('Y-m-d') ?>" value="" style="display: none;">
                    <?php
                        }
                    ?>
                </div>
                <br>

                <?php unset($_SESSION['error'][2]);?> <!--unset flag of error so if he re enterd the url the page will be empty-->

                <span id="message"></span>

                <div class="submit">
                    <button type="submit" name="sbtn" id="stbn">Create poll</button>
                </div>
            </form>
        </main>

        <div class="side">
            <img src="" alt="">
        </div>

    </div>

<script>
    let c = 2;

    function addMoreOptions() 
    {
        //let element = document.getElementById('options');
        let elements = document.querySelectorAll('.option');
        c = elements.length;
        

        if (c == 10) 
        {
            alert('the maximum number of options is 10');
        } 
        else 
        {
            c=c+1;
            
            let opString = "<div class='option'> <input onfocus='optionEnter(this)' onBlur='optionReset(this)' class='op' type='text' name='op[]'  id='" +c+ "' placeholder='Option " +c+ "' value=''><br><br> </div>";

            let values = [];
            for (let i = 0; i < c - 1; i++) {
                values.push(document.getElementById(i + 1).value);
            }

            document.getElementById("options").innerHTML += opString;

            for (let i = 0; i < c - 1; i++) {
                document.getElementById(i + 1).value = values[i];
            }

        }
    }

    function show() 
    {
        if (document.getElementById("date").checked) 
        {
            document.getElementById("endDate").style.display = 'block';
        } 
        else 
        {
            <?php unset($_SESSION['endDate']); ?>
            document.getElementById("endDate").style.display = 'none';
            document.getElementById("endDate").value = " ";
        }

    }

    function questionEnter(input) {
        const element = document.getElementById('questionInput');
        element.style.borderColor = '#8a92fd';
    }

    function questionReset(input) {
        const element = document.getElementById('questionInput');
        element.style.borderColor = '#3F3F3F';
    }

    function optionEnter(input) {
        input.style.borderColor = '#8a92fd';
    }

    function optionReset(input) {
        input.style.borderColor = '#3F3F3F';
    }
</script>

<img src='images/icons8-menu.svg' alt='Mobile Menu Icon' style='width: 40px;' class='menu' />


    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <script src="jquery-nav.js"></script>

</body>
</html>

<?php
}
else
{
    unset($_SESSION['error'][2]);
    header('location:viewAll.php');
}
?>
