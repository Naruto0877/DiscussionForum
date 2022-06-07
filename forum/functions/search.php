<?php include "pdo.php"; ?>

<?php
function ser()
{
  $info=array();
  global $pdo;
$sql='select * from topics WHERE topic_title LIKE :title ORDER BY topic_time DESC';
$pre=$pdo->prepare($sql);
$pre->execute(array(
  ':title' => "%".$_POST['title']."%",
));

while($row=$pre->fetch(PDO::FETCH_ASSOC))
{
  array_push($info,$row);
}
if(!empty($info)){
$_SESSION['info']=$info;
header("Location: search.php");
return;
}
else{
$_SESSION['error']="No Topics found";
header("Location: search.php");
return;
}
}
