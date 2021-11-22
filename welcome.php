<?php

include 'config.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Welcome</title>
    <style>
    a.sign_up {
        position: absolute;
        top: 30px;
        right: 90px;
        font-size:20px;
        border-radius:0.12em;
        box-sizing: border-box;
        font-family:fantasy;
        font-weight: bold;
        font-weight: 400;
        padding:0.35em 1.2em;
        color:#FFFFFF;
        transition: all 0.2s;
        text-decoration:none;

    }
    a.sign_up:hover{
        color:#000000;
        background-color:#FFFFFF;
    }

    a.direct{
        position: absolute;
        top:100px;
        right:20px;
        font-size:30px;
        border-radius:0.12em;
        box-sizing: border-box;
        font-family:fantasy;
        font-weight: bold;
        font-weight: 400;
        padding:0.35em 1.2em;
        color:#ffffff;
        transition: all 0.2s;
        text-decoration:none;
    }
    a.direct:hover{
        color:#FFFFFF;
        background-color:#000000;
    }
    .container{
        position:fixed;
        bottom: 100px;
        right:40px;
        width: 400px;
        min-height: 400px;
        background: #FFF;
        border-radius: 2px;
        box-shadow: 0 0 5px rgba(0,0,0,.3);
        padding: 40px 30px;
        padding-bottom: 25px;
        border: 1px solid black;
        background-color: grey;
        opacity: 0.8;
    }

    .container p {
      margin: 5%;
      font-weight: bold;
      color: #000000;
    }

    body{
    background:url('portrait.jpg');
    background-repeat: no-repeat;
    background-color:black;
    }


    </style>

</head>
<body>

    <?php echo "<a class = 'sign_up' href='logout.php'> Logout " . $_SESSION['username'] . "</a>"; ?>
    <div class='container'>
    <a class = 'direct' href = 'add.php'>Have some data? </a>
    <a class = 'direct' style='top:160px' href = 'search1.php'>Looking for some data? </a>
    </div>


</body>
</html>
