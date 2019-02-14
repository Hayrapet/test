<?php
include('connection.php');
include('simpleImage.php');
$user_id = $_SESSION['user_id'];


$img = '';
$counter = count($_FILES['file']['name']);

    for ($i = 0; $i < $counter; $i++) {
        $insert_img_sql = mysqli_query($conn, "INSERT INTO `images`(`img`, `id_user`) VALUES ('$img' , '$user_id')");
        $id = mysqli_insert_id($conn);
        $fileName = $user_id . '_' . $id . '.jpg';
        $tmp = $_FILES['file']['tmp_name'][$i];
        $dir = 'img/user_img/' . $fileName;
        $image = new SimpleImage();
        $image->load($tmp);
        $image->crop(500, 300);
        $image->save('img/user_img/' . $fileName);
        $user_img_sql = mysqli_query($conn, "UPDATE `images` SET `img`='$fileName' WHERE  `id` =  '$id' ");

    }


$sql_img = mysqli_query($conn, "SELECT * FROM `images`  WHERE `id_user` = '$user_id' ORDER BY `id` DESC");

while($row_img = mysqli_fetch_assoc($sql_img)) {

    $user_img = $row_img['img'];

    echo "<div class='images_user'>";
    echo "<div class='delete_img_user'>";
    echo "<form  method='post'>";
    echo "<button type='submit' class='img_delete'>x</button>";
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







