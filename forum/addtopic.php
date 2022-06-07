<?php
include "body/headder.php";
include "functions/pdo.php";
session_start();
error_reporting(0);
if($_SESSION['login'])
{
  if ( isset($_POST["tag"]) && isset($_POST['text']) && isset($_POST['title']))
  {
  $sql="INSERT INTO topics (topic_title , topic_time ,topic_owner_id ,topic_owner , post_text ,tags) values(:title , NOW() , :id , :name , :text , :tag)";
  $pre=$pdo->prepare($sql);
  $pre->execute(array(
    ':title' => $_POST['title'],
    ':id'=>$_SESSION['userid'],
    ':name'=>$_SESSION['name'],
    ':text'=>$_POST['text'],
    ':tag'=>$_POST['tag'],

  ));
   $s=$_SESSION['userid'];
  $sq="UPDATE customerinfo SET posts=posts+1 WHERE CustomerID='$s'";
  $pr=$pdo->query($sq);

  $_SESSION['add']="The ".$_POST['title']." topic has been created";
  header("Location:addtopic.php");
  return;
}
else{
  }
}
else{
    $_SESSION['perror']="Session Expired plaease login again";
    header("Location: index.php");
   return;}
 ?>
<html>
<head>
<title> <b>Add a topic</b></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="nik.css">
    <style>
    }
    body{
    background-size: 100%100%;
    }
  .b{
    color:white;
    padding:8px 22px;
    font-size:20px;
    float:left;
    margin-top:15px;
    margin-left:160px;
    background-color:darkCyan;
    border-radius:8px;
   }
   h2{
    text-align:left;
    margin-left:150px;
    margin-top:80px;
    font-size:40px;
    margin-bottom:30px;
    }
   .field{
    margin-top:15px;
    font-size:20px;
    text-align:left;
    margin-left:160px;
    }
    .so{
     height:40px;
     }
     .so,.s{
     width:1200px;
     border-color:darkCyan;
     border-radius:6px;
     border-width:2px;
     }
     ::placeholder{
     font-size:17.8px;
     }
     .s{
     height:170px;
     }
</style>
</head>
<body class="bg">
<form  method="post" >
<center>
  <?php if(isset($_SESSION)){
    $add=htmlentities($_SESSION['add'])?? false;
      unset($_SESSION['add']);}
      ?>
<h2 style="font-family:bg">Add New Topic</h2>
      <?php
      if($add != false){
        echo('<p style="color: green;">'.$add."</p>\n");
      } ?>
  <div class="field">
    <label for="subject">Subject</label><br>
    <input id="subject" name="title" class="so" placeholder="Subject" required type="text" value="">
  </div>
  <div class="field">
    <label for="body">Message body</label><br>
    <textarea placeholder="Type" id="body" class="s" name="text" required>
  </textarea>
  </div>
  <div class="field">
    <label for="tags">Tags</label><br>
    <input id="tags" name="tag" class="so" placeholder="tags" required>
      </div>
  <button class="b" type="submit" name='login' value='loginn'><span>&#9998;</span>
    Add new topic
  </button>
<br>
</center>
</form>
</body>
</html
