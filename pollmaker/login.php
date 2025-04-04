<?php
session_start();
if(isset($_SESSION['currentUser']))
  session_unset();

//email validation
$emailReg="/^\w+@[a-z]+(\.[a-z]{2,5})+$/i";


?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/loginm.css">
    <title>Login</title>
  </head>
  <body>  
  
    <div class="container">
    
        <main>
            <div class="login">
                <h1>Login</h1>

                <form method="post">
                    <div id="messageBox" style='visibility: hidden;'> 
                        <span id='message' ></span>
                    </div>

                        
                    <div class="inputF" id="emailInput" >
                        <i class="fa-solid fa-user" id="userIcon"></i>
                        <input onfocus="emailChange(this)" onBlur="emailReset(this)" type="text" class="input" placeholder="E-mail" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
                    </div>
                    <span id='email' style='color:red;'></span>
                            
                            
                        <div class="inputF" id="passwordInput" >
                            <i class="fa-solid fa-lock" id="passIcon"></i>
                            <input onfocus="passChange(this)" onBlur="passReset(this)" type="password" class="input" onFocus="passChange()" placeholder="Password" name="password" >
                        </div>
                        <span id='pass' style='color:red;'></span>
                        
                        
                    <div class="submit">
                        <button type="submit" name="sbtn" class="button">login</button>
                    </div>
                </form>
                
                
            <div class="more">
                <p>Countinue as <a href="viewAll2.php">guest</a></p>
                <p>Dont have an account yet? <a href="signup.php">signup</a></p>
            </div>

          </div>
        </main>

        <div class="side">
            <img src="" alt="">
        </div>
    </div>

    <script>
        /*const username = document.querySelector("#email");
        username.addEventListener("click", emailChange() {
          document.getElementById('emailInput').style.borderBottomColor = '8a92fd';
          document.getElementById('userIcon').style.color = '8a92fd';
        });*/

        function emailChange(input) {
            const element = document.getElementById('emailInput');
            const icon = document.getElementById('userIcon');
            element.style.borderBottomColor = '#8a92fd';
            icon.style.color = '#8a92fd';
        }

        function emailReset(input) {
            const element = document.getElementById('emailInput');
            const icon = document.getElementById('userIcon');
            element.style.borderBottomColor = '#757575';
            icon.style.color = '#757575';
        }
        
        function passChange(input) {
            const element = document.getElementById('passwordInput');
            const icon = document.getElementById('passIcon');
            element.style.borderBottomColor = '#8a92fd';
            icon.style.color = '#8a92fd';
        }

        function passReset(input) {
            const element = document.getElementById('passwordInput');
            const icon = document.getElementById('passIcon');
            element.style.borderBottomColor = '#757575';
            icon.style.color = '#757575';
        }
    </script>
  </body>
  </html>
<?php 


if(isset($_POST['sbtn']))
{
  $print=false;
  if(trim($_POST['email'])==""){
    echo"<script>document.getElementById('email').innerHTML='* E-mail is required'; document.getElementById('emailInput').style.borderBottomColor = 'red';</script>";
    $print=true;
  }
  if(trim($_POST['password'])==""){
    echo"<script>document.getElementById('pass').innerHTML='* Password is required'; document.getElementById('passwordInput').style.borderBottomColor = 'red';</script>";
    $print=true;
  }
  if(!$print)
  {
    $userEmail=$_POST['email'];
    $userPassword=$_POST['password'];

    //if the input is not valid
    if(preg_match($emailReg, $userEmail))
    {
      try
      {
      require('connection.php');
      $sql="SELECT * FROM users WHERE email LIKE ?";
      $result=$db->prepare($sql);
      $result->execute(array($userEmail));
      $db=null;
      } catch(PDOEXCEPTION $e)
      {
      die($e->getMessage());
      }

      $count = $result->rowCount();
      $row=$result->fetch(PDO::FETCH_ASSOC);
      if($count == 1)
      {
        if(password_verify($userPassword,$row['password']))
        {
            $_SESSION['currentUser']=$row["uid"];
            header('location:viewAll2.php');
        }  
        else{
          echo"<script>document.getElementById('message').innerHTML='E-mail or password is not valid';
                       document.getElementById('messageBox').style.visibility = 'visible'</script>";
          $print=true;
        }
      }
      else 
      {
        echo "<script>document.getElementById('message').innerHTML='E-mail or password is not valid';
                      document.getElementById('messageBox').style.visibility = 'visible';</script>";
        
      }
    }
    else
    {
      echo"<script> document.getElementById('message').innerHTML='E-mail or password is not valid'; 
                  document.getElementById('messageBox').style.visibility = 'visible';</script>";
      $print=true;
    }
  }
}




?>

