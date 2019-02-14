<?php
include('connection.php');

$user_id = $_SESSION['user_id'];


if($_POST['change_mail'] != '' ) {
    $change_mail_val = $_POST['change_mail'];
    $change_mail = "UPDATE  `users` SET `email` = '$change_mail_val' WHERE `id` = '$user_id' ";
    $change_mail_query = mysqli_query($conn, $change_mail);
    header('location:home.php');
    die;
}else {
    header('location:home.php');
    die;
}
