<?php
session_start();
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/signup.css">
</head>
<body>
<div class="container">
        <main>
            <div class="signup">
              <p id="msg" class="msgc"></p>

                <h1>Sign up</h1>

                <form method="post">

                  <div class="input" id="nameInput">
                  <i class="fa-solid fa-user" id="userIcon"></i>
                    <input type="text" onfocus="nameChange(this)" onBlur="nameReset(this)" placeholder="Name" name="name"  value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>">
                  </div>
                    <span id='name' style='color:red;'></span>

                  <div class="input" id="emailInput" >
                  <i class="fa-solid fa-envelope" id="emailIcon"></i>
                  <input type="email" onfocus="emailChange(this)" onBlur="emailReset(this)" placeholder="E-mail" name="email"  value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"  onkeyup="checkMail(this.value)">                     
                  </div>
                  <span id="emsg"></span>
                  <span id='email' style='color:red;'></span>


                  <div class="input" id="passwordInput">
                  <i class="fa-solid fa-lock" id="passIcon"></i>
                  <input type="password" onfocus="passChange(this)" onBlur="passReset(this)" placeholder="Password" name="password" >
                  </div>
                  <span id='pass' style='color:red;'></span>


                  <div class="input" id="confirmPassword">
                  <i class="fa-solid fa-lock" id="cpassIcon"></i>
                    <input type="password" onfocus="cpassChange(this)" onBlur="cpassReset(this)" placeholder="Confirm Password" name="ConPassword">
                  </div>
              <span id='cpass' style='color:red;'></span>

                  <div class="submit">
                    <button type="submit" name="sbtn">Sign up</button>
                  </div>
                </form>

            
                  <div class="more">
                  <p>Countinue as <a href="viewAll2.php">guest</a></p>
                  <p>Already have an account? <a href="login.php">login</a></p>
                  </div>
             <div>

          </main>
          <div class="side">
      <img src="" alt="">
    </div>
         
</div>
<script>


function checkMail(email) {
    const result = /^[a-zA-z0-9._-]+@[a-zA-Z]+(\.[a-zA-Z]{2,5})+$/.test(email);
    if(!result){
      document.getElementById("emsg").style.color="red";
      document.getElementById("emsg").innerHTML = "Not Valid";
      return;
    }

  const xhttp = new XMLHttpRequest();
  xhttp.onload = myAJAXFunction;
  xhttp.open("POST", "checkEmail.php");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("email="+email);
}

function myAJAXFunction(){
  if (this.responseText=="taken"){
    document.getElementById('emsg').style.color="red";
    document.getElementById("emsg").innerHTML = "Not available";
  }
  else {
    document.getElementById('emsg').style.color="green";
    document.getElementById("emsg").innerHTML = "Available";
  }
}


function nameChange(input) {
    const element = document.getElementById('nameInput');
    const icon = document.getElementById('userIcon');
    element.style.borderBottomColor = '#8a92fd';
    icon.style.color = '#8a92fd';
  }

  function nameReset(input) {
    const element = document.getElementById('nameInput');
    const icon = document.getElementById('userIcon');
    element.style.borderBottomColor = '#757575';
    icon.style.color = '#757575';
  }


  function emailChange(input) {
    const element = document.getElementById('emailInput');
    const icon = document.getElementById('emailIcon');
    element.style.borderBottomColor = '#8a92fd';
    icon.style.color = '#8a92fd';
  }

  function emailReset(input) {
    const element = document.getElementById('emailInput');
    const icon = document.getElementById('emailIcon');
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

  function cpassChange(input) {
    const element = document.getElementById('confirmPassword');
    const icon = document.getElementById('cpassIcon');
    element.style.borderBottomColor = '#8a92fd';
    icon.style.color = '#8a92fd';
  }

  function cpassReset(input) {
    const element = document.getElementById('confirmPassword');
    const icon = document.getElementById('cpassIcon');
    element.style.borderBottomColor = '#757575';
    icon.style.color = '#757575';
  }
        
        
</script>
</body>
</html>

<?php
  //name validation (only charecters and space are allowed)
  $nameReg="/^[A-Za-z\s]{2,25}$/";

  //email validation
  $emailReg="/^[a-zA-z0-9._-]+@[a-zA-Z]+(\.[a-zA-Z]{2,5})+$/";

  //password validation 
  //(at least 1 capital letter,at least 1 small letter,at least 1 digit,at least 1 special charecter)
  $passReg="/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[_#@%\*\-])[A-Za-z0-9_#@%\*\-]{8,24}$/";

  //check if the form is submited and all input field are not empty
  if(isset($_POST["sbtn"]) ){
    $name= $_POST["name"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $conPassword=$_POST['ConPassword'];
     //if the input is not valid
     if(!preg_match($nameReg,$name))
        echo "<script>document.getElementById('name').innerHTML='* Name is not valid'; document.getElementById('nameInput').style.borderBottomColor = 'red';</script>";
     if(!preg_match($emailReg,$email))
     echo "<script>document.getElementById('email').innerHTML='* E-mail is not valid'; document.getElementById('emailInput').style.borderBottomColor = 'red';</script>";
     if(!preg_match($passReg,$password))
     echo "<script>document.getElementById('pass').innerHTML='* Password must contain capital and <br>small letter, digit, and character'; document.getElementById('passwordInput').style.borderBottomColor = 'red';</script>";
     if($password != $conPassword)
      echo "<script>document.getElementById('cpass').innerHTML='* passwords do not match'; document.getElementById('confirmPassword').style.borderBottomColor = 'red';</script>";

     if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['ConPassword']) ){

    //insert the data if all input are valid
   if(preg_match($nameReg,$name) && preg_match($emailReg,$email) && preg_match($passReg,$password))
   {
      try {
        require("connection.php");
        $query="INSERT INTO users VALUES (null,:name,:email,:password)";
        $stmt=$db->prepare($query);

        $hps=password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":password",$hps);

    
      if($stmt->execute()){
        echo "<script>document.getElementById('msg').innerHTML='Registered successfully, <a href=\'login.php\'>Login</a>'; </script>";
      }

      $db=null;

      } catch (PDOEXCEPTION $e) {
        die("Error ".$e->getMessage());
      }
       
  
  }
  } else{

    if( empty($_POST["name"]) ){
      echo "<script>document.getElementById('name').innerHTML='* Name is required'; document.getElementById('nameInput').style.borderBottomColor = 'red';</script>";

    }
    if(empty($_POST['email'])){
      echo "<script>document.getElementById('email').innerHTML='* Email is required'; document.getElementById('emailInput').style.borderBottomColor = 'red';</script>";

    if(empty($_POST['password'])){
      echo "<script>document.getElementById('pass').innerHTML='* Password is required'; document.getElementById('passwordInput').style.borderBottomColor = 'red';</script>";

    }
    if(empty($_POST['ConPassword'])){
      echo "<script>document.getElementById('cpass').innerHTML='* Confirm your password'; document.getElementById('confirmPassword').style.borderBottomColor = 'red';</script>";

    }

  }
}
  }
?>
