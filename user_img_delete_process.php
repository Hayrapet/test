<?php
include('connection.php');
$user_id = $_SESSION['user_id'];
$user_img_name = $_POST['user_img_name'];



$delete_img = mysqli_query($conn , "DELETE FROM `images` WHERE `img` = '$user_img_name'") ;
unlink("img/user_img/$user_img_name");


$sql_img = mysqli_query($conn, "SELECT * FROM `images`  WHERE `id_user` = '$user_id' ORDER BY `id` DESC");

while($row_img = mysqli_fetch_assoc($sql_img)) {

    $user_img = $row_img['img'];

    echo "<div class='images_user'>";
    echo "<div class='delete_img_user'>";
    echo "<form  method='post'>";
    echo "<div class='img_delete'>x</div>";
    echo "<input type='hidden' name='user_img_name' value='$user_img' >";
    echo "</form>";
    echo "</div>";
    echo "<div class='img_user'>";
    echo "<img src='img/user_img/$user_img' >";
    echo "</div>";
    echo "<div class='date_img_user'>" . $row_img['img_date'];
    echo "</div>";
    echo "</div>";




}



