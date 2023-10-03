<body>
<a href='index.php' class='home-button'>Home</a>
</body>
<?php
session_start();
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rn_8164";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get the user's information from the database
if (isset($_GET['username'])) {
    $user = mysqli_real_escape_string($conn, $_GET['username']);

    $query = "SELECT * FROM rn_user WHERE username = '$user'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // User found, display their information
        $row = $result->fetch_assoc();
    
        $name = $row['name'];
        $email = $row['email'];
        $gender= $row['gender'];
        $dob=$row['dob'];
        $mob= $row['mobile'];
        $pan=$row['pan_id'];
        
        echo "<div class='container'>";
        echo "<h2>User Profile</h2>";
        echo "<p>Username: $user</p>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Mobile: $mob</p>";
        echo "<p>Gender: $gender</p>";
        echo "<p>DOB: $dob</p>";
        echo "<p>PAN: $pan</p>";
        echo "<form action='user_update.php' method='post'>";
        echo "<input type='hidden' name='username' value='$user'>";
        echo "<input type='submit' class='edit-button' name='edit_profile' value='Edit Profile'>";
        echo "</form>";
        echo "</div>";
    } 
    else 
    {// Get the startup's information from the database
$sql = "SELECT * FROM rn_startup WHERE username = '$user'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Startup found, display their information
    $row = $result->fetch_assoc();

    $name = $row['name'];
    $email = $row['email'];
    $profile_image = $row['image_path'];
    $pdf_file = $row['file_path'];
    $web = $row['web'];
    $cat = $row['category'];
    $mob = $row['mobile'];
    $reg_id = $row['reg_id'];

    echo "<div class='container'>";
    echo "<h2>Startup Profile</h2>";
    echo "<p>Username: $user</p>";
    echo "<p>Startup Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Mobile: $mob</p>";
    echo "<p>Registration ID: $reg_id</p>";
    echo "<p>Category: $cat</p>";
    echo "<p>Website: $web</p>";
    // echo "<p>Profile Image: <img src=#></p>";
    // echo "<p>PDF File: <a href=# target='_blank'>View PDF</a></p>";
    echo "<form action='startup_update.php' method='post'>";
    echo "<input type='hidden' name='username' value='$user'>";
    echo "<input type='submit' class='edit-button' name='edit_profile' value='Edit Profile'>";
    echo "<a href='raise.php?username=$user' class='pitch-button'>Make a Pitch</a>";
    echo "</form>";
    echo "</div>";
    $_SESSION['username'] = $user;
}
        }
    }
?>


<style>
  a{
        border-radius: 5px;
        width: 100px;
        background: linear-gradient(45deg, orange, darkorange);
        border: none;
        outline: none;
        color: white;
        font-size: 16px;
        padding: 10px;
        box-shadow: 0 2px 6px rgba(255, 140, 0, 0.3);
        cursor: pointer;
        text-decoration: none;
}
body {
  background-color: #fff;
}

.container {
  margin: 20px auto;
  max-width: 600px;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.container h2 {
  color: #ff9900;
  text-align: center;
}

.container p {
  margin-bottom: 10px;
}

.edit-button {
    background-image: linear-gradient(45deg, orange, darkorange);
  border: none;
  outline: none;
  color: white;
  font-size: 16px;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.edit-button:hover {
  background-color: darkorange;
}

.pitch-button {
  position: absolute;
  background-image: linear-gradient(135deg, green, yellowgreen);
  margin-left:300px;
  border: none;
  outline: none;
  color: white;
  font-size: 16px;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
}

.pitch-button:hover {
  background-image: linear-gradient(135deg, yellowgreen, green);
}
</style>
