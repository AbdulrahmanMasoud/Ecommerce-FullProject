<?php 
$title = 'Tags';
include 'init.php'; 


if(isset($_GET['tagname'])):
 ?>
<!-- start Category section  -->
<section class="category-page">
<!-- start page baner section  -->
<section class="page-baner">
    <div class="container">
        <div class="page-baner-content text-center">
            <h5><?php echo $_GET['tagname'];?></h5>
            <div class="baner-link">
                <span ><a href="index.php">Home / </a></span>
                <span ><a href=""><?php echo $_GET['tagname'];?></a></span>
            </div>
        </div>
    </div>
</section>


<section class="items">
    <div class="container">
        <div class="row">
            
    <?php 

    $tag =$_GET['tagname'];
    $tagsItems = getAll("*","items","where tags like '%$tag%'","and approve = 1","item_ID");
    foreach($tagsItems as $item):
    ?>
    <div class="col-lg-3 col-md-6 col-12">
    <div class="item">
        <figure class="prodact">
            <div class="prodact-img">
            <img src="https://picsum.photos/id/1/300/300" alt="" class="img-fluid">
            </div>
            <figcaption class="p-2 py-3">
                <div class="prodact-name">
                    <h5 class=" m-0">
                        <a href="item.php?item=<?php echo $item['item_ID'];?>">
                        <?php echo $item['item_name']; ?>
                        </a>
                    </h5>
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
                <a href="item.php?item=<?php echo $item['item_ID'];?>">
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
    </div>
<?php endforeach; ?>
     </div>
    </div>
</section>

</section><!-- End Categoy section  -->
    <?php else: echo 'Cant Find This page'; endif; ?>
<?php include  $tpl . 'footer.php';?>
            