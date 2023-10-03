<?php
session_start();
$host = 'localhost';
$db_username = 'root';
$dbpass = '';
$dbname = 'rn_8164';

if (isset($_POST['submit'])) {
    $conn = mysqli_connect($host, $db_username, $dbpass, $dbname) or die("Connection failed" . mysqli_connect_error());

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['category'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $category = $_POST['category'];
        $reg_id = isset($_POST['reg_id']) ? $_POST['reg_id'] : '';
        $web = isset($_POST['web']) ? $_POST['web'] : '';
        $username = $_SESSION['username'];
        $file = $_FILES['file'];
        $uploadDirectory = 'startupfile/';
        $image = $_FILES['image'];
        $uploadDirectory1 = 'startupimage/';

        if ($file['error'] === UPLOAD_ERR_OK) {
            $tempFilePath = $file['tmp_name'];
            $fileName = $file['name'];
            $destination = $uploadDirectory . $fileName;
            $tempimagePath1 = $image['tmp_name'];
            $imageName1 = $image['name'];
            $destination1 = $uploadDirectory1 . $imageName1;

            if (move_uploaded_file($tempFilePath, $destination) && move_uploaded_file($tempimagePath1, $destination1)) {
                // Prepare the SQL statement with placeholders for the file content and profile picture content
                $stmt = $conn->prepare("INSERT INTO `rn_startup` (`name`, `username`, `email`, `mobile`, `category`, `reg_id`, `web`, file_path, file_type, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssss", $name, $username, $email, $mobile, $category, $reg_id, $web, $destination, $file['type'], $destination1);

                if ($stmt->execute()) {
                    $stmt1 = $conn->prepare("INSERT INTO rn_raise (username) VALUES (?)");
                    $stmt1->bind_param("s", $username);
                    $stmt1->execute();
                    $_SESSION['login'] = $username;
                    echo "<script> alert('Entry Successful');
                        document.location.href = 'index.php';
                        </script>";
                } else {
                    echo "Error uploading file: " . $stmt->error;
                }
            }
        }
    }
}
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Registration Form</title> 
    <style>
/* .submit {
    background-color: #4070f4;
    color: #fff;
} */
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
    /* background: #4070f4; */
}
.bg {
    position: absolute;
    z-index: -1;
    opacity: 1;
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
    height: 630px;
}
.container header{
    margin-left: 350px;
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
    /* overflow: hidden; */
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
    font-size: 18px;
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
    width: calc(100% / 2 - 15px);
    flex-direction: column;
    margin: 4px 0;
}
.input-field label{
    font-size: 16px;
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
    box-shadow: 0 10px 20px rgba(0,0,0,0.30);
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
    /* max-width: 200px; */
    width: 100%;
    border: none;
    outline: none;
    color: #fff;
    border-radius: 5px;
    margin: 25px 0;
    background: linear-gradient(45deg, #FFA500, #FF4500);
    /* transition: all 0.3s linear; */
    cursor: pointer;
}
.container form .btnText{
    font-size: 20px;
    font-weight: 400;
}
form button:hover{
    background-color: orangered;
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
form .register-link {
    /* background-color: #4070f4; */
    margin: 0 auto;
    font-size: 20px;
    font-weight: 400;
    transition: all 0.3s linear;
}
form .register-link a {
    text-decoration: none;
    color: blue;
    font-size: 20px;
    font-weight: 400;
    transition: all 0.3s linear;
}
form .register-link a:hover{
    text-decoration: underline;
    font-weight: 500;
    font-size: 22px;
    transition: all 0.3s ;
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
.avatar-preview {

    display: flex;
    justify-content: center;
    align-items: center;
    width: 100px;
    height: 100px;
    position: relative;
    border-radius: 50%;
    border: 1px solid #ccc;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.avatar-preview #imagePreview {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-radius: 50%;
}


.avatar-edit {
  position: absolute;
  top: 0px;
  left:0px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background-color: transparent;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

.avatar-edit label {
    width:1px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.avatar-edit label i {
  font-size: 1.2rem;
  color: transparent;
}

.uil-camera:before {
  content: "\f1b0";
  font-size: 18px;
}


</style>    
</head>
<body>
    <div class="container">
        <header>Register</header>
        <form action="" method="post" enctype="multipart/form-data">
  <div class="form first">
    <div class="details personal">
    <span class="title"></span>
      <div class="profile-picture">
        <div class="avatar-upload">
          <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url('default_startup_profile.png');"></div>
          </div>
          <div class="avatar-edit">
            <input type="file" id="imageUpload" name="image" required>
            <label for="imageUpload"><i class="uil uil-camera"></i></label>
          </div>
          <script>
  const imageUpload = document.getElementById('imageUpload');
  const imagePreview = document.getElementById('imagePreview');

  imageUpload.addEventListener('change', () => {
    const file = imageUpload.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', () => {
      imagePreview.innerHTML = `<img src="${reader.result}" alt="Preview Image">`;
    });

    reader.readAsDataURL(file);
  });
</script>
        </div>
      </div>

                    <div class="fields">
                        <div class="input-field">
                            <label>Startup Name</label>
                            <input type="text" placeholder="Enter startup name" name="name" required>
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" placeholder="Enter your email" name="email" required>
                        </div>
                        <div class="input-field">
                            <label>GOV.REG. ID</label>
                            <input type="text" placeholder="Startup Reg. ID" name="reg_id" >
                        </div>

                        <div class="input-field">
                            <label>Contact Number</label>
                            <input type="number" max=9999999999 placeholder="Enter mobile number" name="mobile" required>
                        </div>

                        <div class="input-field">
    <label>Category</label>
    <select name="category" required>
    <option disabled selected style="font-weight: bold;">Select category</option>
        <option>Technology and Software</option>
        <option>E-commerce and Retail</option>
        <option>Healthtech and Medtech</option>
        <option>Fintech</option>
        <option>Food and Beverage</option>
        <option>Clean Energy and Sustainability</option>
        <option>Education Technology (EdTech)</option>
        <option>Travel and Hospitality</option>
        <option>Internet of Things (IoT)</option>
        <option>Biotechnology and Life Sciences</option>
        <option>Social Impact and Sustainability</option>
        <option>Entertainment and Media</option>
        <option>Automobile</option>
        <option style="font-weight: bold;">Other</option>
    </select>
</div>
                        <div class="input-field">
                            <label>Website</label>
                            <input type="text" placeholder="Enter your website" name="web">
                        </div>
                        <div>
                            <label for="fileContent">File Content:</label>
                            <input type="file" id="fileContent" name="file" required><br><br>
                        </div>
                        <button type="submit" class="submit" name="submit">
                            <span class="btnText">Submit</span>
                            <!-- <i class="uil uil-navigator"></i> -->
                        </button>
                        <div class="register-link">
                            Already a member? <a href="login.php">Log In</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>