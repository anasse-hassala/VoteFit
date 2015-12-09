<?php

require('./config.php');
header('Content-type: text/plain');

try{

if(isset($_GET['id'])){
  $id = intval($_GET['id']);
  $req = $bdd->prepare('SELECT * FROM users WHERE id =:id ');

  $exec = $req->execute(array(

    'id' =>$id

  ));

  $count = $req->rowCount();

  if($count==1){
    if(!file_exists('./pictures/'.$id)) throw new Exception("User doesn't have a picture");
    $rm = unlink('./pictures/'.$id);
    if($rm){echo "Deleted picture for user id=",$id;}
    else echo('Cannot remove file');
  }
  else{
    throw new Exception('No user with id '.$id);
  }
}


else{
  throw new Exception('No id Specified');
}
}

catch(Exception $e) {

  echo 'Caught exception: ', $e->getMessage(), "\n";
}
?>
