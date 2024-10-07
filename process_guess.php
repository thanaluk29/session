<?php
session_start();

// Initialize session variables if not already set
if (!isset($_SESSION['target_number'])) {
    $_SESSION['target_number'] = rand(1, 100); // Set a random number between 1 and 100
    $_SESSION['guesses'] = 0; // Initialize the number of guesses
}

// Assign session variables to local variables for better readability
$target_number = $_SESSION['target_number'];
$guesses = $_SESSION['guesses'];

if (isset($_POST['submit']))  {
    $guess = isset($_POST['guess']) ? (int)$_POST['guess'] : null;
    $guesses++;

    if ($guess === $target_number) {
        $message = "Congratulations! $target_number is correct. You guessed the number in $guesses guesses.";
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
    } elseif ($guess < $target_number) {
        $message = "Too low! Try again. You already guessed $guesses times.";
    } else {
        $message = "Too high! Try again. You already guessed $guesses times.";
    }

    // Update the session with the new number of guesses
    $_SESSION['guesses'] = $guesses;
}

if (isset($_POST['giveup']))  {
    $message = "The correct number is $target_number.";
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
}


// Return the message to be displayed
if (isset($message)) {
    echo $message;
}
?>
