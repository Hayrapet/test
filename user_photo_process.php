<?php
include('connection.php');
include('simpleImage.php');
$user_id = $_SESSION['user_id'];
$select_photo_sql = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `user_photo` FROM `users` WHERE `id` = '$user_id'"));

if(isset($_POST['delete']) &&  $select_photo_sql['user_photo'] != '' ) {
    $delete_photo_sql = mysqli_query($conn , "UPDATE `users` SET `user_photo`='' WHERE `id` = '$user_id'");
    unlink("img/user_photo/$user_id.jpg");
}

if ($_FILES['photo_file']['size'] > 0 && isset($_POST['save'])) {
    $image = new SimpleImage();
    $image->load($_FILES['photo_file']['tmp_name']);
    $image->crop(400, 400);
    $image->save('img/user_photo/' . $user_id . '.jpg');
    $user_photo_sql = mysqli_query($conn, "UPDATE `users` SET `user_photo`='$user_id.jpg' WHERE `id` = '$user_id'");
    header('location:home.php');
}else{
    header('location:home.php');
}