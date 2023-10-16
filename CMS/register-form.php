<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['confirmpassword']);
   $user_type = $_POST['user_type'];

   // Regular expression pattern to allow only letters and spaces in the name
   $namePattern = '/^[A-Za-z\s]+$/';

   if (!preg_match($namePattern, $name)) {
       $error[] = 'Name can only contain letters and spaces!';
   } else {
       $select = "SELECT * FROM user_form WHERE email = '$email'";
       $result = mysqli_query($conn, $select);

       if(mysqli_num_rows($result) > 0){
            $error[] = 'User already exists with this email address!'; // Display error message for duplicate email
       } else {
          if($pass != $cpass){
            $error[] = 'Passwords do not match!';
          } else {
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location: index.php');
          }
       }
   }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Account Form</title>
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
    <div class="rounded-container">
        <form action="" method="post">
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
            <p class="input-title">FULL NAME</p>
            <input type="text" name="name" required placeholder="Enter Full Name" class="input-field">
            <p class="input-title">USC EMAIL ADDRESS</p>
            <input type="email" name="email" required placeholder="Enter USC Email Address" class="input-field">
            <p class="input-title">PASSWORD</p>
            <input type="password" name="password" required placeholder="Enter Password" class="input-field">
            <p class="input-title">CONFIRM PASSWORD</p>
            <input type="password" name="confirmpassword" required placeholder="Enter Confirmed Password" class="input-field" >
            <input type="hidden" name="user_type" value="user">
            <div class="button-separator"></div>
            <input type="submit" name="submit" value="Create New Account" class="login-button">
            <a href="index.php" class="cancel-button">Cancel</a>
        </form>
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