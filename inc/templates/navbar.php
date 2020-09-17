
<?php
ob_start();
session_start();
if(isset($_SESSION['user'])){
if(checkUserIsActive($_SESSION['user']) == 1){
    echo '<div class="text-center bg-danger">You Are Not Activet</div>';
    }}


?>
<header class="w-100 ">
    <div class="container">
      <!-- First Header-->
       <div class="first-header">
          <div class="row">
          <div class="col-md-3 col-12">
           <a href="index.php" class="logo text-center">
               <img src="layout/img/logo.png" alt="">
           </a>
          </div>
          <div class="col-md-6 col-12">
           <div class="search-bar">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search aa"></i></span>
                    </div>
                    
                    <input type="text" class="form-control" placeholder="Search ...">
                    
                    <div class="input-group-append">
                        <button class="input-group-text">Search</button>
                    </div>
                </div>
           </div>
          </div>
          
          <div class="col-md-3 col-12">
           <div class="user-icons mt-2">
               <div class="row text-center">
                  <div class="col-4">
                   <div class="wish-list" id="wish-list">
                       <i class="far fa-heart ico" ></i>
                       <span class="badge badge-danger">2</span>
                   </div>
                  </div>
                  
                  <div class="col-4">
                   <div class="cart" id="cart">
                    <i class="fas fa-shopping-cart ico"></i>
                       <span class="badge badge-danger">1</span>
                   </div>
                  </div>
                  
                  <div class="col-4">
                      <?php if(isset($_SESSION['user'])): ?>
                        <div class="user-img" id="">
                        
                        <a href="profile.php"><?php echo $_SESSION['user']; ?></a>
                        <a href="logout.php"><i class="fas fa-sign-out-alt ico"></i></a><!-- Logout -->
                    </div> 
                        
                       
                        <?php else: ?>
                        <div class="user" id="user"> 
                       <i class="far fa-user ico" ></i><!-- Login -->
                        </div>
                      <?php endif; ?>
                  </div>
               </div>
               
               
           </div>
          </div>
          
          
          <!-- Cart items -->
          <div class="cart-items text-center col-4 p-2" id="cart-items">

            <div class="categ my-3">
                <div class="row">
                     <div class="col-5">
                         <div class="top-categ-img px-1">
                             <img src="layout/img/top-category/3.png" alt="" class="img-fluid">
                         </div>
                     </div>
                     <div class="col-7">
                          <div class="top-categ-content pt-1">
                             <h5 class="pb-2 m-0">
                                 <a href="">Fusion Backpack</a>
                             </h5>
                             <p class="m-0">
                                 <span>$100.00</span>
                             </p>
                             <div class="delete">
                                <a href=""><i class="far fa-trash-alt del"></i></a>
                             </div>
                         </div>
                     </div>
                </div>
             </div>
             

             


             
<hr>
             <div class="show-more px-3 py-2">
                <a href="./cart.html">Show More</a>
             </div>
          </div><!-- End Cart items -->
          
          
          
          
          <!-- Wish List -->
          <div class="wish-list-items text-center col-4 p-2" id="wish-list-items">
            <div class="categ my-3">
                <div class="row">
                     <div class="col-5">
                         <div class="top-categ-img px-1">
                             <img src="layout/img/top-category/3.png" alt="" class="img-fluid">
                         </div>
                     </div>
                     <div class="col-7">
                          <div class="top-categ-content pt-1">
                             <h5 class="pb-2 m-0">
                                 <a href="">Fusion Backpack</a>
                             </h5>
                             <p class="m-0">
                                 <span>$100.00</span>
                             </p>
                             <div class="delete">
                                <a href=""><i class="far fa-trash-alt del"></i></a>
                             </div>
                         </div>
                     </div>
                </div>
             </div>

             <div class="categ my-3">
                <div class="row">
                     <div class="col-5">
                         <div class="top-categ-img px-1">
                             <img src="layout/img/top-category/3.png" alt="" class="img-fluid">
                         </div>
                     </div>
                     <div class="col-7">
                          <div class="top-categ-content pt-1">
                             <h5 class="pb-2 m-0">
                                 <a href="">Fusion Backpack</a>
                             </h5>
                             <p class="m-0">
                                 <span>$100.00</span>
                             </p>
                             <div class="delete">
                                <a href=""><i class="far fa-trash-alt del"></i></a>
                             </div>
                         </div>
                     </div>
                </div>
             </div>
             <hr>
              <div class="show-more px-3 py-2">
                <a href="./wishlist.html">Show More</a>
             </div>
          </div><!-- End Wish List -->
          
          
          
          
          <!-- Login And register tabs -->
          
          <div class="user-tabs py-3 col-4" id="log-regi">
           <!-- tabs -->
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#login">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#register">register</a>
              </li>

            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
              <div class="tab-pane container active" id="login">
                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    if(isset($_POST['login'])){
                        // This for Login 
                        $user = $_POST['user'];
                        $pass = $_POST['user-pass'];
                        $hashed_pass = sha1($pass);

                        $stmt = $con->prepare("SELECT UserID , Username , Pasword FROM users WHERE Username = ? AND Pasword = ?");
                        $stmt->execute(array($user,$hashed_pass));
                        $getRow = $stmt->fetch();
                        $count = $stmt->rowCount();//ده بيشوف هل الاستعلام اللي فوق ده صح وموجود في الداتابيز ولا لا لو موجود هيطبع1 مش موجود عيطبع 0 
                        //echo $count;
                        
                        if($count > 0){//هنا بقا انا بقوله لو اكبر من صفر هينفذ الشرط عشان لو هو اكبر من صفر يبقا هو لقي اللي محتاجه
                        $_SESSION['user'] = $user; // هنا بقا بعد ما انا عملت سيشن فوق ف انا هضيف اليوزر اللي موجود للسيشن عشان ابقا استخدمه بعد كده
                        $_SESSION['uID'] = $getRow['UserID']; 
                        }else{
                            echo 'Password Or Username Is Wrong';
                            // redirectFunc('Password Or Username Is Wrong','index.php',1,'danger');
                            }
                    }else{
                        $errors = array();
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $pass = $_POST['pass'];
                        $repass = $_POST['re-pass'];
                        // This For register
                        if(isset($username)){
                            // بشيل كل الاكواد الخبيثه من حقل اليوزر نيم وبشيك عليه هل هو اكبر من اربع حروف
                            $clenUser = filter_var($username, FILTER_SANITIZE_STRING);
                            if(strlen($clenUser) < 4){
                                $errors[] = 'User Is Short';
                            }
                        }
                        if(isset($pass) && isset($repass)){
                            if(!empty($pass)){
                                if(sha1($pass) !== sha1($repass)){
                                $errors[] = 'Passwords Is Not Same';
                                }
                            }else{
                                $errors[] = 'Passwords Is Empty';
                            }
                        }
                        if(isset($email)){
                            // بشيك ع الايميل هل هو ايميل و هل هو صحيح
                            $clenEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
                            if(filter_var($email, FILTER_VALIDATE_EMAIL) !=TRUE){
                                $errors[] = 'This Email Is not Valid';
                            }
                        }
                        if(empty($errors)){
                            $checkRegister = checkItems('Username','users', $username); //بيشيك هل اليوزر ده موجود ولا لا لو موجود هيطلع ايرور لو مش موجود هعمل ادد ليوزر جديد
                            if($checkRegister == 1 ){
                               $errors[] = 'This UserName IS Existe';
                            }else{
                            //هنا انا بضيف بيانات في الداتا بيز حددت الحقول اللي هضيف فيها
                            $stmtRegister = $con->prepare("INSERT INTO  users(Username,  Pasword, Email, RegStatues , Date) 
                                                 VALUES(:auser, :apass, :aemail, 0 , now())");//وبعد كده حددت لكل حقل اسم عشان هستخدمه بعدكده
                            $stmtRegister-> execute (array( // هنا انا هضيف الداتا في الحقول عن طريق الاسامي اللي انا محددها 
                               'auser' => $username,
                               'apass' => sha1($pass),
                               'aemail' => $email
                            ));
                            $msg_succss = 'Register Done';
                            }
                        }
                        
                        
                    }
                }
                ?>

                <!-- Login Tab -->
                  <div class="login">
                      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='POST'>
                    <div class="form-group">
                      <label class="p-0">UserName</label>
                      <input type="text" name='user' class="form-control" id="lo-email" autocomplete="off">
                      <i class="fas fa-at ico"></i>
                      <p class="m-0 text-danger d-none lo-email"> Pleas Enter Your Email.</p>
                    </div>

                    <div class="form-group">
                      <label class="p-0">Password</label>
                      <input type="password" name='user-pass' class="form-control" id="lo-pass">
                      <i class="fas fa-unlock-alt ico"></i>
                      <p class="m-0 text-danger d-none lo-pass"> Pleas Enter Your password.</p>
                    </div>

                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="remember" style="
                      padding: 10px 25px">
                      <label class="custom-control-label" for="remember">Remember Me</label>
                    </div>

                    <button type="submit" name='login' class="btn btn-primary mt-4 rounded-0">Login</button>
                    </form>
                    </div>
                  
              </div>

              <!-- register -->
              <div class="tab-pane container fade" id="register">
             <?php 
             if(!empty($errors)){
                foreach($errors as $err){
                    echo '<div class="alert alert-danger">'. $err .'</div>';
                }
             }
             if(isset($msg_succss)){
                echo '<div class="alert alert-success">'. $msg_succss .'</div>';
             }
             ?>
                  <!-- Login Tab -->
                  <div class="register">
                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='POST'>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name='username' id="name" class="form-control" autocomplete="off">
                        <i class="far fa-user ico"></i>
                        <p class="m-0 text-danger d-none name"> Pleas Enter Your Name.</p>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name='email' id="email" class="form-control" autocomplete="off">
                        <i class="fas fa-at ico"></i>
                        <p class="m-0 text-danger d-none email"> Pleas Enter Your Email.</p>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name='pass' id="pass" class="form-control">
                        <i class="fas fa-unlock ico"></i>
                        <p class="m-0 text-danger d-none pass"> Pleas Enter Your Password.</p>
                    </div>
                    <div class="form-group">
                        <label for="">Re-Password</label>
                        <input type="password" name='re-pass' id="re-pass" class="form-control">
                        <i id="ico" class="fas fa-undo ico"></i>
                        <p class="m-0 text-danger d-none re-pass"> This Not Equal Password.</p>
                    </div>
                    <div class="m-or-f">
                        <div class="custom-control custom-radio custom-control-inline male">
                            <input type="radio" class="custom-control-input" id="maleRadio" name="radio">
                            <label class="custom-control-label" for="maleRadio">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline female">
                            <input type="radio" class="custom-control-input" id="femaleRadio" name="radio" value="Male">
                            <label class="custom-control-label" for="femaleRadio">Female</label>
                        </div>
                    </div>
                    <button type="submit" name='register' class="btn btn-danger mt-4 d-block rounded-0">Sign Up</button>
                    </form>
                </div>
              </div>
            </div>
        </div>  <!-- End Login And Register Tab-->    

    </div><!-- End First Header Row-->
</div><!-- End First Header-->
      
       <hr>
       
<!-- Second Header-->
<div class="second-header">
  <div class="row">

  <div class="col-lg-7 col-6">
   <div class="category-nav">
            
   <nav class="navbar navbar-expand-lg p-0 " data-toggle="collapse"
         data-target="#category">
       
        <button class="navbar-toggler" type="button" data-toggle="collapse"
         data-target="#category" aria-controls="navbarNav" aria-expanded="false"
         aria-label="Toggle navigation">
        <span class="fas fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-start" id="category">

        <ul class="navbar-nav categ-nav">
          <?php 
          $categorys = getAll('*','categorys','where parent = 0','','ID','ASC');
          foreach($categorys as $category): ?>
           <li class="nav-item">
               <a class="nav-link" href="category.php?pageid=<?php echo $category['ID'];?>&pagename=<?php echo str_replace(' ','-',$category['cat_name']);?>">
               <i class="fas fa-laptop categ-ico"></i> <?php echo $category['cat_name']; ?>
               </a>
           </li>
          <?php endforeach; ?>
      

       </ul>
       
       </div>
    </nav>

    </div>
   </div>

  <div class="col-lg-5 col-6">
  <div class="menu">
   <nav class="navbar navbar-expand-lg p-0 justify-content-end" data-target="#navbar" data-toggle="collapse">
       
    <button class="navbar-toggler" type="button" data-toggle="collapse"
     data-target="#navbar" aria-controls="navbarNav" aria-expanded="false"
     aria-label="Toggle navigation">
    <span class="fas fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbar">
       
        <ul class="navbar-nav ">
           <li class="nav-item">
               <a class="nav-link active" href="index.html" class="active">Home</a>
           </li>
           <li class="nav-item shop"  id="shop">
               <a class="nav-link" href="shop.php">shop</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="about.html">About us</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="contact.html">contact</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="faq.html">Faq</a>
           </li>
       </ul>
       
    </div>
   </nav>
   </div>
  </div>

 
 </div>       
</div><!-- End second Header-->
   
   </div>
</header>
<?php ob_end_flush(); ?>