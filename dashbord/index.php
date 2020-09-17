<?php
session_start(); // هنا انا عمل سيشن جديده
$no_navbar = '';
$title = 'Login';
if(isset($_SESSION['username'])){ //هنا بقا بقوله لو اتسجل سيشن في يوزر نيم اللي انا عامله تحت حوله علي الصفحه اللي انا محددها دي
   header('Location: admin.php');
   exit();
    
}

?>

  <?php
   include 'init.php'; 
   
   ?>
               
    <?php
    
/******** Logi Admin **********/
    if($_SERVER['REQUEST_METHOD'] == 'POST'){//هنا انا بقوله لو الريكوست جاي عن طريق الميثود بوست نفذ اللكلام ده
        $user = $_POST['username'];
        $pass = $_POST['pass'];
        $hashed_pass = sha1($pass);
        //echo $user .' ' . $hashed_pass;

        $stmt = $con->prepare("SELECT userID , Username , Pasword FROM users WHERE Username = ? AND Pasword = ? AND GroupID = 1 LIMIT 1");
        $stmt->execute(array($user,$hashed_pass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();//ده بيشوف هل الاستعلام اللي فوق ده صح وموجود في الداتابيز ولا لا لو موجود هيطبع1 مش موجود عيطبع 0 
        //echo $count;
        
            if($count > 0){//هنا بقا انا بقوله لو اكبر من صفر هينفذ الشرط عشان لو هو اكبر من صفر يبقا هو لقي اللي محتاجه
            $_SESSION['username'] = $user; // هنا بقا بعد ما انا عملت سيشن فوق ف انا هضيف اليوزر اللي موجود للسيشن عشان ابقا استخدمه بعد كده
            $_SESSION['id'] = $row['userID'];
            
            }else{
                redirectFunc('Password Or Username Is Wrong','index.php',3,'danger');
            }
    }


    ?>
       




<form class='w-25 m-auto pt-5 ' action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='POST'>
<h4 class="text-center">Admin Login</h4>
<!-- username -->
    <div class="form-group">
    <input type="text" class="form-control" name='username' autocomplete="off">
    </div>
<!-- password -->
    <div class="form-group">
    <input type="password" class="form-control" name='pass' autocomplete="new-password">
    </div>
    <!-- submit -->
    <button type="submit" class="btn btn-primary btn-block">Login</button>
</form>

   
  <?php include ('./inc/templates/footer.php'); ?>