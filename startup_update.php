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
    $gov_id = mysqli_real_escape_string($conn, $_POST['gov_id']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    // $category = mysqli_real_escape_string($conn, $_POST['category']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);

    // // Check if an image was uploaded
    // if ($_FILES['image']['error'] == 0) {
    //     $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    // } else {
    //     $image = null;
    // }

    // // Check if a file was uploaded
    // if ($_FILES['file']['error'] == 0) {
    //     $fileContent = addslashes(file_get_contents($_FILES['file']['tmp_name']));
    // } else {
    //     $fileContent = null;
    // }

    // Update the user's information in the database
    $query = "UPDATE rn_startup SET name='$name', email='$email', reg_id='$gov_id', mobile='$mobile', web='$website' WHERE username='$user'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: edit_profile.php?username=" . urlencode($user));
        exit;
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
} else {
    // Get the user's information from the database
    $query = "SELECT * FROM rn_startup WHERE username = '$user'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // User found, display their information
        $row = $result->fetch_assoc();

        $name = $row['name'];
        $email = $row['email'];
        $gov_id = $row['reg_id'];
        $mobile = $row['mobile'];
        $category = $row['category'];
        $website = $row['web'];

        // Display the form to edit the user's information
        echo "<div class='container'>";
        echo "<h2>Edit Profile</h2>";
        echo "<form method='post' enctype='multipart/form-data'>";
        echo "<p>Username: $user</p>";
        echo "<p>Name: <input type='text' name='name' value='$name'></p>";
        echo "<p>Email: <input type='email' name='email' value='$email'></p>";
        echo "<p>Government ID: <input type='text' name='gov_id' value='$gov_id'></p>";
        echo "<p>Mobile: <input type='text' name='mobile' value='$mobile'></p>";
        // echo "<p>Category: <select name='category' value='$category'>
        // <option disabled selected style='font-weight: bold;'>Select category</option>
        //     <option>Technology and Software</option>
        //     <option>E-commerce and Retail</option>
        //     <option>Healthtech and Medtech</option>
        //     <option>Fintech</option>
        //     <option>Food and Beverage</option>
        //     <option>Clean Energy and Sustainability</option>
        //     <option>Education Technology (EdTech)</option>
        //     <option>Travel and Hospitality</option>
        //     <option>Internet of Things (IoT)</option>
        //     <option>Biotechnology and Life Sciences</option>
        //     <option>Social Impact and Sustainability</option>
        //     <option>Entertainment and Media</option>
        //     <option>Automobile</option>
        //     <option disabled selected style='font-weight: bold;'>Other</option>
        // </select></p>";

        echo "<p>Website: <input type='text' name='website' value='$website'></p>";
        // echo "<p>Profile Image: <input type='file' name='image'></p>";
        // echo "<p>File: <input type='file' name='file'></p>";
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
