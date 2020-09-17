<?php ob_start();?>
  <?php 
  $title = 'Item';
   include 'init.php'; 

   $itemID = isset($_GET['item'])&& is_numeric($_GET['item']) ? intval($_GET['item']) : 0;
    $stmtItem = $con->prepare("SELECT items.*,categorys.cat_name,users.Username
                                FROM items 
                                INNER JOIN categorys ON categorys.ID = items.cat_ID
                                INNER JOIN users ON users.UserID = items.member_ID
                                WHERE item_ID = ? AND approve = 1");
    $stmtItem->execute(array($itemID));
    $item = $stmtItem->fetch();
    $count = $stmtItem->rowCount();
       if($count > 0):
?>

<!-- start singel product section -->
<section class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="prodact-imgs text-center pb-4">
                    <div class="top-img py-4">
                        <img src="layout/img/spical-offer/2.jpg" alt="" class="img-fluid top-img">
                    </div>
                    <div class="imgs">
                        <ul class="list-group list-group-horizontal justify-content-center">
                            <li class="list-group-item ">
                                <img src="layout/img/spical-offer/1.jpg" alt="" class="img-fluid small-img">
                            </li>
                            <li class="list-group-item">
                                <img src="layout/img/spical-offer/2.jpg" alt="" class="img-fluid small-img">
                            </li>
                            <li class="list-group-item">
                                <img src="layout/img/spical-offer/3.jpg" alt="" class="img-fluid small-img">
                            </li>
                            <li class="list-group-item">
                                <img src="layout/img/spical-offer/2.png" alt="" class="img-fluid small-img">
                            </li>
                         </ul>
                    </div>
                </div>
                <div class="comments" >
                    <div class="card bg-light mb-3" >
                    <div class="card-header h5">Comments</div>
                    <div class="card-body" style="overflow-y: scroll;max-height: 225px;">
            <?php 
                $stmtComm = $con->prepare("SELECT comments.*,users.Username 
                                            FROM comments
                                            INNER JOIN users ON users.UserID = comments.user_id
                                            WHERE item_id = ? AND `status` = 1 
                                            ORDER BY c_id DESC");
                $stmtComm->execute(array($item['item_ID']));
                $comments = $stmtComm->fetchAll();
                $countComm = $stmtComm->rowCount();
                if($countComm > 0):
                foreach($comments as $comment):

            ?>
                    <div class="card bg-light mb-3" >
                    <div class="card-header"><?php echo $comment['Username'] ?></div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $comment['comment'] ?></p>
                    </div>
                    </div>
                <?php endforeach; ?>
                <?php else: echo 'No Comments'; endif; ?>

                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="product-details">
                    <div class="prod-name">
                        <h5><?php echo $item['item_name']; ?></h5>
                    </div>
                    <div class="prod-rate">
                                  
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                         
                     </div>
                    <div class="prod-price">
                        <p>$<?php echo $item['item_price']; ?></p>
                    </div>
                    <hr>
                    <div class="prod-description">
                        <h6>DESCRIPTION</h6>
                        <p><?php echo $item['item_disc']; ?>
                        </p>
                    </div>
                    <hr>
                    <div class="prod-information">
                        <h6>ADDITIONAL INFORMATION</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="color">
                                Color: <span>Red</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="size">
                                Tags: <span>
                                <?php 
                                 $allTags = explode(',',$item['tags']);
                                 foreach($allTags as $tag):
                                    $tag = str_replace(' ','',$tag);
                                    $tag = strtolower($tag);
                                    if(!empty($tag)):
                                ?>
                                <a href="tags.php?tagname=<?php echo $tag; ?>" class='badge badge-info'>
                                    <?php echo $tag; ?>
                                </a>
                                <?php endif; endforeach; ?>
                                </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="prod-brand">
                                Brand: <span>
                                        <a href="category.php?pageid=<?php echo $item['cat_ID']; ?>&pagename=<?php echo $item['cat_name']; ?>">
                                            <?php echo $item['cat_name']; ?>
                                        </a>
                                        </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="author">
                                Author: <span><a href=""><?php echo $item['Username']; ?></a></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="status">
                                Status: <span>New</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="country">
                                Country: <span>Egypt</span>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <hr>
                    <div class="prod-action text-center py-3">
                        <div class="row">
                            <div class="col-3">
                                <div class="quant">
                                    <input id="jq-quant" class="jq-quant form-control h-auto px-2 p-0 shadow-none" type="text" value="1">
                                    <div class="qunt-action">
                                        <span id="plus">+</span>
                                        <span id="sub">-</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5 ">
                                <a class='buy' href="">Buy Now</a>
                            </div>
                            <div class="col-2">
                                <a href="">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="col-2">
                                <a href="">
                                    <i class="far fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="add-review">
                        <?php if(isset($_SESSION['user'])): ?>
                            <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#myModal">
                        <i class="fas fa-plus-square"></i> Add Comment Review
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Add Comment</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <?php 
                                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                                    $userid = $_SESSION['uid'];
                                    $itemid = $item['item_ID'];

                                    if(!empty($comment)){
                                        $stmtAddCom = $con->prepare("INSERT INTO commevnts(comment,`status`,c_date,item_id,`user_id`) 
                                        VALUES(:comment,0,now(),:itemid,:userid");
                                        $stmtAddCom->execute(array(
                                            'comment'=>$comment,
                                            'itemid'=>$itemid,
                                            'userid'=>$userid
                                        ));
                                   echo 'done';
                                    }
                                }
                            
                            ?>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="<?php echo $_SERVER['PHP_SELF'] . '?item='.$item['item_ID']; ?>" method="POST">
                                    <div class="form-group">
                                        <label>Your Comment</label>
                                        <textarea class="form-control" name='comment' rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-plus-square mr-2"></i>Comment
                                    </button>
                                    </div>
                                </form>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php else: ?>
                            <button type="button" class="btn btn-secondary w-100" disabled>
                            <i class="fas fa-plus-square"></i> SignIn To Add Comment Review
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end singel product section -->






<!-- start related products section -->


<section class="related-products">
    <div class="container">
        <hr>
        <div class="related-products-title py-3">
            <h5>Related Products</h5>
        </div>

        <div class="related owl-carousel owl-theme">
            <?php
            
            // $stmtItems = $con->prepare("SELECT * FROM items WHERE approve !=0 ");
            // $stmtItems->execute();
            $Items = getAll('*','items','where approve = 1','','item_ID');
            ?>
        <?php foreach($Items as $Ritem):?>
        <div class="item">
            <figure class="prodact">
                <div class="prodact-img">
                    <img src="layout/img/home-prodacts/1.png" alt="" class="img-fluid">
                </div>
                <figcaption class="p-2 py-3">
                    <div class="prodact-name">
                        <h5 class=" m-0"><a href="item.php?item=<?php echo $Ritem['item_ID'];?>"><?php echo $Ritem['item_name']; ?></a></h5>
                    </div>
                    <!-- prodact-price -->
                    <div class="prodact-price">
                        <p class="m-0">$<?php echo $Ritem['item_price']; ?></p>
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
                    <a href="item.php?item=<?php echo $Ritem['item_ID'];?>">
                        <span data-toggle="tooltip" title="Quick View">
                        <i class="far fa-eye"></i>
                        </span>
                    </a>
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
        <?php endforeach; ?>
        

    </div>




    </div>
</section>


<!-- end related products section -->






<?php else:
        redirectFunc('No Item To Show','index.php',1,'warning ');
       endif;
 ?>



<?php    include  $tpl . 'footer.php';  ?>
<?php ob_end_flush(); ?>