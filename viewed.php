<?php

require_once('./config.php');
header("HTTP/1.0 200 OK");

if(!isset($_POST['id']) || !isset($_POST['vote'])) exit();

$id = intval($_GET['id']);
$target = $_POST['id'];
$vote = $_POST['vote'];
$select=$bdd->query('SELECT * FROM views WHERE viewer= '.$id.' AND target = '.$target);

if($select->rowCount()==0){
  $req_view = $bdd->prepare('INSERT IGNORE INTO views(viewer, target) VALUES(:id, :target)');
  $req_view->execute(array( 'id' => $id, 'target' => $target ));  
}

$req_vote = $bdd->prepare('UPDATE users SET up = up + 1 WHERE id = :id');

if($vote == 'up'){
  $req_vote = $bdd->prepare('UPDATE users SET up = up + 1 WHERE id = :id');
  $req_vote->bindParam(':id',$target, PDO::PARAM_INT);
  $req_vote->execute();
}

if($vote == 'down'){
  $req_vote = $bdd->prepare('UPDATE users SET down = down + 1 WHERE id = :id');
  $req_vote->bindParam(':id',$target, PDO::PARAM_INT);
  $req_vote->execute();
}
echo json_encode($_POST);
?>
