<?php
include "functions/pdo.php";
include "body/headder.php";

if(isset($_POST['content'])){
 $sql="INSERT INTO post(topic_id,owner_id,owner_name,content,post_time) values (:topic_id , :owner_id , :owner_name ,:content , NOW())";
 $pre=$pdo->prepare($sql);
 $pre->execute(array(
   ':topic_id'=>$_GET['id'] ,
   ':owner_id'=>$_SESSION['userid'] ,
   ':owner_name'=>$_SESSION['name'] ,
   ':content'=>$_POST['content'] ,
 ));
 $i=$_GET['id'] ;
 $sq="UPDATE topics SET post_no=post_no + 1 WHERE topic_id='$i' ";
 $p=$pdo->query($sq);

 $id=$_GET['id'];
 header("Location: chat.php?id=$id");
 return;

}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>topics</title>
<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" data-auto-replace-svg="nest"></script>
<style>

#gfc {
background-color: grey;
font-size: 16px;
display: inline-block;
border-radius: 5px;
margin-left: 5px;
padding:1px;

}
.m{
  margin-top:10px;
  margin-left:200px;
  width:1100px;
  border:2px solid black;
  padding:5%;
  margin-bottom:10px;
}
.n{
  margin-top:100px;
  margin-left:200px;
}
.h{

  margin-left:200px;
}
.t{
    margin-top:5px;
}
textarea:focus, input:focus {
    color:rgb(255, 0, 0);
}
</style>
</head>
<body>
  <?php
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $sql="SELECT * FROM topics WHERE topic_id='$id'";
  $q=$pdo->query($sql);
  $r=$q->fetch(PDO::FETCH_ASSOC);
} ?>
<div class="n">
  <h2><?php echo($r['topic_title']); ?> <span id="gfc"><?php echo($r['tags']); ?></span></span></h2>
</div>
  <hr class="t h">
  <diV class="m">
<i class='fas fa-user-graduate' style='font-size:50px'></i> by
<a href='profile.php?id=<?php echo($r["topic_owner_id"]);?>' style='color:#00CED1;font-size: 20px;  margin-left:10px;'>
   <?php echo '@';
     echo ($r['topic_owner']);?></a>


<i class='fas fa-clock' style='font-size:24px'></i>
<?php
date_default_timezone_set("Asia/Calcutta");
$time=strtotime($r['topic_time']);
$diff=abs(time()-$time);
$sec     = $diff;
$min     = round($diff / 60 );
$hrs     = round($diff / 3600);
$days     = round($diff / 86400 );
$weeks     = round($diff / 604800);
$mnths     = round($diff / 2600640 );
$yrs     = round($diff / 31207680 );
if($sec <= 60) {
  echo " $sec seconds ago";
}
else if($min <= 60) {
  if($min==1) {
      echo " one minute ago";
  }
  else {
      echo " $min minutes ago";
  }
}
else if($hrs <= 24) {
  if($hrs == 1) {
      echo " an hour ago";
  }
  else {
      echo " $hrs hours ago";
  }
}
else if($days <= 7) {
  if($days == 1) {
      echo " Yesterday";
  }
  else {
      echo " $days days ago";
  }
}
else if($weeks <= 4.3) {
  if($weeks == 1) {
      echo " a week ago";
  }
  else {
      echo " $weeks weeks ago";
  }
}
else if($mnths <= 12) {
  if($mnths == 1) {
      echo " a month ago";
  }
  else {
      echo " $mnths months ago";
  }
}
else {
  if($yrs == 1) {
      echo " one year ago";
  }
  else {
      echo " $yrs years ago";
  }
}
?></label>
<h4 style="margin-left:50px;word-wrap: break-word;"><b><?php echo($r['post_text']); ?></b></h4>
<hr class='t'>
<?php
   $id=$_GET['id'];
   $sq="SELECT * FROM post WHERE topic_id=$id";
   $q1=$pdo->query($sq);
  while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ ?>
<i class='fas fa-user-graduate' style='font-size:50px'></i> by

  <a href='profile.php?id=<?php echo($r1["owner_id"]);?>' style='color:#00CED1;font-size: 20px;  margin-left:10px;'>
     <?php echo '@';
       echo ($r1['owner_name']);?></a>
  <i class='fas fa-clock' style='font-size:24px'></i>
  <label style="color:#909090">
    <?php
date_default_timezone_set("Asia/Calcutta");
$time=strtotime($r1['post_time']);
$diff=abs(time()-$time);
$sec     = $diff;
$min     = round($diff / 60 );
$hrs     = round($diff / 3600);
$days     = round($diff / 86400 );
$weeks     = round($diff / 604800);
$mnths     = round($diff / 2600640 );
$yrs     = round($diff / 31207680 );
if($sec <= 60) {
      echo " $sec seconds ago";
  }
else if($min <= 60) {
      if($min==1) {
          echo " one minute ago";
      }
      else {
          echo " $min minutes ago";
      }
  }
else if($hrs <= 24) {
      if($hrs == 1) {
          echo " an hour ago";
      }
      else {
          echo " $hrs hours ago";
      }
  }
else if($days <= 7) {
      if($days == 1) {
          echo " Yesterday";
      }
      else {
          echo " $days days ago";
      }
  }
else if($weeks <= 4.3) {
      if($weeks == 1) {
          echo " a week ago";
      }
      else {
          echo " $weeks weeks ago";
      }
  }
else if($mnths <= 12) {
      if($mnths == 1) {
          echo " a month ago";
      }
      else {
          echo " $mnths months ago";
      }
  }
else {
      if($yrs == 1) {
          echo " one year ago";
      }
      else {
          echo " $yrs years ago";
      }
  }
?>
</label>
  <h4 style="margin-left:50px; word-wrap: break-word;"><b> <?php echo($r1['content']); ?></b></h4>
<br>
<?php } ?>

<form method="post" >
<textarea rows="10" cols='70' name='content' style="margin-top:10px;" required></textarea>

</br>
</br>
<button   style="background-color:darkCyan; border-radius: 8px; height:30px; width:15%;margin-left: 60px;" type="submit" name='submit' vaue='sub'>   Add new post</button>
</form>
</div>
</body>
</html
