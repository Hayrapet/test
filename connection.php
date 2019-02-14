<?php
session_start();
$config = [
    'host' =>'localhost',
    'user' =>'root',
    'password' =>'',
    'db' =>'baza3',
];
$conn = mysqli_connect($config['host'],$config['user'],$config['password'],$config['db']);

/*function Insert($table,$data){
  $query = 'INSERT INTO `'.$table.'` (';
  $fieldarr = [];
  $valuearr = [];
   foreach($data as $key => $value){
       $fieldarr[] = "`$key`";
       $valuearr[] = "'$value'";
   }
    $fields = implode(',',$fieldarr);

    $values = implode(',',$valuearr);
    $query .= $fields.') VALUES ('.$values.')';
//    var_dump($query);die;
    global $conn;
    $result = mysqli_query($conn,$query);
   return $result;
}



function Select($table,$wherearr='1',$fieldsarr = '*'){
    if($fieldsarr !== '*'){
        foreach ($fieldsarr as $key => $val) {
            $fieldsarr[$key]="`$val`";
        }
        $fields = implode(',',$fieldsarr);
    }else{
        $fields = '*';
    }
    $table = "`$table`";


    if($wherearr !== 1){
        $whereo = [];
        foreach ($wherearr as $key => $value){
            $whereo[] = "`$key` = '$value'" ;
        }
        $where = implode(',',$whereo);
    }else{
        $where = 1;

    }


    $select = "SELECT $fields FROM $table WHERE $where";
    global $conn;
    $query = mysqli_query($conn,$select);
    return $query;
}



/*function Update($table,$data,$where){
    $seto = [];
    foreach ($data as $key => $value){
        $seto[] = "`$key` = '$value'" ;
    }
    $dataa = implode(',',$seto);
    $whereo = [];
    foreach ($where as $key => $value){
        $whereo[] = "`$key` = '$value'" ;
    }
    $wheree = implode(' AND ',$whereo);
    $update = "UPDATE `$table` SET $dataa WHERE $wheree";
    global $conn;
    $query = mysqli_query($conn,$update);
    return $query;
}



function Delete($table,$data){

}*/
