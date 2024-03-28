<?php
// Validate user input and sanitize the PHP code
if(isset($_POST['code'])) {
    $userCode = $_POST['code'];
    // Sanitize the input to prevent code injection
    $userCode = htmlspecialchars($userCode);

    // Save the code to a temporary file
    $tempFile = tempnam(sys_get_temp_dir(), 'php_compiler');
    file_put_contents($tempFile, $userCode);

    // Execute the PHP code using shell execution
    $output = '';
    $error = '';
    // Limit execution time to 5 seconds and memory usage to 10MB
    set_time_limit(5);
    ini_set('memory_limit', '10M');
    exec("php -d display_errors=on $tempFile 2>&1", $output, $returnCode);
    if ($returnCode !== 0) {
        $error = "Error occurred while executing the code.";
    }

    // Output the result or error message
    if(empty($error)) {
        echo "<pre>" . htmlspecialchars(implode("\n", $output)) . "</pre>";
    } else {
        echo "<pre>$error</pre>";
    }

    // Clean up the temporary file
    unlink($tempFile);
}
?>