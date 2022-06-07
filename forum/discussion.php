<?php
include "body/headder.php";
include "functions/pdo.php";
error_reporting(0);
session_start();
$info=array();
if(!isset($_SESSION['discussion']))
{   $_SESSION['discussion']=true;
    $sql='SELECT * from topics ORDER BY topic_time DESC';
    $pre=$pdo->query($sql);
    while($row=$pre->fetch(PDO::FETCH_ASSOC))
    {
      array_push($info,$row);
    }
   if(!empty($info))
     {
     $_SESSION['info']=$info;
     header("Location: discussion.php");
     return ;
     }
  else {
    $_SESSION['error']="No Topics found";
    header("Location: discussion.php");
    return ;
  }

  }

?>
<!DOCTYPE HTML>
<html>
<head>
<title>topics</title>
<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" data-auto-replace-svg="nest"></script>
<style>
main{
  border-radius:10px;
  width:900px;
  border: 1.5px solid black;
  margin-left: 350px;
  padding-top:0%;
  padding-left:30px;
  background:white;
  display : inline-block;
  padding-bottom:1%;
  background: #DDDDDD;
}
#gfc{
margin-left:90px;
margin-top:1px;
background-color:gray;
padding:3px;
border-radius: 5px;
text-align: center;
}
a{

  text-decoration: none;
}
.mar{
  margin-left: 15px;
}
main:hover{
  background-color:white;
  font-color: black ;

}
.marg{
  margin-top: 80px;
}
</style>
</head>
<body style="">
  <div class="marg"></div>
  <h2 style="color:black; margin-left:350px;"><b>LATEST TOPICS</b></h2>
  <?php $r1=$_SESSION["info"];
  $errors=$_SESSION["error"];
  unset($_SESSION["info"]);
  unset($_SESSION['discussion']);
  unset($_SESSION["error"]);
  ?>
  <?php
  if(isset($errors)){
    echo("<p style='color: red;'>$errors</p>\n");
  }?>
  <br>
  <br>
<?php foreach($r1 as $r) { ?>
  <main >

  <a href="chat.php?id=<?php echo($r['topic_id']); ?>" style="color:black;font-size:30px;margin-left:40px;margin-top:100px">
   <?php echo($r['topic_title']); ?>
  </a>
   <p style='font-size:20px;margin-left:35px;margin-top:10px'>
       <i class='fas fa-user-graduate' style='font-size:50px'></i> by
   <a href='profile.php?id=<?php echo($r["topic_owner_id"]);?>' style='color:#00CED1;font-size: 20px;  margin-left:10px;'>
      <?php echo '@';
        echo ($r['topic_owner']);?></a>
    <i class="fas fa-clock" style="font-size:20px;margin-left:15px ;color:#C0C0C0;">
    </i>
    <label style="color:#909090">
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
?></p>

      <p style='font-size:20px; word-wrap: break-word; font-family: sans-serif;color:black; margin-left:90px;'>
        <?php echo($r['post_text']);?>
        </p></span>
        <i style='font-size:15.5px;margin-left:90px' class='far'>&#xf27a;</i>
        <p style="display:inline-block;"> <?php echo($r['post_no']); ?> </nav>
        <p id='gfc' style='color: black; display: inline-block;'>
      <?php echo($r['tags']); ?>
    </p></main>
    <br><br>
    <?php }?>
  <?php //end foreach ?>
  </label>
</body>
</html>
