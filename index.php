<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tic-Tac-Toe Game</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<table style="width:5%">
    <tr>
        <th><input type="text" name="11"></th>
        <th><input type="text" name="12"></th>
        <th><input type="text" name="13"></th>
    </tr>
    <tr>
        <th><input type="text" name="21"></th>
        <th><input type="text" name="22"></th>
        <th><input type="text" name="23"></th>
    </tr>
    <tr>
        <th><input type="text" name="31"></th>
        <th><input type="text" name="32"></th>
        <th><input type="text" name="33"></th>
    </tr>

</table>

<?php
session_start();

if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}
?>

<script src='js/main.js'></script>
</body>
</html>
