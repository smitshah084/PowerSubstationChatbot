<?php

// Function to process user input and generate AI response
function process_input($user_input) {
    // Replace this with your actual AI processing logic
    // For simplicity, this example just echoes the user's input with a prefix
    return "AI response to: $user_input";
}

// Initialize an empty array to store the chat messages
$chat = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user_input is set in the POST data
    if (isset($_POST["user_input"])) {
        // Get user input and sanitize it
        $user_input = htmlspecialchars($_POST["user_input"]);

        // Add user input to the chat array
        $chat[] = array("Role" => "Human", "Content" => $user_input);

        // Process user input and add AI response to the chat array
        $ai_response = process_input($user_input);
        $chat[] = array("Role" => "AI", "Content" => $ai_response);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Chat Interface</title>
</head>
<body>

<h1>Chat Interface</h1>

<!-- Display the chat messages -->
<pre>
<?php
foreach ($chat as $message) {
    echo "'''{'Role':'" . $message["Role"] . "','Content':'" . $message["Content"] . "'}'''\n";
}
?>
</pre>

<!-- Form for user input -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="user_input">Your message:</label>
    <input type="text" id="user_input" name="user_input" required>
    <button type="submit">Send</button>
</form>

</body>
</html>
