<?php
@include 'config.php';

if (isset($_POST['confirm_logout'])) {
    if ($_POST['confirm_logout'] === '1') {
        // User confirmed the logout, so log them out and redirect to the login page.
        session_start();
        session_unset();
        session_destroy();
        header('location: index.php');
        exit();
    } else {
        // User canceled the logout, stay on user-home.php.
        header('location: user-home.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
        .modal-overlay {
            display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        z-index: 9999;
        }

        .popup-confirm {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border: 1px solid #ccc;
            z-index: 1000;
            text-align: center;
        }

        .popup-confirm p {
            margin: 0;
        }
    </style>
</head>
<body>
    <script type="text/javascript">
        // Define a function to show the confirmation dialog.
        function confirmLogout() {
            var result = confirm("Are you sure you want to logout?");
            if (result) {
                // If the user clicks "Yes," submit a form with 'confirm_logout' set to '1'.
                var form = document.createElement('form');
                form.method = 'post';
                form.action = 'logout.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'confirm_logout';
                input.value = '1';
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            } else {
                // If the user clicks "No," submit a form with 'confirm_logout' set to '0'.
                var form = document.createElement('form');
                form.method = 'post';
                form.action = 'logout.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'confirm_logout';
                input.value = '0';
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
        // Call the confirmation function when the page loads.
        confirmLogout();
    </script>
</body>
</html>
