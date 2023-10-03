<?php
session_start();
// Connect to the database
$servername = "localhost";
$db_username = "root";
$password = "";
$dbname = "rn_8164";

$conn = mysqli_connect($servername, $db_username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account_type = $_POST["account_type"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    

    // Check if the username already exists
    $sql = "SELECT * FROM rn_login WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Username already exists. Please choose another username.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO rn_login (account_type, username, password) VALUES ('$account_type','$username', '$password')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to welcome page with username parameter
            if ($account_type == "startup") {
              $_SESSION['username'] = $username;
                header("Location: startuplogin.php");
            } else if ($account_type == "user") {
              $_SESSION['username'] = $username;
                header("Location: userlogin.php");
            }
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Page Title</title>
    <style>
.left-image{
  width: 400px;
  height: 400px;
}
.right-image {
  width: 500px;
  height: 500px;
}

.left-image {
  position: absolute;
  left: 3cm;
  top: 0;
}

.right-image {
  position: absolute;
  right: 2cm;
  top: -1cm;
}

header {
  text-align: center;
}

.header-text {
  font-weight: bold;
}

form {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 100px;
  background-color: lightcyan;
}

label {
  margin-top: 20px;
  font-size: 25px;
}

input[type="text"],
input[type="password"],
select {
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 2px solid purple;
  width: 300px;
  color: black;
}

select {
  width: 316px;
}

input[type="submit"] {
  margin-top: 20px;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  color: black;
  cursor: pointer;

  background: linear-gradient(45deg, #FFA500, #FF4500);
  font-size: 18px;
  font-weight: 700;
  /* outline: none; */
}

input[type="submit"]:hover {
  background-color: orangered;
}


</style>

  </head>
  <body>
  <header>
  <h1 class="header-text">Kick Start Your Journey</h1>
</header>
  <form method="post" action="">
  <img src="right-image.png" class="right-image">

  <img src="left-image.png" class="left-image">
    <label for="account_type">Account Type:</label>
		<select name="account_type" id="account_type" required>
			<option value="">-- Select Account Type --</option>
			<option value="startup">Startup</option>
			<option value="user">User</option>
		</select>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <br>
    <input type="submit" value="Register">
</form>
  </body>
</html>