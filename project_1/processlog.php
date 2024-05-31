<?php

//set session to expiration time to 1800 seconds
$session_timeout = 1;  
ini_set('session.gc_maxlifetime' ,$session_timeout);
//set cookie expiration time to match session expiration time 
session_set_cookie_params($session_timeout );
session_start();
//
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'try';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $email = $_POST['username']; 
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM try101 WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_hashed_password = $row['password'];
        $fullname = $row['fullname']; // Fetching the full name
        $dob =$row['dob'];
        if (password_verify($password, $stored_hashed_password)) {
            $_SESSION['email'] = $email;
            $_SESSION['fullname'] = $fullname; 
            $_SESSION['dob'] = $dob;// Storing the full name in session
            header("location:welcome.php");
            exit();
        } else {
            // Invalid password
            $error_message = "Invalid username or password";
        }
    } else {
        // User not found
        $error_message = "User not found";
    }
    
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="stylesheet" href="style.css">
     
    
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

   <title>Responsive Regisration Form </title>
   <style>
    
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #4070f4;
}
.container{
    position: relative;
    max-width: 900px;
    width: 100%;
    border-radius: 6px;
    padding: 30px;
    margin: 0 15px;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}
.container header{
    position: relative;
    font-size: 20px;
    font-weight: 600;
    color: #333;
}
.container header::before{
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    height: 3px;
    width: 27px;
    border-radius: 8px;
    background-color: #4070f4;
}
.container form{
    position: relative;
    margin-top: 16px;
    min-height: 490px;
    background-color: #fff;
    overflow: hidden;
}
.container form .form{
    position: absolute;
    background-color: #fff;
    transition: 0.3s ease;
}
.container form .form.second{
    opacity: 0;
    pointer-events: none;
    transform: translateX(100%);
}
form.secActive .form.second{
    opacity: 1;
    pointer-events: auto;
    transform: translateX(0);
}
form.secActive .form.first{
    opacity: 0;
    pointer-events: none;
    transform: translateX(-100%);
}
.container form .title{
    display: block;
    margin-bottom: 8px;
    font-size: 16px;
    font-weight: 500;
    margin: 6px 0;
    color: #333;
}
.container form .fields{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
form .fields .input-field{
    display: flex;
    width: calc(100% / 3 - 15px);
    flex-direction: column;
    margin: 4px 0;
}
.input-field label{
    font-size: 12px;
    font-weight: 500;
    color: #2e2e2e;
}
.input-field input, select{
    outline: none;
    font-size: 14px;
    font-weight: 400;
    color: #333;
    border-radius: 5px;
    border: 1px solid #aaa;
    padding: 0 15px;
    height: 42px;
    margin: 8px 0;
}
.input-field input :focus,
.input-field select:focus{
    box-shadow: 0 3px 6px rgba(0,0,0,0.13);
}
.input-field select,
.input-field input[type="date"]{
    color: #707070;
}
.input-field input[type="date"]:valid{
    color: #333;
}
.container form button, .backBtn{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 45px;
    max-width: 200px;
    width: 100%;
    border: none;
    outline: none;
    color: #fff;
    border-radius: 5px;
    margin: 25px 0;
    background-color: #4070f4;
    transition: all 0.3s linear;
    cursor: pointer;
}
.container form .btnText{
    font-size: 14px;
    font-weight: 400;
}
form button:hover{
    background-color: #265df2;
}
form button i,
form .backBtn i{
    margin: 0 6px;
}
form .backBtn i{
    transform: rotate(180deg);
}
form .buttons{
    display: flex;
    align-items: center;
}
form .buttons button , .backBtn{
    margin-right: 14px;
}

@media (max-width: 750px) {
    .container form{
        overflow-y: scroll;
    }
    .container form::-webkit-scrollbar{
       display: none;
    }
    form .fields .input-field{
        width: calc(100% / 2 - 15px);
    }
}

@media (max-width: 550px) {
    form .fields .input-field{
        width: 100%;
    }
}
.invalid-login-message{
    color: red;
}
  </style>
</head>
<body>
    <div class="container">
        <header> LOGIN TO CONTINUE  </header>

        <form action="" method="post">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>
                        <div class="input-field">
                            <label>Email</label>
                            <input type="text" name="username" placeholder="Enter your email" required>
                        </div>
                        <?php
                          if(isset($_POST['submit']) && !isset($_SESSION['username'])): ?>
                            <div class="invalid-login-message">
                               <h6> Invalid username or password</h6>
                            </div>
                        <?php endif; ?>

                        <div class="input-field">
                            <label>PASSWORD</label>
                            <input type="password" name="password" placeholder="Enter your password" required>
                           
                        </div>
                       
                       
                        <button type="submit" name="submit" value="submit" class="nextBtn">
                        <span class="btnText">login</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                    <h5> don't have an account sign up here  <a href="process.php">sign up</a></h5>
                </div> 
                
            </div>

           
        </form>
    </div>

    </body>
</html>