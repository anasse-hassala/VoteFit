<?php

require('./config.php');
header('Content-type: application/json');

$req = $bdd->prepare('INSERT INTO users(id, up, down, last_seen) VALUES(:id, :up, :down, :last_seen)');

$exec = $req->execute(array(

    'id' =>NULL ,

    'up' => 0,

    'down' => 0,

    'last_seen' => date('Y-m-d')

    ));

if($exec){
$response = array('id'=>$bdd->lastInsertId());
echo json_encode($response);
}

?>
