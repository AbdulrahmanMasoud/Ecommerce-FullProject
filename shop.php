<?php ob_start();?>
  <?php 
  $title = 'Shop';
   include 'init.php'; 
   ?>



<!-- start page baner section  -->
<section class="page-baner">
    <div class="container">
        <div class="page-baner-content text-center">
            <h5>Shop With Us</h5>
            <div class="baner-link">
                <span ><a href="">Home / </a></span>
                <span ><a href=""><?php echo $title; ?></a></span>
            </div>
        </div>
    </div>
</section>
<!-- end page baner section  -->


<!-- start shop section  -->

<section class="shop">
    <div class="container">
        <div class="row">
            <div class="filter-icon d-md-none d-sm-block">
                <i class="fas fa-filter filter"></i>
            </div>
            <div class="col-3 d-none d-md-block" id="aside">
                <aside class="filter pt-2 ">
                    <!-- filter by category -->
                    <div class="filter-category">
                        <div class="panel-group" id="filter-category">
                        <div class="panel panel-default">
                            <div class="panel-heading py-2 px-1" >
                                    <a class="" data-toggle="collapse" data-parent="#filter-category" href="#collapse1" >Filter By Category</a>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in show">
                              <div class="panel-body pt-2">
                                <div class="list-group categorys">
                                    <?php 
                                    $cats =  getAll('*','categorys','','','ID','ASC');
                                    foreach($cats as $cat):
                                    ?>
                                    <a href="" class="py-1">
                                        <i class="fas fa-mobile-alt categ-ico"></i> <?php echo $cat['cat_name'];?>
                                    </a>
                                    <?php endforeach; ?>
                                </div>
                              </div>
                            </div>
                        </div>
                        </div>
                        <hr>
                    </div>

                    <!-- filter by price -->
                    <div class="filter-price">

                        <div class="panel-group" id="filter-price">
                            <div class="panel panel-default">
                                <div class="panel-heading py-2 px-1" >
                                    <a class="" data-toggle="collapse" data-parent="#filter-price" href="#collapse2">Filter By Price</a>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse in show">
                                  <div class="panel-body pt-2">
                                    <div class="fil-price mt-4">
                                        <input type="range" min="1" max="5000" value="0" class="price" id="myRange">
                                        <p class="mt-4 m-0">Price $0 : $<span id="price"></span></p>
                                        <button class="mt-3">Filter</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            </div><hr>

                    </div>

                    <!-- filter by color -->
                    <div class="filter-color">

                        <div class="panel-group" id="filter-color">
                            <div class="panel panel-default">
                                <div class="panel-heading py-2 px-1" >
                                    <a class="" data-toggle="collapse" data-parent="#filter-color" href="#collapse3">Filter By Color</a>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse in show">
                                  <div class="panel-body pt-2">
                                    <ul class="list-group list-unstyled">
                                        <div class="row pl-3">
                                            <div class="col-3 p-0"><li class="active" style="background-color: rgb(130, 121, 255);">
                                                <a href="#" class=" "></a></li>
                                            </div>
                                            <div class="col-3 p-0"><li style="background-color: rgb(225, 0, 255);">
                                                <a href="#" class=" "></a></li>
                                            </div>
                                            <div class="col-3 p-0"><li style="background-color: rgb(0, 161, 8);">
                                                <a href="#" class=" "></a></li>
                                            </div>
                                            <div class="col-3 p-0"><li style="background-color: rgb(199, 0, 0);">
                                                <a href="#" class=" "></a></li>
                                            </div>
                                            <div class="col-3 p-0"><li style="background-color: rgb(236, 72, 99);">
                                                <a href="#" class=" "></a></li>
                                            </div>
                                            <div class="col-3 p-0"><li style="background-color: rgb(0, 183, 255);">
                                                <a href="#" class=" "></a></li>
                                            </div>
                                            <div class="col-3 p-0"><li style="background-color: rgb(0, 0, 0);">
                                                <a href="#" class=" "></a></li>
                                            </div>
                                            <div class="col-3 p-0"><li style="background-color: rgb(208, 255, 0);">
                                                <a href="#" class=" "></a></li>
                                            </div>
                                        </div>
                                    </ul>
                                  </div>
                                </div>
                            </div>
                            </div>
                            <hr>

                    </div>

                    <!-- filter by brand -->
                    <div class="filter-brand">
                        <div class="panel-group" id="filter-brand">
                            <div class="panel panel-default">
                                <div class="panel-heading py-2 px-1" >
                                    <a class="" data-toggle="collapse" data-parent="#filter-brand" href="#collapse4">Filter By Brand</a>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse in show">
                                  <div class="panel-body pt-2">
                                    <div class="list-group">
                                        <a href="#" class="">Appel</a>
                                        <a href="#" class="">Nokia</a>
                                        <a href="#" class="">Sony</a>
                                        <a href="#" class="">Samsung</a>
                                        <a href="#" class="">Huawei</a>
                                        <a href="#" class="">Toshiba</a>
                                        <a href="#" class="">Dell</a>
                                        <a href="#" class="">Hp</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            </div>
                            <hr>
                    </div>

                    <!-- filter by tag -->
                    <!-- <div class="filter-tag"></div> -->

                    <!-- filter by on sale -->
                    <div class="filter-on-sale">

                        <div class="panel-group" id="filter-on-sale">
                            <div class="panel panel-default">
                                <div class="panel-heading py-2 px-1" >
                                    <a class="" data-toggle="collapse" data-parent="#filter-on-sale" href="#collapse5">Filter On Sale</a>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse in show">
                                  <div class="panel-body pt-2">
                                    <?php 
                                    
                                    $on_sell = getLatest('*','items','item_ID',3);
                                    foreach($on_sell as $onItem):
                                    ?>
                                    <div class="asid-sele my-3">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="asid-sele-img pt-2">
                                                    <img src="layout/img/top-category/5.png" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="asid-sele-content pt-2">
                                                    <h5 class=" m-0">
                                                    <a href="item.php?item=<?php echo $onItem['item_ID'];?>"><?php echo $onItem['item_name']; ?></a>
                                                    </h5>
                                                    <p class="m-0">
                                                        <span>$<?php echo $onItem['item_price'];?></span>
                                                        <span><s>$119.00</s></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                    <?php endforeach; ?>
                                     
                                  </div>
                                </div>
                            </div>
                        </div>
                        

                    </div>

                </aside>
            </div>
            <!-- shop-items section -->
            <div class="col-md-9 col-sm-12" id="full-page">
            <div class="shop-items">
                    <div class="shop-bar py-2">
                      <ul class="list-group list-group-horizontal list-unstyled">  
                        <li class="">  
                        <div class="shop-tab">
                            <i class="fas fa-th-large mx-2 tab-icon active"></i>
                            <i class="fas fa-bars mx-2 tab-icon"></i>
                        </div>
                        </li>
                        <!-- <li class="mx-4  line .d-md-none" ></li> -->
                        <li class="mx-3 "> 
                        <div class="shop-sort">
                            <label for="">Sort By</label>
                            <select name="select" >
                                <option value="">- - - -</option>
                                <option value="">Price: Lowest first</option>
                                <option value="">Price: Highest first</option>
                                <option value="">Product Name: A to Z</option>
                                <option value="">Product Name: Z to A</option>
                                <option value="">In stock</option>
                                <option value="">Reference: Lowest first</option>
                                <option value="">Reference: Highest first</option>
                            </select>
                        </div>
                        </li>
                       
                        <li class=""> 
                        <div class="shop-items-count">
                            <label for="">Show</label>
                            <select name="select">
                                <option value="" >10</option>
                                <option value="">20</option>
                                <option value="">30</option>
                                <option value="">40</option>
                            </select>
                        </div>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="items">
                    <div class="row">
                    <?php 
                        $allItems = getAll('*','items','where approve = 1','','item_ID','DESC');
                        foreach($allItems as $item):
                    ?>
                        <!-- item  -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="item">
                                <figure class="prodact">
                                    <div class="prodact-img">
                                        <img src="layout/img/home-prodacts/1.png" alt="" class="img-fluid">
                                    </div>
                                    <figcaption class="p-2 py-3">
                                        <div class="prodact-name">
                                            <h5 class=" m-0"><a href="item.php?item=<?php echo $item['item_ID'];?>"><?php echo $item['item_name']; ?></a> </h5>
                                        </div>
                                        <!-- prodact-price -->
                                        <div class="prodact-price">
                                            <p class="m-0">$<?php echo $item['item_price'];?></p>
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
            

               
            <nav aria-label="Page navigation example ">
                <ul class="pagination justify-content-center py-4 m-0">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-arrow-left"></i></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#"><i class="fas fa-arrow-right"></i></a>
                    </li>
                </ul>
            </nav>
            </div>


            </div>
        </div>
    </div>
</section>


<!-- end shop section  -->
<?php    include  $tpl . 'footer.php';  ?>
<?php ob_end_flush(); ?>