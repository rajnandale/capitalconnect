<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'rn_8164';
$con=mysqli_connect($server,$user,$pass,$db) or die(mysqli_connect_error());
if(isset($_POST["submit"])){  
  if(!empty($_POST['username1']) && !empty($_POST['password1'])) {  
      $username1 = $_POST['username1'];  
      $password1 = $_POST['password1'];  
    
      $result = "SELECT * FROM rn_login WHERE username ='$username1' AND password ='$password1'";
      $query = mysqli_query($con, $result); 
      if($query){
      if(mysqli_num_rows($query) === 1)  
      {
      $row = mysqli_fetch_assoc($query);
      if($row['username']===$username1 && $row['password']===$password1){
        $_SESSION['login']=$username1;
        echo "<script> 
             document.location.href = 'index.php';     
             </script>";
      }
      else{
       echo "Incorrect username or password";
      }
    }
  }
      else{
        echo "<script> alert('Something Went Wrong');
        document.location.href = 'login.php';     
        </script>";
      }
    }
  }  
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
      /* @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap'); */

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
.bg {
  position: absolute;
  z-index: -1;

}
body {
  margin: 0;
  padding: 0;
  background-color: white;
  height: 100vh;
  overflow: hidden;
}


.center {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 400px;
  background: transparent;
  border-radius: 10px;
  box-shadow: 0px 0px 15px 5px #FFA500; /* Increase the shadow size and set the color */
}

input[type="submit"] {
  width: 100%;
  height: 50px;
  border: none; /* Remove the button outline */
  background: linear-gradient(45deg, #FFA500, #FF4500);
  border-radius: 25px;
  font-size: 18px;
  color: #e9fbfa;
  font-weight: 700;
  cursor: pointer;
  outline: none;
}

input[type="submit"]:hover {
  background: linear-gradient(45deg, #FF4500, #FF8C00); /* Set the button hover color to dark orange gradient */
  border-color: #FFA500;
  transition: .5s;
}


.center h1 {
  text-align: center;
  padding: 20px 0;
  border-bottom: 1px solid rgb(28, 27, 27);
}

.center form {
  padding: 0 40px;
  box-sizing: border-box;
}

form .txt_field {
  position: relative;
  border-bottom: 2px solid #121111;
  margin: 30px 0;
}

.txt_field input {
  width: 100%;
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
}

.txt_field label {
  position: absolute;
  top: 50%;
  left: 5px;
  color: #131313;
  transform: translateY(-50%);
  font-size: 16px;
  pointer-events: none;
  transition: .5s;
}

.txt_field span::before {
  content: '';
  position: absolute;
  top: 40px;
  left: 0;
  width: 0%;
  height: 2px;
  background: #11bdd7;
  transition: .5s;
}

.txt_field input:focus~label,
.txt_field input:valid~label {
  top: -5px;
  color: #02070a;
}

.txt_field input:focus~span::before,
.txt_field input:valid~span::before {
  width: 100%;
}

.pass {
  margin: -5px 0 20px 5px;
  color: #492702;
  cursor: pointer;
}

.pass:hover {
  text-decoration: underline;
}


.signup_link {
  margin: 30px 0;
  text-align: center;
  font-size: 16px;
  color: #492702;
}

.signup_link a {
  color: linear-gradient(45deg, #589fb1, #11bdd7);
  text-decoration: none;
}

.signup_link a:hover {
  text-decoration:wavy;
}

.progress {

  height: 3px;
  background-color: red;
  animation: load 1s ease-in-out 1;

}

@keyframes load {
  0% {
    width: 0;
  }

  50% {
    width: 80vw;
  }

  100% {
    width: 100vw;
  }
}
    </style>
  </head>
  <body>
    <div class="progress"> 
    </div>
    <img src="vector.png" width="170" height="130" class="logo" alt=""> </a>
    <div class="center">
      <h1>Sign In</h1>
      <form action='login.php' method="post">
        <div class="txt_field">
          <input type="text" name="username1" id="username1" required>
          <span></span>
          <label for="username">Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password1" id="password1" required>
          <span></span>
          <label for="password">Password</label>
        </div>
        <div class="pass">Forgot Password?</div>
        <input type="submit" name="submit" id="submit" value="Submit" > 

        <!-- <div class="search">
          <a href="index1.php" >Login</a>
        </div> -->
        <div class="signup_link">
          Not a member? <a href="username.php"> REGISTER</a>
        </div>
      </form>
    </div>
    <script>
      function auth(){
        // var username = document.getElementById('username').value;
        // var password = document.getElementById('password').value;
        // if(username == 'username' && password == 1234){
          window.location.assign("index.php");
          alert("Login Successful");
      //   }
      //   else{
      //     alert("Invalid Information");
      //     return;
      //   }
      }
    </script>
  </body>
</html>