<?php
require('config.php');
$req = $bdd->prepare('SELECT * FROM users WHERE id = :id');

   $exec = $req->execute(array(

     'id' =>1 ,

    ));

    if($req->rowCount()==0){
      var_dump($req->rowCount());
      throw new Exception('Invalid User');
    }


?>
