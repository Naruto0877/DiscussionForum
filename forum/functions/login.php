<?php include "pdo.php"; ?>
<?php
function check(){
  global $pdo;
  $mail=$_POST['email'];
  $sql=$pdo->query("SELECT * FROM customerinfo ");
  while( $row=$sql->fetch(PDO::FETCH_ASSOC))
  {
     if ( $row['Email_address'] == $mail)
       {
          return false;
       }
   }
   return true;
} ?>


<?php
function register()
{
  session_start();
  global $pdo;
  if (check()){
   $password = hash('md5',$_POST['pass']);
   $sql_INSERT="INSERT INTO customerinfo (Name , Email_address, Password, joined_on )
              VALUES(:name, :email, :password ,NOW() )";
   $insert=$pdo->prepare($sql_INSERT);
   $insert->execute(array(
         ':name' => $_POST['name'],
         ':email' => $_POST['email'],
         ':password' => $password,
       ));?>
  <script>
      alert("Registered sucessful");
  </script>
  <?php
  }
else { ?>
  <script>
  alert("mail already exist");
  </script>
  <?php
  }
}
?>



<?php
function login(){
  session_start();
      global $pdo;
  if (isset($_POST['email']) && isset($_POST['pass']))
  {
    $sql= " select * from customerinfo WHERE Email_address=:username AND Password= :password";
    $pre=$pdo->prepare($sql);
    $pre->execute(array(
      ':username'=>$_POST['email'],
      ':password'=>hash('md5',$_POST['pass'])
    ));
    $s=$pre->fetch(PDO::FETCH_ASSOC);

if($s){
    $_SESSION['login']=true;
    $_SESSION['name']=$s['Name'];
    $_SESSION['email']=$s['Email_address'];
    $_SESSION['userid']=$s['CustomerID'];
    header("Location: home.php");
    return;
  }
else{ ?>
<script>
    alert("details are incorrect");
</script>
<?php
 }
}
} ?>
