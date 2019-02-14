<?php
include "connection.php";
foreach ($_POST as $key => $item) {
    $$key = $item;
}
$where = [
  'id'=>$_SESSION['user_id'],
];
$row = Select('users',$where);

$row = mysqli_fetch_assoc($row);

 if($new_firstname !== $row['firstname']){
     if(!empty($new_firstname)){
         $data['firstname'] = $new_firstname;
     }
 }

if($new_lastname !== $row['lastname']){
    if(!empty($new_lastname)){
        $data['lastname'] = $new_lastname;
    }
}


if($new_gender !== $row['gender']){
    if(!empty($new_gender)){
        $data['gender'] = $new_gender;
    }
}

if($new_pass == $new_pass_confirm){
    $new_pass = sha1(md5($new_pass));
    if($new_pass !== $row['password']){
        if(!empty($new_pass)){
            $data['password'] = $new_pass;
        }
    }
}else{
    $err = 'error in passwords';
    echo json_encode($err);die;
}





if($new_email !== $row['email']){
    if(!empty($new_email)){
        $row1 = Select('users',1,['email']);
        while($row2 = mysqli_fetch_assoc($row1)){
           if( $row2['email'] == $new_email){
               $err = 'email is already exist';
           }
        }
        if(!isset($err)) {
            $data['email'] = $new_email;
        }else{
            echo json_encode($row);die;
        }
    }
}




if(Update('users',$data,$where)){
    echo json_encode('exav');
}else{
    echo json_encode('chexav');
}



