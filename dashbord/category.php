<?php
$title = 'Category';
session_start();
if(isset($_SESSION['username'])){
   include 'init.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'Mange';

    if ($page == 'Mange') {
        $sort = "ASC";
        $sort_array = array("ASC","DESC");
        if(isset($_GET['sort'])&& in_array($_GET['sort'],$sort_array)){
            $sort = $_GET['sort'];
        }
        // $stmtCat = $con->prepare("SELECT * FROM categorys ORDER BY ordering $sort");
        // $stmtCat->execute();
        $cats = getAll("*","categorys","where parent = 0","","ordering",$sort);
        ?>
        
       <section class="category-mange">
           <div class="container">
           <h2 class='text-center py-4'>Mange Category</h2>
            <div class="card">
            <div class="card-header">
                <h5 class='float-left'><i class="fas fa-sitemap"></i> Category Mange</h5>
                <div class="float-right ordering">Ordaring:
                    <!-- Sorting Category -->
                    <a href="?sort=ASC" class='mx-2 <?php if($sort=='ASC'){echo 'active';} ?>'><i class="fas fa-sort-amount-up-alt"></i></a>
                    <a href="?sort=DESC" class='mx-2 <?php if($sort=='DESC'){echo 'active';} ?>'><i class="fas fa-sort-amount-down-alt"></i></a>
                </div>
            </div>
            <?php if(!empty($cats)): ?>
                <div class="card-body py-0">
                <ul class="list-group list-group-flush">
                <?php
                foreach($cats as $cat):
                ?>
                    <li class="list-group-item px-0 overflow-hidden">
                    
                    <!-- Category name -->
                    <h5 class="cat-name"><?php echo $cat['cat_name']; ?></h5>

                    <!-- For Sub Category -->
                    <ul class=' list-unstyled ml-5 mb-2'>
                    
                        <?php 
                            $subCategorys = getAll("*","categorys","where parent = {$cat['ID']}","","ID");
                            if(!empty($subCategorys)):
                        ?>
                        <h6 class='mt-2 p-0'><i class="fas fa-sitemap"></i> Sub Category</h6>
                        
                        <?php foreach($subCategorys as $subCat):?>
                            
                            
                            <li>
                            <a href='category.php?page=Edit&catID=<?php echo $subCat["ID"];?>' class='badge badge-secondary'>
                            <?php echo $subCat['cat_name']; ?> 
                            </a>
                            <a href='category.php?page=Delete&catID=<?php echo $subCat["ID"]; ?>'><i class="fas fa-trash"></i></a>
                            </li>
                            
                        <?php endforeach; endif;?>
                            
                    </ul>
                    <!-- End For Sub category -->


                    <!-- Description -->
                    <?php if($cat['cat_desc'] == ''): ?>
                    <span class='badge badge-primary'>Don't Have Description</span>
                    <?php else: ?>
                    <p class='m-0'> <?php echo $cat['cat_desc'];?> </p>
                    <?php endif; ?>

                    <!-- Visibel -->
                    <?php if($cat['cat_visibilty'] == 1): ?>
                    <!-- This is not Visibel -->
                    <span class='badge badge-secondary  mx-2'><i class="far fa-eye-slash"></i></span>
                    <?php endif; ?>

                    <!-- Allow comments -->
                    <?php if($cat['allow_comments'] == 1): ?>
                    <!-- Comment Disabel -->
                    <span class='badge badge-warning mx-2'><i class="fas fa-comment-slash"></i></span>
                    <?php endif; ?>

                    <!-- Allow Ads -->
                    <?php if($cat['allow_ads'] == 1): ?>
                    <!-- Ads Disabel -->
                    <span class='badge badge-danger mx-2'>Ads Disabel</span>
                    <?php endif; ?>

                    
                    <div class="edi-del float-right position-relative">
                    <a href='category.php?page=Edit&catID=<?php echo $cat["ID"]; ?>' class="badge badge-info px-3 py-2">Edit</a>
                    <a href='category.php?page=Delete&catID=<?php echo $cat["ID"]; ?>' class="badge badge-danger px-3 py-2">Delete</a>
                    </div>
                    </li>
                <?php endforeach; ?>
                </ul>
                </div>
            <?php else: alert('No Categorys');?>
            <a class='btn btn-primary mt-3' href="category.php?page=Add">
            <i class="fas fa-plus-circle mr-3"></i>Add New Category
            </a>
             <?php endif;?>
            </div>
            <!-- Add new Category -->
            <a class='btn btn-primary mt-3' href="category.php?page=Add">
            <i class="fas fa-plus-circle mr-3"></i>Add New Category
            </a>
           </div>
       </section>

   <?php }elseif($page == 'Add'){?>
    <section class="add-category">
    <div class="container">
    <h2 class='text-center py-3'>Add New Category</h2>
<!-- Add Form -->
    <form class="form-horizontal" action="?page=Insert" method='POST'>
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <div class="col-sm-10">
        <input type="text" class="form-control"  name='cat-name' id="name" require='require'>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" >Parent:</label>
        <div class="col-sm-10">
        <select name="parent" id="">
            <option value="0">None</option>
            <?php
            $categorys = getAll('*','categorys','where parent = 0','','ID','ASC');
            foreach($categorys as $category):
            ?>
            <option value="<?php echo $category['ID'] ?>"><?php echo $category['cat_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="disc">Description:</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name='cat-disc' id="disc">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" >Ordering:</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name='cat-ordering'>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-4">
            <div class="form-check ml-3">
                <label class="form-check-label"> Visibilty</label>
                <div class="vis-yes">
                <input type="radio" class="form-check-input" name="vis" value='0' checked> Yes
                </div>
                <div class="vis-no">
                <input type="radio" class="form-check-input" name="vis" value='1'> No
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check ml-3">
                <label class="form-check-label"> Allow Comments</label>
                <div class="com-yes">
                <input type="radio" class="form-check-input" name="com" value='0' checked> Yes
                </div>
                <div class="com-no">
                <input type="radio" class="form-check-input" name="com" value='1'> No
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check ml-3">
                <label class="form-check-label"> Allow Ads</label>
                <div class="ads-yes">
                <input type="radio" class="form-check-input" name="ads" value='0' checked> Yes
                </div>
                <div class="ads-no">
                <input type="radio" class="form-check-input" name="ads" value='1'> No
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 pt-3">
        <button type="submit" class="btn btn-info">Add New Category</button>
        </div>
    </div>
    </form>
    </div>
    </section>
    <?php
    }elseif($page == 'Insert'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $cat_name = $_POST['cat-name'];
            $cat_parent = $_POST['parent'];
            $cat_disc = $_POST['cat-disc'];
            $cat_ordering = $_POST['cat-ordering'];
            $cat_vis = $_POST['vis'];
            $allow_com = $_POST['com'];
            $allow_ads = $_POST['ads'];
            
            if(!empty($cat_name)){
               $checkAddCat = checkItems('cat_name','categorys', $cat_name); 
               if($checkAddCat == 1 ){
                  redirectFunc('This Category IS Existe','category.php?page=Add',2,'danger');
               }else{
              
               $stmt = $con->prepare("INSERT INTO  categorys(cat_name, parent , cat_desc, ordering, cat_visibilty, allow_comments , allow_ads) 
                                      VALUES(:cname, :cparent ,:cdesc, :cordering, :cvis, :calwcom , :calwads)");
               $stmt-> execute (array(
                  'cname' => $cat_name,
                  'cparent' => $cat_parent,
                  'cdesc' => $cat_disc,
                  'cordering' => $cat_ordering,
                  'cvis' => $cat_vis,
                  'calwcom' => $allow_com,
                  'calwads' => $allow_ads,
                  
                  
               ));
               redirectFunc('Add Category Done','category.php',2,'success');
                }
            }
        }else{redirectFunc('You Cant Browes Tis Page Directly','category.php?page=Add',2,'danger');}
            

    }elseif($page == 'Edit'){
        echo "<h2 class='text-center py-3'>Edit Category</h2>";
       
       $catID = isset($_GET['catID'])&& is_numeric($_GET['catID']) ? intval($_GET['catID']) : 0;
       
       $stmt = $con->prepare("SELECT * FROM categorys WHERE ID = ? ");
       $stmt->execute(array($catID));
       $cat = $stmt->fetch();
       $count = $stmt->rowCount();
       if($count > 0){?>

<!-- Edit Form -->
<section class="edit-cat">
    <div class="container">
<form class="form-horizontal" action="?page=Update" method='POST'>
        <input type="hidden" name='cat-ID' value='<?php echo $cat['ID'] ?>'>
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <div class="col-sm-10">
        <input type="text" class="form-control"  name='cat-name' id="name" value="<?php echo $cat['cat_name'] ?>" require='require'>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" >Parent:</label>
        <div class="col-sm-10">
        <select name="parent" id="">
            <option value="0">None</option>
            <?php
            $categorys = getAll('*','categorys','where parent = 0','','ID','ASC');
            foreach($categorys as $category):
            ?>
            <option value="<?php echo $category['ID'] ?>" <?php if($cat['parent'] == $category['ID']){echo 'selected';}?>>
            <?php echo $category['cat_name'] ?>
            </option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="disc">Description:</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name='cat-disc' id="disc" value="<?php echo $cat['cat_desc'] ?>" >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" >Ordering:</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name='cat-ordering' value="<?php echo $cat['ordering'] ?>" >
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-check ml-3">
                <label class="form-check-label"> Visibilty</label>
                <div class="vis-yes">
                <input type="radio" class="form-check-input" name="vis" value='0' <?php if($cat['cat_visibilty'] == 0){echo 'checked'; }?>> Yes
                </div>
                <div class="vis-no">
                <input type="radio" class="form-check-input" name="vis" value='1' <?php if($cat['cat_visibilty'] == 1){echo 'checked'; }?>> No
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check ml-3">
                <label class="form-check-label"> Allow Comments</label>
                <div class="com-yes">
                <input type="radio" class="form-check-input" name="com" value='0' <?php if($cat['allow_comments'] == 0){echo 'checked'; }?>> Yes
                </div>
                <div class="com-no">
                <input type="radio" class="form-check-input" name="com" value='1' <?php if($cat['allow_comments'] == 1){echo 'checked'; }?>> No
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check ml-3">
                <label class="form-check-label"> Allow Ads</label>
                <div class="ads-yes">
                <input type="radio" class="form-check-input" name="ads" value='0' <?php if($cat['allow_ads'] == 0){echo 'checked'; }?>> Yes
                </div>
                <div class="ads-no">
                <input type="radio" class="form-check-input" name="ads" value='1' <?php if($cat['allow_ads'] == 1){echo 'checked'; }?>> No
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 pt-3">
        <button type="submit" class="btn btn-info">Update Category</button>
        </div>
    </div>
    </form>
    </div>
</section>

       <?php }else {redirectFunc("Cant Fiend this Category",'category.php',2);}
   }elseif($page == 'Update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cat_ID = $_POST['cat-ID'];
        $cat_name = $_POST['cat-name'];
        $cat_parent = $_POST['parent'];
        $cat_disc = $_POST['cat-disc'];
        $cat_ordering = $_POST['cat-ordering'];
        $cat_vis = $_POST['vis'];
        $allow_com = $_POST['com'];
        $allow_ads = $_POST['ads'];
        
        if(!empty($cat_name)){
            $catUpdate = $con->prepare("UPDATE  categorys SET cat_name = ?, parent = ? , cat_desc = ?, ordering = ?, cat_visibilty = ?, allow_comments = ?, allow_ads = ? WHERE ID = ?");
            $catUpdate->execute(array($cat_name, $cat_parent , $cat_disc, $cat_ordering, $cat_vis, $allow_com, $allow_ads, $cat_ID));
            redirectFunc('Updating Member Done','category.php',3,'success');
            
        }else{ redirectFunc("Category Name Is Empty",'category.php?page=Edit&catID='. $cat_ID,2); }
    }

    }elseif($page == 'Delete'){
        $catDelete = isset($_GET['catID'])&& is_numeric($_GET['catID']) ? intval($_GET['catID']) : 0;
      /**
       * هنا انا بقوله جيبلي الجدول بتاع اليوزر ده عن  طريق الايدي بتاعه
       */
      // $stmt = $con->prepare("SELECT * FROM categorys WHERE ID = ? LIMIT 1");
      // $stmt->execute(array($catDelet));
      // $count = $stmt->rowCount();
      $checkDelet = checkItems('ID','categorys',$catDelete);//بنتعمل نفس اللي انا عاملها كومنت فوق دي 
      if($checkDelet > 0){ //هنا بقا  بشوف هل الداتابيز فيه الريكورد ده فعلا ولا لا عشان لو موجود ينفذ
         /*
         *هنا انا بعمل استعلام بيحذف اليوزر من الداتابيز ولو الجروب اي دي يساوي واحد مش هنفذ الاستعلام
         */
         $stmt = $con->prepare("DELETE FROM categorys WHERE ID = :catid LIMIT 1");
         $stmt->execute(array('catid'=>$catDelete));
         /*ممكن استخدم دي بدل اللب فوق عادي
         $stmt->bindParam(":id",$user);
         $stmt->execute();
         */
        redirectFunc('Deleting Category Done','category.php',2,'success');
   }else{ redirectFunc('Cant Finde Any Category','category.php',4); }
    }

  include $tpl . 'footer.php';
}else{
   header('Location: index.php');
   exit();
}