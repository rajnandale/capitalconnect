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

$user = $_SESSION['username'];
// If the form was submitted
if (isset($_POST['submit'])) {
    // Get the updated information from the form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $pan_id = mysqli_real_escape_string($conn, $_POST['pan_id']);

    // Update the user's information in the database
    $query = "UPDATE rn_user SET name='$name', email='$email', gender='$gender', dob='$dob', mobile='$mobile', pan_id='$pan_id' WHERE username='$user'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: edit_profile.php?username=" . urlencode($user));
        exit;
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
} else {
    // Get the user's information from the database
    $query = "SELECT * FROM rn_user WHERE username = '$user'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // User found, display their information
        $row = $result->fetch_assoc();

        $name = $row['name'];
        $email = $row['email'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $mobile = $row['mobile'];
        $pan_id = $row['pan_id'];

        // Display the form to edit the user's information
        echo "<div class='container'>";
        echo "<h2>Edit Profile</h2>";
        echo "<form method='post'>";
        echo "<p>Username: $user</p>";
        echo "<p>Name: <input type='text' name='name' value='$name'></p>";
        echo "<p>Email: <input type='email' name='email' value='$email'></p>";
        echo "<p>Gender: 
                <label><input type='radio' name='gender' value='Male' " . ($gender == 'Male' ? 'checked' : '') . "> Male</label>
                <label><input type='radio' name='gender' value='Female' " . ($gender == 'Female' ? 'checked' : '') . "> Female</label>
                <label><input type='radio' name='gender' value='Other' " . ($gender == 'Other' ? 'checked' : '') . "> Other</label></p>";
        echo "<p>DOB: <input type='date' name='dob' value='$dob'></p>";
        echo "<p>Mobile: <input type='text' name='mobile' value='$mobile'></p>";
        echo "<p>PAN: <input type='text' name='pan_id' value='$pan_id'></p>";
        echo "<input type='submit' name='submit' value='Update' class='edit-button'>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "User not found";
    }
}
?>
<style>
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
</style>
