
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/home.css">
        <title>PollMaker</title>
    </head>
    <body>
        <div class="container">
            <header>
                <div class="webname">
                    <img src="images/icons.png" alt="LOGO">
                    <button onClick="location.href='homepage.php'" class="homepage">Your Creation</button> 
                </div>    

                <nav>
                    <div class="btn">
                        <button onclick="location.href='login.php'" class="login">Log In</button>
                    </div>
                        
                    <div class="btn">
                        <button onclick="location.href='signup.php'" class="signup">sign up</button> 
                    </div>
                </nav>

                <div class='mob-wrapper'>
                            <img src='images/icons8-menu.svg' alt='Mobile Menu Icon' style='width: 40px;' class='menu' />
                            <div class='hide' style='display:none;'>
                                <a href='Login.php'>Login</a>
                                <a href='Signup.php'>Sign In</a>
                            </div>
                </div>
            </header>
            
            <main>
                <div class="desc">
                    <div class="text">
                        <h1>Welcome to Our pollmaker<i class="fa-solid fa-exclamation"></i></h1>
                        <p>Create and explore polls<br/> you can enjoy creating your own polls and explore responces fastly and easly</p>
                    </div>

                    <div class="guest" onclick="location.href='viewAll2.php'">
                        Continue as guest<i class="fa-regular fa-greater-than"></i>
                    </div>
                </div>

                <!-- <div class="image" >
                    <img src="images/img.svg" alt="LOGO">
                </div> -->
            </main>
<!-- 
            <footer>
                <p class="footer">
                    Inc. 2023 - All rights are reserved for Group 5
                </p> 
            </footer> -->
        </div>

        <img src='images/icons8-menu.svg' alt='Mobile Menu Icon' style='width: 40px;' class='menu' />


        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
        <script src="jquery-nav.js"></script>
    </body>
</html>
