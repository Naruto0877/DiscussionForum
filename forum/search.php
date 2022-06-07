<?php
include "body/headder.php";
require_once "functions/pdo.php";
error_reporting(0);
session_start();
$info=array();
if($_SESSION['login'])
{
  if(isset($_POST['title']))
  {
    $sql='select * from topics WHERE topic_title LIKE :title ORDER BY topic_time DESC';
    $pre=$pdo->prepare($sql);
    $pre->execute(array(
      ':title' => "%".$_POST['title']."%",
    ));
    //vardump($row);
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
}
?>
<html>
<head>
<title> Search Topic</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="nik.css">
    <style>
    .uibutton{
    margin-top:20px;
    float:left;
    background-color:darkCyan;
    color:white;
    font-size:17px;
    border-radius:6px;
    padding:8px 17px;
    margin-left:180px;
    }
    h2{
    text-align:left;
    margin-left:170px;
    margin-top:80px;
    font-size:40px;
    margin-bottom:30px;
    }
    .s{
    text-align:left;
    float:left;
    margin-top:0.1px;
    margin-left:170px;
    border-width:2px;
    font-size:20px;
    margin-down:100px;
    }
    ::placeholder{
    font-size:17.5px;
    }
    .ip-n{
    text-align:left;
    float:left;
    margin-top:10px;
    margin-left:10px;
    border-radius:6px;
    width:1200px;
    height:40px;
    border-color:darkCyan;
    border-width:2px;
    display: inline-block;
    }
    body{
    background-size: 100%;
    }
    .p2{
     padding-top:110px;
     color: black;
    }
    .font{
    font-family: bg;
    color: black;
    padding-right:350px;
     font-size: 19px;
    }
    .ip-select {
    text-align: left;
    padding: 10px;
    border-radius: 6px;
    width: 180px;
    height: 38px;
    border-color: black;
    }
    .Phno{
    text-align: left;
    padding: 10px;
    border-radius: 6px;
    width: 160px;
    height: 38px;
    border-color:black;
    }
    .block {
  display: block;
  width: 10%;
  border: none;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
  }
  main{
    border-radius: 5px;
    width: 900px;
    height: 195px;
    border: 3px solid black;
    margin-left: 300px;
    margin-top: 20px;
    padding-top:0;
    padding-left:30px;
    background: #DDDDDD;
  }
  #gfc{
  margin-left:25px;
  background-color: grey;
  padding: 3px;
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
    background-color:white ;
    font-color: black ;

  }
  .marg{
    margin-top: 15px;
  }
</style>
</head>
<body class="bg" >
<center>
<form method="post" ">
<div class="imgcontainer text-center">

  </div>
<br>
<h2 >Search Topics</h2>
<?php $r1=$_SESSION["info"];
$error=$_SESSION["error"];
unset($_SESSION["info"]);
unset($_SESSION["error"]);
?>
<?php
if(isset($error)){
  echo("<p style='color: red;'>$error</p>\n");
}?>
<diV>
<div style="padding-right:38px;" class="s"><input class="ip-n" type="text" placeholder="Subject" Name="title" required=""></div>
<br></br>
    <button class="uibutton" name="search" value="do" type="submit">
    <i class="fa fa-search"></i>
    Search
  </button>
</form>
</center>
</diV>
    <div style="margin-top:140px;">
  <?php foreach($r1 as $r) { ?>
    <main >

    <a href="chat.php?id=<?php echo($r['topic_id']); ?>" style="color:black;font-size:35px;margin-left:40px;margin-top:100px">
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
