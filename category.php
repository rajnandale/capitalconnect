<?php
    // Database connection
    $dbhost = "localhost";
    $dbname = "rn_8164";
    $dbusername = "root";
    $dbpassword = "";
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
    $category = $_GET['category'];

    // Fetch startups from the database based on category
    $stmt = $db->prepare("SELECT * FROM rn_startup WHERE category = :category");
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    $startups = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
<header>
<h1><?php echo $category; ?></h1>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <!-- <li><a href="#">Favourite</a></li> -->
    </ul>
  </nav>
</header>
</head>

    <!-- Display fetched startups from the database -->
    <?php foreach ($startups as $startup) { ?>
      <?php 
      $conn = mysqli_connect($dbhost, $dbusername,$dbpassword, $dbname);
$sql1 = "SELECT * FROM rn_raise WHERE username='" . $startup['username'] . "'";
	    $result1 = mysqli_query($conn, $sql1);
	    $rn_raise = mysqli_fetch_assoc($result1);
      $valuation = $rn_raise['valuation'] ;
	    $pitch_ask = $rn_raise['equity'];?>
      <a href="startup_details.php?key=<?php echo urlencode($startup['username']); ?>">
		
        <div class="container">
		<div class="img-container">
        <?php echo '<img src="'.$startup['image_path'].'"/>';?>
		</div>
		<div class="details">
			<div class="startup">
				<div class="col">
					<h2>Startup Name</h2>
					<p><?php echo $startup['name']; ?></p>
				</div>
				<div class="col">
					<h2>Pitch/Ask</h2>
					<p><?php echo "$pitch_ask %"; ?></p>
				</div>
				<div class="col">
					<h2>Valuation</h2>
					<p><?php echo "$valuation"; ?> lakh</p>
				</div>
			</div>
			<div class="startup">
				<div class="col">
        <h2 style="font-size:24px; margin-top:5px;"><strong>DETAILS</strong></h2>
					<h2><?php echo $rn_raise['description']; ?></h2>
				</div>
			</div>
		</div>
	</div>
    </a>
        <?php } ?>
</div>
<style>

    header {
  background-color: #fff;
  padding: 30px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
h1 {
  margin: 0 auto;
  font-size: 30px;
  text-align: center;
}

.logo {
  font-size: 24px;
  font-weight: bold;
  color: #0077b6;
  float: left;
}

a{
   text-decoration: none;
}

nav {
    top:0;
  float: right;
  display: flex;
align-items: center;
justify-content: center;
}

nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

nav ul li {
  display: inline-block;
  margin-left: 20px;
}

nav ul li a {
  color: #333;
  text-decoration: none;
  font-size: 18px;
  padding: 10px 0;
  border-bottom: 3px solid transparent;
  transition: border-bottom 0.3s ease;
}

nav ul li a:hover {
  border-bottom: 3px solid #0077b6;
}


    .container {
        max-width:80%;
  margin: 0 auto;
  background-color: #fff;
  padding: 20px;
  box-shadow: 0px 0px 10px #aaa;
  flex: 1;
  padding-right: 5mm;
  display: flex;
  flex-direction: row;
  margin-top: 1cm;
  margin-left: 3cm;
  margin-right: 3cm;
  
}

.img-container {
  text-align: center;
  margin-bottom: 20px;
  flex: 1; /* new */
}

img {
  max-width: 100%;
  width: 300px;
  height: 300px;
  border: 1px solid #ddd;
  padding: 10px;
  background-color: #fff;
  box-shadow: 0px 0px 10px #aaa;
}

.details {
  margin-bottom: 20px;
  background-color: #fff;
  box-shadow: 0px 0px 10px #aaa;
  padding: 20px;
  flex: 1; /* new */
}

h2 {
  font-size: 16px;
  background: linear-gradient(to bottom, #9400D3, #0077b6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

		  
		  p {
            font-weight: bold; 
			background: linear-gradient(45deg, #FFA500, #FF4500); 
			-webkit-background-clip: text; 
			-webkit-text-fill-color: transparent;
			font-size:33px;
        }

		  
		  .startup {
			display: flex;
			flex-wrap: wrap;
			margin: 0 -10px;
      
		  }
		  
		  .col {
			flex: 1;
			padding: 0 10px;
			margin-bottom: 20px;
		  }
		  
		  .col.graph {
			flex: 2;
		  }
		  
		  canvas {
			top: 0;
			left: 0;
			max-width: 400px;
			display: block;
		  }
		  
</style>