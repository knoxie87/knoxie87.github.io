<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/w3.css">
    <style>
    header{
        padding: 16px 16px;
        background-image: url('../assets/img/header.jpg');
        background-repeat: repeat;
        background-size: contain;
    }
    .form{
        width: 30%;
    }
</style>
</head>
<body>
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom form">
            <header class="w3-container w3-text-blue-grey w3-border-bottom">
            <h3>
                Register
                <?php
                if(isset($_SESSION["error_message"])){
                echo "<span style='color:red;font-size:1rem'>".$_SESSION["error_message"]."</span>";
                }
                else {
                echo "<span style='display:none'></span>";
                }
                ?>
            </h3>
    </header>
    <form class="w3-container" action="/register" method="post">
        <div class="w3-section">
            <label><b>Username</b></label>
            <input class="w3-input w3-border w3-margin-bottom" placeholder="Enter Username"  type="text" name="username" required>
            <label><b>Password</b></label>
            <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" required>
            <button class="w3-button w3-block w3-teal w3-section w3-padding">Register User </button>
        </div>
    </form>
    </div>
</div>
<script>
    document.getElementById('id01').style.display = 'block'
</script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
</body>
</html>