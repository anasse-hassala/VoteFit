<?php

require('./config.php');
header('Content-type: text/plain');

try{

if(isset($_GET['id'])){
  $id = intval($_GET['id']);
  $req = $bdd->prepare('DELETE FROM users WHERE id =:id ');

  $exec = $req->execute(array(

    'id' =>$id

  ));

  $count = $req->rowCount();

  if($count==1){
    echo "Deleted user with id=",$id;
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
