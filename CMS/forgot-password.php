<?php

// Include your database connection configuration
@include 'config.php';

// Initialize the error array
$error = array();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists in the database
    $select = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        // Generate a unique token for password reset
        $resetToken = bin2hex(random_bytes(32));

        // Update the user's record with the reset token
        $updateToken = "UPDATE user_form SET reset_token = '$resetToken' WHERE email = '$email'";
        mysqli_query($conn, $updateToken);

        // Send a password reset email to the user with a link that includes the reset token
        $resetLink = "http://yourwebsite.com/reset-password.php?token=$resetToken";
        // You should implement a function to send an email with the reset link

        // Redirect to a success page or display a success message
        header('location: reset-success.php');
    } else {
        $error[] = 'Error: Email address not found in our records.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500&display=swap" rel="stylesheet">  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <div class="rounded-container">
            <form action="" method="post">
                <img src="images/cms_new_logo1.png" class="cms-logo">
                <?php
                if(isset($error) && !empty($error)){
                    echo '<div class="modal-overlay"></div>'; // Add the modal overlay
                    echo '<div class="popup-error">';
                    echo '<span class="close-button" onclick="closePopupError()">';
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">';
                    echo '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>';
                    echo '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>';
                    echo '</svg>';
                    echo '</span>';
                    foreach($error as $errorMsg){
                        echo '<p>'.$errorMsg.'</p>';
                    };
                    echo '</div>';
                };
                ?>
                <p class="input-title">SEARCH FOR USC EMAIL ADDRESS</p>
                <input type="email" name="email" required placeholder="Enter a Valid USC Email Address" class="input-field">
                <div class="button-separator"></div>
                <a href="#" class="register-button">Search USC Email Address</a>
                <a href="index.php" class="cancel-button">Cancel</a>
            </form>
        </div>
    </div>
    
    <script>
        // JavaScript to show the popup error message and modal overlay
        document.addEventListener("DOMContentLoaded", function() {
            <?php if(isset($error) && !empty($error)) { ?>
                const modalOverlay = document.querySelector(".modal-overlay");
                const popupError = document.querySelector(".popup-error");

                modalOverlay.style.display = "block";
                popupError.style.display = "block";
            <?php } ?>
        });

        // JavaScript to close the popup error message and modal overlay
        function closePopupError() {
            const modalOverlay = document.querySelector(".modal-overlay");
            const popupError = document.querySelector(".popup-error");

            modalOverlay.style.display = "none";
            popupError.style.display = "none";
        }
    </script>
</body>
</html>