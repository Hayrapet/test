<?php
include('connection.php');
$user_id = $_SESSION['user_id'];
$id_post = $_POST['id_post'];

$post = "SELECT  * FROM `posts` WHERE `user_id` = '$user_id' AND `id` = '$id_post' ";
$sql_post = mysqli_fetch_assoc(mysqli_query($conn, $post));


$delete_post = mysqli_query($conn,"DELETE FROM `posts` WHERE `user_id` = '$user_id' AND `id` = '$id_post' " );

if($sql_post['img'] != ""){
    unlink("img/post_img/$id_post.jpg");
}

if($delete_post){
    header('location:home.php?page=posts&result=1');
}else {
    header('location:home.php?page=posts&result=0');
}