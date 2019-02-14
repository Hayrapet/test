<?php
include('connection.php');
include('simpleImage.php');

$user_id = $_SESSION['user_id'];
$user = "SELECT  * FROM `users` WHERE `id` = '$user_id ' ";
$sql = mysqli_query($conn, $user);
$row = mysqli_fetch_assoc($sql);

$title = trim(htmlspecialchars($_POST['title']));
$img = '';
$content = trim(htmlspecialchars($_POST['content']));
$user_name = $row['firstname'];

if($title == '' || $content == '' ) {
header('location:home.php?page=posts&result=0');
die;
}


    $post = "INSERT INTO `posts`(`user_name`, `title`, `img` , `content` , `user_id`) VALUES ('$user_name ','$title','$img','$content','$user_id')";
    $post_sql = mysqli_query($conn, $post);
    $id = mysqli_insert_id($conn);
 if ($_FILES['post_img']['size'] > 0) {
        $img = $id . '.jpg';
        $image = new SimpleImage();
        $image->load($_FILES['post_img']['tmp_name']);
        $image->save('img/post_img/' . $img . '');
        mysqli_query($conn, "UPDATE `posts` SET `img`='$img' WHERE `id`='$id'");

    }



if($post_sql){
    header('location:home.php?page=posts');
}else{
    header('location:login.php');
}