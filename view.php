<?php

require_once('./config.php');
header('Content-type: application/json');

try{
  if(!isset($_GET['id'])) throw new Exception('Invalid user');

  $id = intval($_GET['id']);

  $req_user = $bdd->prepare('SELECT id FROM users WHERE id = :id  ');
  $req_target = $bdd->prepare('SELECT target FROM views WHERE viewer = :id');
     
  $max_id = intval($bdd->query('SELECT MAX(id) FROM users')->fetch()[0]);

  $user = $req_user->execute(array( 'id' =>$id ));
  $target = $req_target->execute(array( 'id' =>$id));


  if($user){
    $response = [];
    $response['done']=false;
    $viewed = array();
    foreach($req_target->fetchAll() as $row ){
      $viewed[] = $row[0];
    }
    $i = 1; 

    while(count($response) <= 10 && $i < $max_id ){
	if( !in_array($i,$viewed) && $i!=$id && file_exists('./pictures/'.$i)) $response[]=$i;
	$i++;
    }
    if($i==$max_id) $response['done']=true;

    
      echo json_encode($response);
  }
}

catch(Exception $e){
  echo 'Caught exception: ', $e->getMessage();
}

?>
