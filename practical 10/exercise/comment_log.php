<!DOCTYPE html>
<?php
session_start();
$commentLog = 'log_entries.txt';
$key = "my-secret-key";
$errors = array();
$status = "";

// Add function for data encryption
function encryptData($data, $key) {
    $method = 'aes-256-cbc';
    $ivLength = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $paddedData = $data . str_repeat("\0", 16 - (strlen($data) % 16));
    $encrypted = openssl_encrypt($paddedData, $method, $key, OPENSSL_RAW_DATA, $iv);
    $encryptedWithIV = $iv . $encrypted;
    return base64_encode($encryptedWithIV);
}

// Add function for data decryption
function decryptData($encryptedData, $key) {
    $method = 'aes-256-cbc';
    $encryptedData = base64_decode($encryptedData);
    $ivLength = openssl_cipher_iv_length($method);
    $iv = substr($encryptedData, 0, $ivLength);
    $encrypted = substr($encryptedData, $ivLength);
    $decrypted = openssl_decrypt($encrypted, $method, $key, OPENSSL_RAW_DATA, $iv);
    return rtrim($decrypted, "\0"); // Remove padding
}

// Handle form submission and data encryption
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = trim($_POST['message']);
    if (empty($message)) {
        $errors['message'] = "Message is required.";
    } elseif (strlen($message) > 255) {
        $errors['message'] = "Message must be less than 255 characters.";
    }
    if (empty($errors)) {
        $encryptedMessage = encryptData($message, $key);
        if (file_put_contents($commentLog, $encryptedMessage . PHP_EOL, FILE_APPEND) === false) {
            $errors['file'] = "Failed to save the message. Please try again.";
        } else {
            $status = "Message submitted successfully!";
        }
    }
}

// Read and decrypt messages from the log file
$decryptedMessages = array();
if (file_exists($commentLog)) {
    $logEntries = file($commentLog, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($logEntries as $entry) {
        $decryptedMessages[] = decryptData($entry, $key);
    }
}
?>
<html>
<head>
 <meta charset="utf-8">
 <title>Encrypted Comment Log</title>
 <style>
   #messages {
       display: none; /* Initially hide the messages */
   }
 </style>
 <script>
   function toggleMessages() {
       var messages = document.getElementById('messages');
       if (messages.style.display === 'none') {
           messages.style.display = 'block';
       } else {
           messages.style.display = 'none';
       }
   }
 </script>
</head>
<body>
 <h1>Encrypted Comment Log</h1>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 <textarea name="message" placeholder="Leave a comment here..." required></textarea><br>
 <?php if (!empty($errors['message'])) : ?>
 <p style="color: red;"><?php echo $errors['message']; ?></p>
 <?php endif; ?>
 <?php if (!empty($status)) : ?>
 <p style="color: green;"><?php echo $status; ?></p>
 <?php endif; ?>
 <input type="submit" value="Submit">
 </form>

 <?php if (!empty($errors['file'])) : ?>
 <p style="color: red;"><?php echo $errors['file']; ?></p>
 <?php endif; ?>

 <button type="button" onclick="toggleMessages()">Show/Hide Previous Messages</button>

 <div id="messages">
     <h2>Previous Messages:</h2>
     <?php if (!empty($decryptedMessages)) : ?>
         <ul>
         <?php foreach ($decryptedMessages as $message) : ?>
             <li><?php echo htmlspecialchars($message); ?></li>
         <?php endforeach; ?>
         </ul>
     <?php else : ?>
         <p>No messages to display.</p>
     <?php endif; ?>
 </div>
</body>
</html>
