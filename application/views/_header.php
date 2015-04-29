<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Hacking Health Group 28</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <style>
        body {
            padding:10px;
        }

        ul {
            list-style-type: none;
        }

        #error {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

<!-- Header and Nav -->

<div>
    <h1>HackingHealth</h1>
    <ul>
        <li><a href="main.php">Home</a></li>
        <li><a href="main.php?c=member">Members</a></li>
        <li><a href="main.php?c=login<?php if (isset($_SESSION['username'])){echo "&m=logout";}  ?>">
                <?php echo (isset($_SESSION['username'])? 'Logout': 'Login'); ?>
        </a></li>
    </ul>
</div>

<!-- End Header and Nav -->
