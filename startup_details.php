<?php
    // Database connection
    // $dbhost = "localhost";
    // $dbname = "rn_8164";
    // $dbusername = "root";
    // $dbpassword = "";

	$dbhost = "sql.freedb.tech";
    $dbname = "freedb_rn_8164";
    $dbusername = "freedb_mail6164";
    $dbpassword = "5UM@AgWaVb*JCn$";

	$conn = mysqli_connect($dbhost, $dbusername,$dbpassword, $dbname);
	$key = $_GET['key'];
	// get the startup name from the previous page
	
	// fetch startup details from the database
	$sql = "SELECT * FROM rn_startup WHERE username='$key'";
	$result = mysqli_query($conn, $sql);
	$rn_startup = mysqli_fetch_assoc($result);
	$sql1 = "SELECT * FROM rn_raise WHERE username='$key'";
	$result1 = mysqli_query($conn, $sql1);
	$rn_raise = mysqli_fetch_assoc($result1);
	
	// extract the startup details
	$image = $rn_startup['image_path'];
	// $description = $startup['description'];
	$name = $rn_startup['name'];
	$valuation = $rn_raise['valuation'] ;
	$pitch_ask = $rn_raise['equity'];
	$service_details = $rn_raise['description'];
?>


<!DOCTYPE html>
<html>
<head>
	<title>Startup Details</title>
	<style type="text/css">body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
		}
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
			display: flex;
			flex-wrap: wrap;
		  }
		  
		  .container {
			justify-content: space-between;
			top: 0;
			left: 0;
			background-color: #fff;
			box-shadow: 0px 0px 10px #aaa;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0px 0px 10px #aaa;
			max-width: calc(50% - 20px);
			flex: 1;
			padding-right: 5mm;
		  }
		  
		  
		  .img-container {
			text-align: center;
			margin-bottom: 20px;
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
		  
		  button {
			background-color: #0077b6;
			color: #fff;
			padding: 10px 20px;
			font-size: 18px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		  }
		  
		  button:hover {
			background-color: #005073;
		  }
		  
		  .right-block {
			width: 50%;
			flex-basis: calc(50% - 20px);
			padding: 20px;
			background-color: #fff;
			box-shadow: 0px 0px 10px #aaa;
			
			display: flex;
			justify-content: center;
			align-items: center;
		  }


	</style>

	<!-- Tawk.to JavaScript code -->
 <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/645f277b74285f0ec46b34d0/1h0ngmpml';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    <style>
        #tawkchat-minified-wrapper {
            bottom: 20px;
            right: 20px;
            width: 80px;
            height: 80px;
            background-color: #000;
            color: black;
        }
    </style>
</head>
<body>        
    <div class="container">
		<div class="img-container">
        <?php echo '<img src="'.$image.'"/>';?>
		</div>
		<div class="details">
			<div class="startup">
				<div class="col">
					<h2>Startup Name</h2>
					<p><?php echo $rn_startup['name']; ?></p>
				</div>
				<div class="col">
					<h2>Pitch/Ask</h2>
					<p><?php echo "$pitch_ask %"; ?></p>
				</div>
				<div class="col">
					<h2>Valuation</h2>
					<p><?php echo "$valuation"; ?>lakh</p>
				</div>
			</div>
			<div class="startup">
				<div class="col">
					<h2 style="font-size:24px; margin-top:5px;"><strong>DETAILS</strong></h2>
					<h2><?php echo $service_details; ?></h2>
				</div>
			</div>
		</div>
	</div>
    <div class="right-block">
	<embed src="<?php echo $rn_startup['file_path']; ?>" type="<?php echo $rn_startup['file_type']; ?>" width="100%" height="100%">
    </div>
</body>
</html>