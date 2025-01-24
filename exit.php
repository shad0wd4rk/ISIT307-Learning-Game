<?php
session_start();
//Get user's nickname
$nickname = $_POST['nickname'];
$overall_points = $_SESSION['overall_points'];

//Save score to file
file_put_contents('scores.txt', "$nickname|$overall_pointsn", FILE_APPEND);

echo "<h1>Game Over!</h1>";
echo "<p>$nickname, your overall score is $overall_points!</p>";
echo "<a href= 'homepage.html'>Start a new game</a>";

?>