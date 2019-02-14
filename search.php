
<?php




function search ($query) 
{ 
    $config = [
    'host' =>'localhost',
    'user' =>'root',
    'password' =>'',
    'db' =>'baza3',
];
$conn = mysqli_connect($config['host'],$config['user'],$config['password'],$config['db']);
    $query = trim($query); 
    
    /*$query = mysql_real_escape_string($query);*/
   
    $query = htmlspecialchars($query);
    
    
    if (!empty($query)) 
    { 
        if (strlen($query) < 3) {
            $text = '<p>Search request too short.</p>';
            
        } else if (strlen($query) > 128) {
            $text = '<p>Search request too long.</p>';
            
        } else { 
         
      $q = "SELECT  * FROM `posts` WHERE `title` LIKE '%$query%'
                  OR `content` LIKE '%$query%' ";

            $result = mysqli_query($conn,  $q);
            
            $roww = mysqli_num_rows($result);
           
            
           
            
            

            if( $roww >0)  { 
                
                $row = mysqli_fetch_assoc($result);
                
                
                
                

                $text = '<p>On request <b>'.$query.'</b> matches found  : '.$roww.'</p>';
                

                do {
                    
                        $a=$row['title'];
                        $b=$row['content'];
                    
                    
                    $text=$text."<br>".$a."<br>".$b;

                         

                    
                    
                    
                    

                   

                    
                    

                } while ($row = mysqli_fetch_assoc($result)); 
            } else {
                $text = '<p>No results found for your request.</p>';
            }
        } 
    } else {
        $text = '<p>An empty search query is set.</p>';
    }

    return $text; 
}
if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}
?>