<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500&display=swap" rel="stylesheet">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="navbar">
    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
            <!--Icon source: https://icons.getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
            </a>
        <a href="user_homepage.php">Home</a>
        <a href="announcements.php">Announcements</a>
        <a href="events.php">Events</a>
        <a href="user_profile.php">Profile</a>
        <a href="layouts.php">Layouts</a>
        <a href="about-us.php">About Us</a>
        <a href="logout.php" style="color: rgb(239, 59, 59)">Logout</a>
    </div>
      
    <button class="openbtn" onclick="openNav()">
        <!--Icon source: https://icons.getbootstrap.com/-->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-sidebar" viewBox="0 0 16 16">
            <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H5zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2V2z"/>
        </svg>
        </button>  
        <p class="navbar-headers">HOME</p>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "260px";
        }
      
        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
         
</body>
</html>
