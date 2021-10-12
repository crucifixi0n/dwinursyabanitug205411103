<?php

$connect = new PDO('mysql:host=localhost;dbname=id17035236_comment', 'id17035236_root', 'Qwertyuiop-123');

$error = '';
$name = '';
$comment = '';

if(empty($_POST["name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $name = $_POST["name"];
}

if(empty($_POST["comment"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment = $_POST["comment"];
}

if($error == '')
{
 $query = "
 INSERT INTO comment 
 (parent_comment_id, comment, sender_name) 
 VALUES (:parent_comment_id, :comment, :sender_name)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment,
   ':sender_name' => $name
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>