
<?php
 //Database connection
 $servername = "localhost";
 $username = "root"; // Replace with your MySQL username
 $password = ""; // Replace with your MySQL password
 $dbname = "yoga_website"; // The name of your database
 
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
// Fetch all songs from the database
$songs = $conn->query("SELECT * FROM songs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Songs</title>
</head>
<body>
    <h1>Song List</h1>
    <div class="playlist-container">
        <?php while($song = $songs->fetch_assoc()): ?>
            <div class="song-container">
                <h3><?php echo $song['title']; ?></h3>
                <audio controls>
                    <source src="<?php echo $song['file_path']; ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
