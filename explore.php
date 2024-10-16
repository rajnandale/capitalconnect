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
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

    // Fetch startups from the database
    $stmt = $db->prepare("SELECT * FROM rn_category");
    $stmt->execute();
    $startups = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Names Display</title>
    <style>
        body {
            display: flex;
            font-family: 'Montserrat', sans-serif;
        }

        .names-container {
            position: relative;
            flex: 1;
            padding: 10px;
            overflow: hidden;
        }

        .names-container a {
            position: absolute;
            margin: 10px;
            text-decoration: none;
            color:orange;
            font-weight: bold;
            background-image: linear-gradient(135deg, #FF8C00, #FF4500); /* Set gradient color */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .startuplist-container {
    width: 380px; 
    height: 690px; /* Adjust the height as needed */
    overflow: auto;
    padding-left: 380px;
}

.startuplist {
    background: linear-gradient(135deg, #FF8C00 0%, #FF4500 100%);
    display: flex;
    flex-direction: column; /* Change flex-direction to column */
    padding: 20px;
}

.startup {
    width: 300px;
    height: 20px;
    background-color: rgba(255, 165, 0, 0.5);
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
    
}

.startup h2 {
    margin-top:0;
    color: #FFF;
    font-size: 18px;
    /* margin-bottom: 10px; */
}

.startup a {
    color: #FFF;
    text-decoration: none;
}

.startup a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="names-container">
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
$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

// Fetch names and usernames from the database
$stmt = $db->prepare("SELECT name, username FROM rn_startup");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Shuffle the results randomly
shuffle($results);

// Calculate available space on the screen
$screenWidth = 1000; // Width of the screen
$screenHeight = 600; // Height of the screen
$margin = 10; // Margin between name elements

// Display the names on the screen until no space is left
$counter = 0;
$names = [];

foreach ($results as $result) {
    $name = $result['name'];
    $username = $result['username'];

    // Encode the username
    $encodedUsername = urlencode($username);

    // Generate a random font size between 12 and 80
    $fontSize = mt_rand(24, 80);

    // Calculate the width and height based on the font size
    $nameWidth = strlen($name) * ($fontSize / 2);
    $nameHeight = $fontSize;

    $collision = true;
    $attempts = 0;
    $maxAttempts = 1000;

    while ($collision && $attempts < $maxAttempts) {
        // Calculate the position of each name element
        $left = mt_rand(0, $screenWidth - $nameWidth);
        $top = mt_rand(0, $screenHeight - $nameHeight);

        $collision = false;
        foreach ($names as $existingName) {
            $existingLeft = $existingName['left'];
            $existingTop = $existingName['top'];
            $existingWidth = $existingName['width'];
            $existingHeight = $existingName['height'];

            // Check for collision with existing names
            if (
                $left < $existingLeft + $existingWidth + $margin &&
                $left + $nameWidth + $margin > $existingLeft &&
                $top < $existingTop + $existingHeight + $margin &&
                $top + $nameHeight + $margin > $existingTop
            ) {
                $collision = true;
                break;
            }
        }

        $attempts++;
    }

    if (!$collision) {
        // Display the name as a link with the encoded username, random font size, and position
        echo '<a href="startup_details.php?key=' . $encodedUsername . '" style="position: absolute; left: ' . $left . 'px; top: ' . $top . 'px; font-size: ' . $fontSize . 'px;">' . $name . '</a>';

        // Store the name details for collision detection
        $names[] = [
            'left' => $left,
            'top' => $top,
            'width' => $nameWidth,
            'height' => $nameHeight
        ];

        $counter++;

        // Break if the counter exceeds the available space
        if (($nameWidth + $margin) * $counter >= $screenWidth * $screenHeight) {
            break;
        }
    }
}

// If there are no sufficient names to occupy the whole screen, display hash symbols
if ($counter === 0) {
    $hashWidth = 50;
    $hashHeight = 20;
    $hashFontSize = 16;

    for ($i = 0; $i < $screenWidth * $screenHeight / ($hashWidth + $margin); $i++) {
        $left = ($i % ($screenWidth / ($hashWidth + $margin))) * ($hashWidth + $margin);
        $top = floor($i / ($screenWidth / ($hashWidth + $margin))) * ($hashHeight + $margin);

        echo '<span style="position: absolute; left: ' . $left . 'px; top: ' . $top . 'px; width: ' . $hashWidth . 'px; height: ' . $hashHeight . 'px; font-size: ' . $hashFontSize . 'px;">#</span>';
    }
}
?>
    </div>
    <div class="startuplist-container">
    <div class="startuplist">
        <?php foreach ($startups as $startup) { ?>
            <div class="startup">
                <h2><a href="category.php?category=<?php echo urlencode($startup['category']); ?>">
                <?php echo $startup['category']; ?></a></h2>
            </div>
        <?php } ?>
    </div>
</div>
</body>