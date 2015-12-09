<?php

require('./config.php');
header('Content-type: text/plain');

try {

  if(!isset($_POST['id'])){
    throw new Exception('No id specified');
  }

  else{
   $id = intval($_POST['id']);
   $req = $bdd->prepare('SELECT * FROM users WHERE id = :id');

   $exec = $req->execute(array(

     'id' =>$id ,

    ));
   
    if($req->rowCount()==0){
      throw new Exception('Invalid User');
    }

    else{
      if ($_FILES['picture']['error'] > 0) throw new Exception($_FILES['picture']['error']);
      $target_path  = "./pictures/";
      $target_path = $target_path . $id;
      if(move_uploaded_file($_FILES['picture']['tmp_name'], $target_path)) {
        echo "The file ".  $id.
        " has been uploaded";
      } 
      else{
        echo "There was an error uploading the file, please try again!";
      }
    }    
  }
}
catch(Exception $e){
  echo 'Caught exception: ',$e->getMessage();
}
?>
