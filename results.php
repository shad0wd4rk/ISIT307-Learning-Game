<?php
session_start();

//Get user's nickname
$nickname = $_POST['nickname'];


//Retrieve the selected questions and answers from the session
$selected_questions = $_SESSION['selected_questions'];
$questions = $_SESSION['questions'];
$topic = $_SESSION['topic'];

//Initialize Counters
$correct = 0;
$incorrect = 0;

//Check the user's answers
foreach ($selected_questions as $index) {
    $user_answer = $_POST["q$index"] ?? null; // Get the user's answer
    list($question, $correct_answer) = explode('|', $questions[$index]);

    if ($topic == 'science') {
        // For true/false questions
        if ($user_answer == $correct_answer) {
            $correct++;
        } else {
            $incorrect++;
        }
    } else {
        // For math questions
        if ($user_answer == $correct_answer) {
            $correct++;
        } else {
            $incorrect++;
        }
    }
}

//Calculate the total score for the quiz
$quiz_score = ($correct * 3) - ($incorrect * 2);

//Update the user's overall points
$_SESSION['overall_points'] += $quiz_score;

//Save the user's overall score into score.txt
$scores_file = 'scores.txt';
$score_entry = "$nickname|" . $_SESSION['overall_points'] . "\n";

//Append the score to the file
file_put_contents($scores_file, $score_entry, FILE_APPEND);

//Display the Results
echo "<h1>Quiz Results</h1>";
echo "<p>Correct Answers: $correct</p>";
echo "<p>Incorrect Answers: $incorrect</p>";
echo "<p>Quiz Score: $quiz_score</p>";
echo "<p>Overall Points:" . $_SESSION['overall_points'] . "</p>";

//Providing options to continue
echo "<a href='quizes.php?topic=science'>New Science Quiz</a><br>";
echo "<a href='quizes.php?topic=numbers'>New Numbers Quiz</a><br>";
echo "<a href='leaderboard.php'>View Leaderboard</a><br>";
echo "<a href='exit.php'>Exit</a>";

?>