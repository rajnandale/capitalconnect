<!DOCTYPE html>
<html>
<head>
    <title>Raise the Funds</title>
    <style>
        .container {
  margin-left: 475px;
  width: 400px;
  padding: 20px;
  background-color: #f2f2f2;
  border-radius: 5px;
}

.container h3 {
  margin-top: 0;
}

.container label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

.container input[type="text"],
.container textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 10px;
}

.container input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.container input[type="submit"]:hover {
  background-color: #45a049;
}

.home-button {
  border-radius: 5px;
  width: 100px;
  height: 20px;
  background: linear-gradient(45deg, orange, darkorange);
  border: none;
  outline: none;
  color: white;
  font-size: 16px;
  padding: 10px;
  box-shadow: 0 2px 6px rgba(255, 140, 0, 0.3);
  cursor: pointer;
  text-decoration: none;
  margin-bottom: 20px;
}

p {
  margin: 0;
  padding-top: 100px;
  color: orange;
  font-size: 100px;
}

body {
  display: flex;
  font-family: 'Montserrat', sans-serif;
}

    </style>

</head>
<body>
<a href='index.php' class='home-button'>Home</a>
    <p><strong>Raise <br> the <br> FUNDS</strong></p>
    <form class="container" method="POST" action="">
        <h3>Equity and Valuation:</h3>
        <label for="equity">Amount of Equity Offered (%):</label>
        <input type="number" name="equity" required><br><br>
        
        <label for="valuation">Current Valuation of your company(lakh):</label>
        <input type="number" name="valuation" required><br><br>
        
        <label for="description">Description:</label>
        <textarea name="description" rows="4" cols="50"></textarea><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
<?php
session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted values from the form
    $newEquity = !empty($_POST['equity']) ? $_POST['equity'] : 0.00;
    $newValuation = !empty($_POST['valuation']) ? $_POST['valuation'] : NULL;
    $newDescription = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : null;
    $username = $_SESSION['username'];
    
    // Perform validation on the submitted values if needed
    
    // Establish a database connection
    $servername = "localhost";
    $dbusername = "root";
    $password = "";
    $dbname = "rn_8164";
    
    $conn = new mysqli($servername, $dbusername, $password, $dbname);
    
    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Build the update query
    $sql = "UPDATE rn_raise SET equity = $newEquity, valuation = $newValuation";
    
    // Only include description in the update query if it is not empty
    if ($newDescription !== null) {
        $sql .= ", description = '$newDescription'";
    }
    
    $sql .= " WHERE username = '$username'";
    
    // Execute the update query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: index.php"); // Redirect to index.php
        exit(); // Terminate the current script
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}
?>