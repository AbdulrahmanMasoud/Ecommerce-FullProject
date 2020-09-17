<!-- هنا لو مفيش سيشن متسجل مش هيدخلني علي الصفحه دي و هيحولني علي الاندكس -->
<?php ob_start();//if(isset($_SESSION['user'])):?>
  <?php 
  //session_start();
  $title = 'Profila';
   include 'init.php'; 
   if(isset($_SESSION['user'])):
 ?>
<link rel="stylesheet" href="<?php echo $css ?>profile.css">

<?php
$userData = $con->prepare("SELECT * FROM users WHERE Username = ?");
$userData->execute(array($_SESSION['user']));
$data = $userData->fetch(); //fetch دي بتجيب الداتا بتاعه الرو اللي انا محدده بس 
?>
<section class="profile">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item py-4 text-center">
                        <div class="profile-img">
                            <img src="layout/img/about-page/person1.jpg" alt="" class="mx-auto d-block img-fluid rounded-circle">
                        </div>
                        <div class="profile-name pt-2">
                            <h6 class="m-0"><?php echo $data['FullName']; ?></h6>
                        </div>
                    </li>
                    <li class="list-group-item text-center py-4 mt-2">
                        <div class="need-hellp">
                            <div class="hellp-icon">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <div class="hellp-content">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                            <div class="hellp-btn">
                                <a href="./faq.html" class="btn btn-info">Need Hellp?</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-9 p-0">
                <div class="personal-information p-2">
                    <div class="personal-title py-2">
                        <h5 class="m-0">Personal Information</h5>
                    </div>
                    <div class="personal-content position-relative">
                        <span class="  position-absolute edit" >
                            <i class="far fa-edit position-absolute edit"></i>
                        </span>
                            <div class="row">
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="usr">Name:</label>
                                        <input type="text" class="form-control" value="<?php echo $data['FullName']; ?>" disabled >
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="usr">Email:</label>
                                        <input type="email" class="form-control" value="<?php echo $data['Email']; ?>" disabled >
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="usr">Phone:</label>
                                        <input type="text" class="form-control" value="+201012895020" disabled >
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="usr">Password:</label>
                                        <input type="password" class="form-control" value="<?php echo $data['Pasword']; ?>" disabled >
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="action pt-3">
                                        <div class="row">
                                            <div class="col-6">
                                            <button class="btn btn-info d-none save" >save</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                    </div>
                </div>
                <hr>
                <!-- Items -->
                <div class="address position-relative p-2">
                    <!-- addresses modal -->
                    <div class="address-modal">
                        <div class="modal" id="add-new-address">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                <!-- Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Item</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <!-- body -->
                                <div class="modal-body">
                                    Modal body..
                                </div>
                                
                                
                                </div>
                            </div>
                            </div>                                            
                    </div>

                    <div class="address-title py-2">
                        <h5 class="m-0">Items</h5>
                    </div>
                    <div class="action position-absolute">
                        <span class=" new-address" data-toggle="modal" data-target="#add-new-address">
                            <i class="fas fa-plus-circle"></i>
                        </sapn>
                    </div>
                    <!--All addresses  -->
                     <div class="items">
                    <div class="container">
                        <div class="row">

                    <?php 
                        // getItems('member_ID',$data['UserID'])
                    $userItems = getAll("*","items","where member_ID = {$data['UserID']}","","item_ID");
                    foreach($userItems as $item):
                    ?>
                    <div class="col-lg-3 col-md-6 col-12">
                    <div class="item border">
                        <figure class="prodact">
                            <?php
                            if($item['approve'] == 0):
                            ?>
                            <span class='badge badge-danger position-absolute mt-2 rounded-0'>Not Activat</span>
                            <?php endif; ?>
                            <div class="prodact-img">
                            <img src="https://picsum.photos/id/1/300/300" alt="" class="img-fluid">
                            </div>
                            <figcaption class="p-2 py-3">
                                <div class="prodact-name">
                                    <h5 class=" m-0"><a href="item.php?item=<?php echo $item['item_ID'];?>"><?php echo $item['item_name']; ?></a></h5>
                                </div>
                            <!-- prodact-price -->
                                <div class="prodact-price">
                                    <p class="m-0">$<?php echo $item['item_price']; ?></p>
                                </div>
                            <!-- prodact-rate -->
                                <div class="prodact-rate">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            <!-- prodact-action -->
                                <div class="prodact-action justify-content-end">
                                    <span data-toggle="tooltip" title="Quick View">
                                        <i class="far fa-eye"></i>
                                    </span>
                                    <span data-toggle="tooltip" title="Add to WishList">
                                        <i class="far fa-heart"></i>
                                    </span>
                                    <span data-toggle="tooltip" title="Add To Cart">
                                        <i class="fas fa-shopping-cart ico"></i>
                                    </span>
                                </div> 
                            </figcaption>
                        </figure>
                    </div>
                    </div>
                <?php endforeach; ?>
                    </div>
                    </div>
                </div>
                </div>


 <!-- Comments --><hr>
                <div class="address position-relative p-2">
                     <div class="address-title py-2">
                        <h5 class="m-0">Comments</h5>
                    </div>


                    <?php
        $stmtComm = $con->prepare("SELECT comments.*, items.item_name
                                     FROM comments
                                     INNER JOIN items ON items.item_ID = comments.item_id
                                     WHERE user_id = ?");
        $stmtComm->execute(array($data['UserID']));
        $comments = $stmtComm->fetchAll(); 

        if(!empty($comments)):
            foreach($comments as $comment):
           ?>
           <div class="card bg-light mb-3">
            <div class="card-header h6">
                <span class="badge badge-info">Item: </span>
                <?php echo $comment['item_name']; ?>
            </div>
            <div class="card-body">
                <p class="card-text"><?php echo $comment['comment']; ?></p>
            </div>
            </div>


            <?php endforeach;  ?>
            <?php else: echo 'No Comments'; endif; ?>

                </div>
            </div>
        </div>

    </div>
</section>

<?php else: header('location:index.php'); exit();
        endif; 
 ?>
<?php    include  $tpl . 'footer.php';  ?>
<?php ob_end_flush(); ?>