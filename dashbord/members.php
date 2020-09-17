<?php
$title = 'Members';
session_start();
if(isset($_SESSION['username'])){
   include 'init.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'Mange';

if ($page == 'Mange') {

   $pending = '';
   if(isset($_GET['action']) && $_GET['action'] == 'pending'){
      /**
       * دي عشان يجيب الاعضاء اللي مش متفعله انا عملت متغير شتيل قيمه فاضيه
       * ولما لاقي ان هو داخل عن طريق ريكوست معين اللي هو اكشن يساوي بنددنج
       * هيغير المتغير الفاضي ده ويحط فيه الاستعلام بتاع الاعضاء اللي مش مفعله
       * لو مش جاي عن طريق الاكشن بندنج مش هيعمل اي حاجه وهيكمل عادي
       */
      $pending = 'AND RegStatues = 0';
   }


   $stmt = $con->prepare("SELECT * FROM users WHERE GroupID !=1 $pending");//هنا انا حددت جدول اليوزرز كله ماعدا اللي الجروب ايدي بتاعه يساوي واحد
   $stmt->execute();
   $rows = $stmt->fetchAll(); //هنا انا جيب كل البيانات من الجدول وحفظتهم في متغير عشان اعمل عليه لوب
   
   
   ?>

<div class="container">
<h2 class='text-center py-3'>Manege Members</h2>
   <table class="table text-center table-bordered">
   <?php if(!empty($rows)): ?>
      <thead>
         <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Full Name</th>
            <th scope="col">Join Date</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
         </tr>
      </thead>
   <?php else: alert('There Is No Members');?>
   <a class='btn btn-primary' href="members.php?page=Add">
   <i class="fas fa-plus-circle mr-3"></i>Add Ne Member
   </a>
   <?php endif;?>
      <tbody>
      <?php foreach($rows as $row): ?>
         <tr>
            <th><?php echo $row['UserID'] ?></th>
            <td><?php echo $row['Username'] ?></td>
            <td><?php echo $row['Email'] ?></td>
            <td><?php echo $row['FullName'] ?></td>
            <td><?php echo $row['Date'] ?></td>
            <td><a href="members.php?page=Edit&id=<?php echo $row['UserID'] ?>"><i class="far fa-edit"></i></a></td>
            <td><a href="members.php?page=Delete&id=<?php echo $row['UserID'] ?>"><i class="far fa-trash-alt"></i></a></td>
            <?php if($row['RegStatues'] == 0):?>
            <td><a href="members.php?page=Activat&id=<?php echo $row['UserID'] ?>" class=''><i class="fas fa-check"></i></a></td>
            <?php endif; ?>
         </tr>
      <?php endforeach; ?>
      </tbody>
   </table>
   <!-- Add new Member -->
   <a class='btn btn-primary' href="members.php?page=Add">
   <i class="fas fa-plus-circle mr-3"></i>Add Ne Member
   </a>
</div>

  
<!-- add members -->
<?php }elseif($page == 'Add'){?>
<h2 class='text-center py-3'>Add Members</h2>
<!-- Add Form -->
<form class="form-horizontal" action="?page=Insert" method='POST' enctype="multipart/form-data">
   <div class="form-group">
      <label class="control-label col-sm-2" for="username">USERNAME:</label>
      <div class="col-sm-10">
      <input type="text" class="form-control"  name='username' id="username" require='require'>
      </div>
   </div>
   <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
      <input type="email" class="form-control" name='email' id="email" require='require'>
      </div>
   </div>
   <div class="form-group">
      <label class="control-label col-sm-2" >Password:</label>
      <div class="col-sm-10">
      <input type="password" class="form-control" name='password' placeholder="Enter password" require='require'>
      </div>
   </div>
   <div class="form-group">
      <label class="control-label col-sm-2" for="fullname">Full Name:</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" name='fullname' id="fullname" require='require'>
      </div>
   </div>
   <div class="form-group">
      <label class="control-label col-sm-2" for="avatar">Avatar:</label>
      <div class="col-sm-10">
      <input type="file" class="form-control" name='avatar' id="avatar" require='require'>
      </div>
   </div>


   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">Add New Member</button>
      </div>
   </div>
   </form>


<?php 

}elseif($page == 'Insert'){
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
     
      $avatarName = $_FILES['avatar']['name'];//هنا انا بحدد اسم الصوره اللي هرفعها
      $avatarSize = $_FILES['avatar']['size'];//هنا بحدد الحجم بتاعها
      $avatarTmp = $_FILES['avatar']['tmp_name'];//هنا بحدد المسار بتاعها اللي ع الجهاز
      $avatarType = $_FILES['avatar']['type'];//هنا بحدد نوعها

      $avatarAllawExtentions = array("jpeg","jpg","png"); //هنا انا عملت مصفوفه فيها الامتدادات اللي انا عايزها تترفع عشان اشيك عليها
      $avatarExtention = explode(".",$avatarName);//هنا بجيب اللي بعد علامه الدوت اللي هو الامتدادا يعني
      $fineshAvatar = strtolower(end($avatarExtention));//هنا بقوله اما تجيب اللي بعد علامه الدوت هات اللي هي اخر واحده وخليها حروف سمول
      

      
      $username = $_POST['username'];
      $pass = $_POST['password']; //هنا عشان اشيك عليه 
      $email = $_POST['email'];
      $fullname = $_POST['fullname'];
      $hashPass = sha1($_POST['password']); //وده عشان احطه ف الداتا بيز متشفر

      $Errors = array(); //هنا هيضيف كل الايرورس اللي هتطلع في الاري دي
      if(empty($username)){$Errors[] = 'Pleas Add Username';}
      if(!empty($username) && strlen($username) < 4){$Errors[] = 'Pleas Make Username More than 4';}
      if(empty($pass)){$Errors[] = 'Pleas Add Password';}
      if(empty($email)){$Errors[] = 'Pleas Add Email';}
      if(empty($fullname)){$Errors[] = 'Pleas Add Full Name';}
      if(!empty($avatarName) && !in_array($fineshAvatar, $avatarAllawExtentions)){
         //هنا بشيك لو الاسم فاضي و النوع بتاع الصوره مش موجود في المصفوفه اللي انا عاملها طلعلي الايرور ده
         $Errors[] = 'This Not Img Pleas Add Valeid Image';
      }
      if($avatarSize > 4194304){
         //هنا بشيك لو الصوره اكبر من 4 ميجا طلع الايرور ده
         $Errors[] = 'Your Img Is larger Than 4MB';
      }
      foreach($Errors as $Error){
         echo '<div class="alert alert-danger">'.$Error.'</div>';
      }

      if(empty($Errors)){//هنا لو الايرور قاضيه هينفذ الاستعلام
         

         $avatarRandName = rand(0, 100000)."_". $avatarName;//هنا انا بجيب اسم الصوره و بضيف عليه ارقام عشوئي عشان متبقاش متشابهها
         //هنا بقا انا بنقل الصوره من مسارها للمسار اللي انا محدده بالاسم اللي انا محدده
         move_uploaded_file($avatarTmp, "uploads\useravatar\\" . $avatarRandName);

         $checkAdd = checkItems('Username','users', $username); //بيشيك هل اليوزر ده موجود ولا لا لو موجود هيطلع ايرور لو مش موجود هعمل ادد ليوزر جديد
         if($checkAdd == 1 ){
            redirectFunc('This UserName IS Existe','members.php',2,'danger');
         }else{
         //هنا انا بضيف بيانات في الداتا بيز حددت الحقول اللي هضيف فيها
         $stmt = $con->prepare("INSERT INTO  users(Username,  Pasword, Email, FullName, RegStatues , Date, avatar) 
                              VALUES(:auser, :apass, :aemail, :afull, 1 , now(), :avatar)");//وبعد كده حددت لكل حقل اسم عشان هستخدمه بعدكده
         $stmt-> execute (array( // هنا انا هضيف الداتا في الحقول عن طريق الاسامي اللي انا محددها 
            'auser' => $username,
            'apass' => $hashPass,
            'aemail' => $email,
            'afull' => $fullname,
            'avatar' => $avatarRandName //هنا انا بضيف اسم الصوره في الداتا بيز 
            
         ));
         redirectFunc('Add Member Done','members.php',2,'success');
      }}
      
   }else{redirectFunc('Cant Update data this not POST Requst','members.php',4);}
}elseif($page == 'Edit'){
   echo "<h2 class='text-center py-3'>Edit Members</h2>";
   /*
   *هنا انا  بشوف هل في اي دي في البحت ولا لا  و هل هو رقم 
   * لو الكلام ده صح هيجيب الايدي ده وهو عباره عن رقم غير كده هيرجع صفر
   * * is_numeric ==> ده بيشوف القيمه اللي فيه رقم ولا لا
   * * intval ==> ده بيجيب النتيجه الرقميه اللي طلعت
   */
  $user = isset($_GET['id'])&& is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  
  $stmt = $con->prepare("SELECT * FROM users WHERE userID = ? LIMIT 1");
  $stmt->execute(array($user));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();
  if($count > 0){ ?>
   
<!-- Edit Form -->
   <form class="form-horizontal" action="?page=Update" method='POST'>
   <input type="hidden" name='userid' value="<?php echo $row['UserID']; ?>">
   <div class="form-group">
      <label class="control-label col-sm-2" for="username">USERNAME:</label>
      <div class="col-sm-10">
      <input type="text" class="form-control"  name='username' id="username" value="<?php echo $row['Username']; ?>" autocom>
      </div>
   </div>
   <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
      <input type="email" class="form-control" name='email' id="email" value="<?php echo $row['Email']; ?>">
      </div>
   </div>
   <div class="form-group">
      <label class="control-label col-sm-2" >Password:</label>
      <div class="col-sm-10">
      <input type="hidden" name='oldPass' value='<?php echo $row['Pasword']; ?>'>
      <input type="password" class="form-control" name='password' placeholder="Enter password">
      </div>
   </div>
   <div class="form-group">
      <label class="control-label col-sm-2" for="fullname">Full Name:</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" name='fullname' id="fullname" value="<?php echo $row['FullName']; ?>">
      </div>
   </div>


   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">Submit</button>
      </div>
   </div>
   </form>

<?php

}else{redirectFunc("Cant Fiend this User",'members.php',4);}

   }elseif($page == 'Update'){
      /*
      *هنا انا بقوله لو البيدج تساوي ابديت يبقا كده تمام
      *ابدء شوف بقا لو الريكوست ده جاي من بوست نفذ الكلام ده
      *اللي هو يجيب كل البيانات اللي في الحقول اللي موجوده و يعدلها في الداتا بيز
      */
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
         $id = $_POST['userid'];
         $username = $_POST['username'];
         $email = $_POST['email'];
         $fullname = $_POST['fullname'];
         $pass = empty($_POST['password']) ? $_POST['oldPass'] :  sha1($_POST['password']);

         $Errors = array(); //هنا هيضيف كل الايرورس اللي هتطلع في الاري دي
         if(empty($username)){$Errors[] = 'Pleas Add Username';}
         if(!empty($username) && strlen($username) < 4){$Errors[] = 'Pleas Make Username More than 4';}
         if(empty($email)){$Errors[] = 'Pleas Add Email';}
         if(empty($fullname)){$Errors[] = 'Pleas Add Full Name';}
         foreach($Errors as $Error){
            echo '<div class="alert alert-danger">'.$Error.'</div>';
            redirectFunc('I will Redirect you to Member Page After 3 Seconds','members.php',3);
         }

         if(empty($Errors)){//هنا لو الايرور قاضيه هينفذ الاستعلام
            /**
             *  هنا انا بشيك علي الابديت بتاع الاعضاء 
             * هنا هشيوف لو اليوزر نيم ده موجود بس مايكونش يساوي الاي دي اللي انا محدده ده 
             * هيطلع رساله خطء ان اليوزر ده موجود 
             */
             $checkUpdate = $con->prepare("SELECT * FROM users WHERE Username = ? AND UserID != ?");
             $checkUpdate->execute(array($username,$id));
             $count = $checkUpdate->rowCount();
             if($count == 1){
             redirectFunc('This User Existe','members.php',2,'danger');
             }else{
            $stmt = $con->prepare("UPDATE  users SET Username = ?, Email = ?, FullName = ?, Pasword = ? WHERE UserID = ?");
            $stmt->execute(array($username, $email, $fullname, $pass, $id));
            redirectFunc('Updating Member Done','members.php',3,'success');
         }}
         
      }else{redirectFunc('Cant Update Data This Not POST Requst','members.php',2);}
   }elseif($page == 'Delete'){
      /*
      *هنا انا  بشوف هل في اي دي في البحت ولا لا  و هل هو رقم 
      * لو الكلام ده صح هيجيب الايدي ده وهو عباره عن رقم غير كده هيرجع صفر
      * * is_numeric ==> ده بيشوف القيمه اللي فيه رقم ولا لا
      * * intval ==> ده بيجيب النتيجه الرقميه اللي طلعت
      */
      $user = isset($_GET['id'])&& is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      /**
       * هنا انا بقوله جيبلي الجدول بتاع اليوزر ده عن  طريق الايدي بتاعه
       */
      // $stmt = $con->prepare("SELECT * FROM users WHERE userID = ? LIMIT 1");
      // $stmt->execute(array($user));
      // $count = $stmt->rowCount();
      $checkDelet = checkItems('UserID','users',$user);//بنتعمل نفس اللي انا عاملها كومنت فوق دي 
      if($checkDelet > 0){ //هنا بقا  بشوف هل الداتابيز فيه الريكورد ده فعلا ولا لا عشان لو موجود ينفذ
         /*
         *هنا انا بعمل استعلام بيحذف اليوزر من الداتابيز ولو الجروب اي دي يساوي واحد مش هنفذ الاستعلام
         */
         $stmt = $con->prepare("DELETE FROM users WHERE userID = :id and GroupID !=1 LIMIT 1");
         $stmt->execute(array('id'=>$user));
         /*ممكن استخدم دي بدل اللب فوق عادي
         $stmt->bindParam(":id",$user);
         $stmt->execute();
         */
        redirectFunc('Deleting Member Done','members.php',2,'success');
   }else{ redirectFunc('Cant Finde Any Users','members.php',4); }
}elseif($page == 'Activat'){
   /*
      *هنا انا  بشوف هل في اي دي في البحت ولا لا  و هل هو رقم 
      * لو الكلام ده صح هيجيب الايدي ده وهو عباره عن رقم غير كده هيرجع صفر
      * * is_numeric ==> ده بيشوف القيمه اللي فيه رقم ولا لا
      * * intval ==> ده بيجيب النتيجه الرقميه اللي طلعت
      */
      $user = isset($_GET['id'])&& is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      $checkActivat = checkItems('UserID','users',$user);
      if($checkActivat > 0){
         $stmt = $con->prepare("UPDATE users SET RegStatues = 1 WHERE UserID = ?");
         $stmt->execute(array($user));
         redirectFunc('Activation Done','members.php',2,'success');
      }else{redirectFunc('Cant Finde Any Users','members.php',3);}
      
}else{//this ELSE for the big IF//
   redirectFunc('Cant Finde This Page I Will Redirect You In Home Page','index.php',3);
}

   include $tpl . 'footer.php';
}else{
   header('Location: index.php');
   exit();
}



?>