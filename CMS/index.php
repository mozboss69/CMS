<?php

@include 'config.php';

session_start();

$error = array(); // Initialize the error array

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location: admin-home.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user-home.php');

      }
     
   }else{
      $error[] = 'Incorrect Email or Password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
                <p class="input-title">USC EMAIL ADDRESS</p>
                <input type="email" name="email" required placeholder="Enter USC Email Address" class="input-field">
                <p class="input-title">PASSWORD</p>
                <input type="password" id="password" name="password" required placeholder="Enter Password" class="input-field" >
                <input type="submit" name="submit" value="Login" class=login-button>            
                <a href="forgot-password.php" class="forgot-password">Forgot password?</a>
                <div class="button-separator"></div>
                <!-- Create New Account button -->
                <a href="register-form.php" class="register-button">Create New Account</a>
            </form>
        </div>
        <div class="rounded-container2">
            <h1 class="about-us-header">About Us</h1>
            <p class="cms-description">Introducing the Smart TV Content Management 
                    System (CMS) of University of San Carlos. It's a website 
                    that helps you easily handle what shows up on Smart TVs. You 
                    can do this from your smartphone or computer. Just set up the 
                    browser of your Smart TV and you're good to go. It lets you put 
                    up, plan, and change stuff while also keeping an eye on how 
                    well it's doing. Plus, it's really safe. This tool helps people 
                    linked to the University of San Carlos make cool Smart TV stuff. 
                    Get ready for a whole new way of dealing with content at USC! </p>
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