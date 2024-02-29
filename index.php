
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device width, initial scale=1.0">
    <title>CapitalConnect</title>
    <link rel="stylesheet" href="rupee.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <script src="dropdown.js"></script>
</head>

<body>
<section id="header">
    <a href ="index.php"> <img src="vector.png" width="130" height="100" class="logo" alt=""> </a>
    <div> 
        <ul id = "navbar">
            <li><a href ="https://www.startupindia.gov.in/content/sih/en/startup-scheme.html" >startupindia.gov</a></li>
            <?php
session_start();
$dbhost = "localhost";
    $dbname = "rn_8164";
    $dbusername = "root";
    $dbpassword = "";

	$conn = mysqli_connect($dbhost, $dbusername,$dbpassword, $dbname);
if (isset($_SESSION['login'])) {
    $username = $_SESSION['login'];
    $_SESSION['username'] = $username; // Set username session variable
    $query = "SELECT * FROM rn_startup WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
    echo '<li><a href="startup_details.php?key=' . $username . '" class="raise-button">My Startup</a></li>';
    echo '<li><a href="raise.php?username=' . $username . '" class="raise-button">* Raise *</a></li>';
  }
    // Display profile dropdown if the user is logged in
    echo '<div class="profile-dropdown">';
    echo '<button class="profile-button">' . $username . '</button>
            <div class="dropdown-content">
                <a href="edit_profile.php?username=' . urlencode($username) . '">Edit Profile</a>
                <form method="post">
                    <button type="submit" name="logout"><strong>logout</strong></button>
                </form>
            </div>
        </div>';
    

    if (isset($_POST['logout'])) {
        // Perform logout actions
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit;
    }
} else {
    // User is not logged in, display login link
    echo '<a href="login.php"><h6>Sign In</h6></a>';
}
?>

            </li>
        </ul>
    </div>
</section>

    <tagline>
    <div class="container">
		<div class="tagline"><strong>
			Invest in the<br>future of startups</strong>
		</div>
		<div class="view-more">
    <button onclick="location.href='explore.php'"><strong>EXPLORE</strong></button>
  </div>
		<div class="rupee"></div>
	</div>
    </tagline>

	<script>
		var counter = 1;
var rupeeButton = document.querySelector('.rupee');
var rupeeButtonRect = rupeeButton.getBoundingClientRect();
var xMin = rupeeButtonRect.left - 250;
var xMax = rupeeButtonRect.right + 50;
var yMin = rupeeButtonRect.top - 250;
var yMax = rupeeButtonRect.bottom + 40;

rupeeButton.addEventListener('click', function() {
  if (counter <= 100) {
    var newImage = document.createElement('img');
    newImage.setAttribute('src', 'rupee.png');
    newImage.classList.add('rupee-image');
    newImage.style.width = '100px';
    newImage.style.height = '100px';
    newImage.style.position = 'absolute';
    newImage.style.top = Math.floor(Math.random() * (yMax - yMin)) + yMin + 'px';
    newImage.style.left = Math.floor(Math.random() * (xMax - xMin)) + xMin + 'px';
    document.body.appendChild(newImage);
    counter++;
  }
});
    
            // Check if the element intersects with any existing elements
            function isIntersecting(element) {
                var rect1 = element.getBoundingClientRect();
                var elements = document.getElementsByClassName('rupee');
                for (var i = 0; i < elements.length; i++) {
                    var rect2 = elements[i].getBoundingClientRect();
                    if (!(rect1.right < rect2.left || 
                        rect1.left > rect2.right || 
                        rect1.bottom < rect2.top || 
                        rect1.top > rect2.bottom)) {
                        return true;
                    }
                }
                return false;
            }

		document.addEventListener('mouseover', function(event) {
			if (event.target.classList.contains('rupee-image')) {
				var allImages = document.querySelectorAll('.rupee-image');
				for (var i = 0; i < allImages.length; i++) {
					document.body.removeChild(allImages[i]);
				}
				counter = 1;
			}
		});
    var scrollToTopButton = document.querySelector('.scroll-to-top');

window.addEventListener('scroll', function() {
  if (window.pageYOffset > 300) {
    scrollToTopButton.style.display = "block";
  } else {
    scrollToTopButton.style.display = "none";
  }
});

scrollToTopButton.addEventListener('click', function() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});

	</script>

<?php
    // Database connection
    $dbhost = "localhost";
    $dbname = "rn_8164";
    $dbusername = "root";
    $dbpassword = "";
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

    // Fetch startups from the database
    $stmt = $db->prepare("SELECT * FROM rn_startup");
    $stmt->execute();
    $startups = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- startup search box -->
<section id="investment" class="section-1">
<div style="display:flex; justify-content:center; align-items:center; flex-direction:column;">
<div class="search_box">
    <form class="header-search-wrap search_field clearfix" action="" method="GET">

        <input id="search-here" class="global-search" name="search" type="text" placeholder="Search here"/>
        <button id="search-listing" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
</div>


<style>
.search_box {
    width: 300px;
    height:40px;
    margin-right: 35px
}

.search_box .search_field {
    width: 100%;
    height: 100%;
    position: relative;
    display: flex;
    background: #fff;
    box-shadow: 0 6px 10px rgba(255, 140, 0, 0.3);
    border-radius: 7px
}

.search_box .search_field .input {
    width: 100%;
    height: 100%;
    border: 0;
    font-size: 16px;
    color: #6f768d;
    background-color: transparent;
    font-style: italic;
    padding: 9px 10px;
    outline: 0
}

.search_box .search_field button {
    background: linear-gradient(111.04deg,#f6790b -.63%,#fb5326 107.47%),linear-gradient(180deg,#12a9e6 -20%,#05668d 101.02%),#fff;
    border-radius: 7px 0 0 7px;
    transform: matrix(-1,0,0,1,0,0);
    width: 55px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    color: #fff;
    right: -3px;
    height: 100%;
    position: absolute;
    z-index: 000;
    cursor: pointer
}

.search_box .search_field button i {
    transform: inherit;
    font-size: 20px !important
}

#search-here {
    width: 100%;
    margin-bottom: 0;
    outline: 0;
    padding-left: 10px;
    font-size: 14px;
    font-style: italic;
    border-radius: 6px;
    border:2px dashed orangered;
}

#search-row{
    margin-top: 20px;
    display: flex; 
    flex-wrap: wrap; 
    justify-content: center; 
    align-items: center; 
    max-width: 100%; margin-top: 20px; 
}


</style>
<?php
if(isset($_GET['search']) && trim($_GET['search']) !== '') {
    $search_query = trim($_GET['search']);
    $db = new PDO('mysql:host=localhost;dbname=rn_8164', 'root', '');
    $stmt = $db->prepare("SELECT * FROM rn_startup WHERE name LIKE :search_query");
    $stmt->execute(array(':search_query' => '%'.$search_query.'%'));
    $searchs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display search results
    if(count($searchs) > 0) {
      echo '<div id="search-row" >';
      foreach($searchs as $search) {
        echo '<div class="search" style="display: flex; align-items: center; margin: 5px; padding: 5px; background-image: linear-gradient(orange, darkorange);border-radius:5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">';
        echo '<a href="startup_details.php?key='.urlencode($search['username']).'" style="flex: 1; display: flex; align-items: center; text-decoration: none; color: black;">';
        echo '<img src="'.$search['image_path'].'" height="50" style="margin-right: 10px;"/>';
        echo '<p style="margin: 0; font-size: 18px; font-weight: bold; color:white;">'.$search['name'].'</p>';
        echo '</a>';
        echo '</div>';
      }
      echo '</div>';
    } else {
      echo '<p>No results found.</p>';
    }
}
?>

<!-- startup grid -->

</section>
<div class="startupgrid">
    <?php if (empty($startups)) { ?>
        <p>No startup registered</p>
    <?php } else {
        $counter = 0;
        foreach ($startups as $startup) {
            if ($counter >= 6) {
                break; // Exit the loop if we have displayed six startups
            }
            ?>
            <div class="startup">
            <?php echo "<img src='" . $startup['image_path'] . "'/>"; ?>
                <h2><?php echo $startup['name']; ?></h2>
                <!-- <p><?php echo $startup['description']; ?></p> -->
                <a href="startup_details.php?key=<?php echo urlencode($startup['username']); ?>">View</a>
            </div>
            <?php
            $counter++;
        }
    } ?>
</div>
<style>
    .view-more {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .view-more button {
        border-radius: 50px;
        width: 200px;
        background: linear-gradient(45deg, coral, orange);
        border: none;
        outline: none;
        color: white;
        font-size: 16px;
        padding: 18px;
        box-shadow: 0 2px 6px rgba(255, 140, 0, 0.5);
        cursor: pointer;
        margin-bottom:30px;
    }

    .view-more button:hover {
      color:black;  
      background: linear-gradient(45deg, darkorange, orange);
    }
</style>

<div class="view-more">
    <button onclick="location.href='startupgrid.php'"><strong>View More</strong></button>
</div>
<style>
		/* body {
			margin: 0;
			padding: 0;
			background-color: #f1f1f1;
		} */
		
        .startupgrid {
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
			grid-gap: 20px;
		}
		
		.startup {
			background-color: white;
			border-radius: 10px;
			padding: 10px;
			text-align: center;
      transition: background-color 0.3s ease-in-out;
      margin:5px;
		}

        .startup:hover {
        background-color: orange;
        }
        .startup:hover img {
          border: 2px solid white;
        }
        .startup:hover a {
        background-color: white;
        border: 3px solid darkorange;
        color:darkorange;
        
        }
		
		.startup img {
			max-width: 100%;
            width: 300px;
			height: 300px;
			margin-bottom: 5px;
		}
		
		.startup h2 {
  font-size: 20px;
  background: linear-gradient(to bottom, #9400D3, #0077b6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
		
		.startup p {
			font-size: 16px;
			line-height: 1.5;
			margin-bottom: 5px;
		}
		
		.startup a {
			background-color: black;
			color: #fff;
			padding: 10px 20px;
			border: none;
            width:120px;
			border-radius: 15px;
			cursor: pointer;
			font-size: 16px;
			text-decoration: none;
			display: inline-block;
			margin-top: 5px;
			transition: all 0.3s ease;        
		}
		
		.startup a:hover {
			background-color: white;
		}
	</style>

<a href="#" class="scroll-to-top"><i class="fas fa-chevron-up"></i></a>

<footer class="section-p1">
    <div class="col">
        <h4>Contact  <img class="logo" src="location.png"  width="45" height="45"  alt="">
</h4>
        <p><strong>Address: </strong> K K Wagh Institute Of Engineering Education & Research </p>
        <p> <strong>Phone: </strong> +01 1255 568 / +91 7588998164</p>
        <p><strong>Hours: </strong> 10:00 - 5:00 , Mon - Sat</p>
        <div class="follow"> 
            <h4> follow us </h4>
            <div class="icon"> 
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-linkedin"></i>
                <i class="fab fa-youtube"></i>
            </div>
        </div>    
    </div>
    <div class="col">
        <h4>Info</h4>
        <a href="about.html"> About Us</a>
        <a href="privacy.html"> Privacy Policy <br> Terms & Condition</a>
        <a href="feedback.html"> Feedback/<br>Contact Us</a>
    </div>
    <div class="col">
        <h4>My Account </h4>
        <a href="login.php" >Sign In</a>
        <a href="#"> My Wishlist</a>
        <a href="#"> Help</a>
        <a><img class="logo" src="makeindia.png"  width="155" height="65"  alt=""></a>
        
    </div>
</footer>
<script src="script.js"></script>
</body>
</html>

<style>
.tagline {
    margin: 0;
    padding: 0;
    color:orange;
    font-size: 80px;
}
.container {
    padding: 100px 50px 50px 50px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    position: relative;
}
.scroll-to-top {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 9999;
  font-size: 18px;
  /* color: #fff; */
  background-color: white;
  border: 2px dashed orange;
  outline: none;
  cursor: pointer;
  padding: 15px;
  border-radius: 50%;
}

.scroll-to-top:hover  {
  background-color: orange;
  box-shadow: 0 2px 6px rgba(255, 165, 0, 0.5);
}

.fa-chevron-up{
  color:orange;
}
.fa-chevron-up:hover {
  color:white;
}

.rupee {
    background-image: url('rupee.png');
    background-size: contain;
    background-repeat: no-repeat;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 80%;
    transform: translate(-50%, -50%);
    cursor: pointer;
    /* animation: spin 2s linear infinite; */
}


.rupee:hover {
    background-image: url('rupee.png');
    background-size: contain;
    background-repeat: no-repeat;
}


@keyframes spin {
    0% {
        transform: translate(-50%, -50%) rotate(0deg);
    }
    100% {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}


body{
  font-family: 'Montserrat', sans-serif;
}
*{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: 'Montserrat', sans-serif;
}

h1{
font-size: 50px;
line-height: 64px;
color: #222;
}

h2{
font-size: 46px;
line-height: 56px;
color: #222;
}

h4{
font-size: 25px;
color: #222;
}

h6{
font-weight: 700;
font-size: 17px;
}

p{
font-size: 16px;
color: #465b52;
margin: 15px 0 20px 0;
}

.section-p1{
padding: 40px,80px;
}

.section-m1{
margin: 40px 0;
}

body{
width: 100%;
}

/*Header Start*/
#header{
display: flex;
align-items: center;
justify-content: space-between;
padding: 0px 80px;
background: #E3E6F3;
box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
z-index: 999;
position: sticky;
top: 0;
left: 0;
}

.header .a{
    top:0;
    left:0;
}

li a{
  border-radius: 50px;
        width: 100px;
        background: linear-gradient(45deg, blue,cyan);
        border: none;
        outline: none;
        color: white;
        font-size: 16px;
        padding: 10px;
        box-shadow: 0 2px 6px rgba(255, 140, 0, 0.3);
        cursor: pointer;
        text-decoration: none;
}

#navbar{
display: flex;
align-items: center;
justify-content: center;
}
#navbar li{
list-style: none;
padding: 0 20px;
position: relative;
}

footer{
display: flex; 
flex-wrap: wrap;
justify-content: space-between;
margin: auto;
background: linear-gradient(45deg, orange, darkorange);
bottom:0;
left:0;
}
footer .col{
display: flex; 
align-items: flex-start;
flex-direction: column;
margin:40px;
}
footer .logo{
margin-bottom: 3px
}
footer h4{
font-family: 14px;
padding-bottom: 20px;
}

footer p{
font-size: 13px;
margin: 0 0 8px 0;
color:black;
}
footer a{
font-size: 15px;
text-decoration: none;
color: black;
margin: 10px;
}
footer .follow{
margin-top: 20px;
}
footer .follow i{
color: black; 
padding-right: 4px;
cursor: pointer;
font-size: 25px;
}
footer .follow i:hover,
footer a:hover{
color: black; 
}

.profile-dropdown {
position: relative;
display: inline-block;
}

.profile-button{
  border-radius: 50px;
        width: 100px;
        background: linear-gradient(45deg, orange, darkorange);
        border: none;
        outline: none;
        color: white;
        font-size: 16px;
        padding: 10px;
        box-shadow: 0 2px 6px rgba(255, 140, 0, 0.3);
        cursor: pointer;
}

.dropdown-content {
  border-radius: 15px;
display: none;
position: absolute;
margin-top: 2px;
top: 100%;
right: 0;
background-color: #f9f9f9;
min-width: 160px;
box-shadow: 0px 8px 16px 0px rgba(255, 200, 0, 0.5);
z-index: 1;
}

.dropdown-content a, .dropdown-content form {
display: block;
padding: 12px 16px;
text-decoration: none;
color: #000;
}

.dropdown-content button{
  background-color: transparent;
  border:none;
}

.dropdown-content a:hover , .dropdown-content form:hover{
  border-radius: 15px;
background-color: orange;
}

.profile-dropdown:hover .dropdown-content {
display: block;
}
</style>
