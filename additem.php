<!-- هنا لو مفيش سيشن متسجل مش هيدخلني علي الصفحه دي و هيحولني علي الاندكس -->
<?php ob_start();?>
  <?php 
  $title = 'Add Item';
   include 'init.php'; 
   if(isset($_SESSION['user'])):


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $error = array();

        $itemN  = filter_var($_POST['adname'], FILTER_SANITIZE_STRING);
        $itemD  = filter_var($_POST['ad-disc'], FILTER_SANITIZE_STRING);
        $itemP  = filter_var($_POST['adprice'], FILTER_SANITIZE_NUMBER_INT);
        $itemC  = filter_var($_POST['adcountry'], FILTER_SANITIZE_STRING);
        $itemS  = filter_var($_POST['adstatus'], FILTER_SANITIZE_NUMBER_INT);
        $catID  = filter_var($_POST['adcat-id'], FILTER_SANITIZE_NUMBER_INT);
        $tags  = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);

        if(empty($itemN)){$error[]='Item Name IS Empty';}
        if(strlen($itemN) < 6){$error[]='Pleas Must be Item name More Than 6 letters';}
        if(empty($itemP)){$error[]='Pleas Add Price';}
        if(strlen($itemD) < 6){$error[]='Pleas Must be Item Discription More Than 6 letters';}
        if(strlen($itemC) < 2 && empty($itemCountry)){$error[]='Pleas Add Right Country';}
        if(empty($itemS)){$error[]='Pleas Add Status';}
        if(empty($catID)){$error[]='Pleas Add Category';}
        
        if(!empty($error)){
            foreach($error as $err){
                echo '<div class="alert alert-danger">'. $err .'</div>';
            }
        }
        if(isset($successMsg)){
            echo '<div class="alert alert-success">'. $successMsg .'</div>';
        }

        if(empty($error)){
            $stmtItemAdd = $con->prepare("INSERT INTO 
                            items(item_name,  item_disc, item_price,
                                     country_made, `status` , add_date,
                                      cat_ID, member_ID, tags) 
                            VALUES(:itname, :itdisc, :itprice,
                                     :itcountry, :itstatus , now(),
                                      :itcatID, :itmemberID, :ittags)
                                ");
            $stmtItemAdd-> execute (array( 
            'itname'    => $itemN,
            'itdisc'    => $itemD,
            'itprice'   => $itemP,
            'itcountry' => $itemC,
            'itstatus'  => $itemS,
            'itcatID'   => $catID,
            'itmemberID' => $_SESSION['uID'],
            'ittags'    => $tags
            ));
            if($stmtItemAdd){
                $successMsg = 'Add Item Done';
            }
        }
        
    }
 ?>

<section class="add-items">
        <div class="container">
        <h2 class='text-center py-4'>Add New Item</h2>
        <?php
        
        ?>
            <!-- Add Form -->
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Item Name:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='adname' id="name" require='require'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="disc"> Discription:</label>
                    <div class="col-sm-10">
                    <textarea name='add-disc' id="disc" require='require' class="form-control"  rows="4"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="price">Price:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='adprice' id="price" require='require'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cun">Conutry Made:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='adcountry' id="cun">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="">Status:</label>
                    <div class="col-sm-10">
                    <select class="form-control" name='adstatus'>
                        <option value = '0'>.   .   .</option>
                        <option value = '1'>New</option>
                        <option value = '2'>Like New</option>
                        <option value = '3'>Used</option>
                        <option value = '4'>Very Old</option>
                    </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="">Category:</label>
                    <div class="col-sm-10">
                    <select class="form-control" name='adcat-id'>
                        <option value = '0'>.   .   .</option>
                        <?php
                        // $stmtCat = $con->prepare("SELECT * FROM categorys");
                        // $stmtCat->execute();
                        $cats = getAll('*','categorys','','','ID','ASC');
                        foreach($cats as $cat):
                        ?>
                        <option value = '<?php echo $cat['ID']; ?>'><?php echo $cat['cat_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="tags">Tags:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='tags' id="tags">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type='submit' value='Add'>
                    <!-- <button type="submit" class="btn btn-info">Add New Item</button> -->
                    </div>
                </div>
            </form>
            </div>
    </section>


<?php else: header('location:index.php'); exit();
        endif; 
 ?>
<?php    include  $tpl . 'footer.php';  ?>
<?php ob_end_flush(); ?>