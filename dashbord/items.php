<?php
$title = 'Items';
session_start();
if(isset($_SESSION['username'])){
   include 'init.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'Mange';

    if ($page == 'Mange'){
        $approve = '';
        // if(isset($_GET['action']) && $_GET['action'] == 'Approve'){
        //     /**
        //      * دي عشان يجيب الاعضاء اللي مش متفعله انا عملت متغير شتيل قيمه فاضيه
        //      * ولما لاقي ان هو داخل عن طريق ريكوست معين اللي هو اكشن يساوي بنددنج
        //      * هيغير المتغير الفاضي ده ويحط فيه الاستعلام بتاع الاعضاء اللي مش مفعله
        //      * لو مش جاي عن طريق الاكشن بندنج مش هيعمل اي حاجه وهيكمل عادي
        //      */
        //     $approve = 'AND approve = 0';
        // }

        /**
         * الاستعلام ده تبع العلاقات و هستعمل فيه Join
         * اول حاجه انا عملت سليكت علي جدول الايتمز كله وبعدين عملت سليكت علي الكاتيجوري وحددت منه اسم الكاتيجوري
         * وبعدين حددت جدول اليوزرز وحددت منه اليوزر نيم
         * وبعدين قولتله يجيب الكلام ده من جدول الايتمز
         * وبعدين يعمل جوين علي جدول الكاتيجوري عشان يجيب الكاتيجوري نيم ويقوله اون عشان يحدد هيجيبه بناء علي ايه
         *  ف انا هنا قولتله هاتلي الكاتيجوري نيم بس  اللي الكاتيجوري اي دي  يساوي الكات اي دي اللي في جدول الايتمز
         *نفس الحواؤ في جدول اليوزرز
         * انا قولتله ادخل الجدول يوزرز وهاتلي اليوزر نيم اللي انا عملت عليه سيلكت بناء علي
         * اليوزر اي دي اللي في جدول اليوزرز يساوي الميمبر اي دي اللي في جدول الايتمز 
         * 
         */
        $stmtItem = $con->prepare("SELECT items.*, categorys.cat_name, users.Username
                                   FROM items INNER JOIN categorys ON categorys.ID = items.cat_ID
                                               INNER JOIN users ON users.UserID = items.member_ID $approve");
        $stmtItem->execute();
        $items = $stmtItem->fetchAll(); 
        
        ?>
        
     <div class="container">
     <h2 class='text-center py-3'>Manege Items</h2>
        <table class="table text-center table-bordered">
        <?php if(!empty($items)): ?>
           <thead>
              <tr>
                 <th scope="col">ID</th>
                 <th scope="col">Name</th>
                 <th scope="col">Discription</th>
                 <th scope="col">Price</th>
                 <th scope="col">Country</th>
                 <th scope="col">Category</th>
                 <th scope="col">User</th>
                 <th scope="col">Date</th>
                 <th scope="col">Edit</th>
                 <th scope="col">Delete</th>
                 
              </tr>
           </thead>
        <?php else: alert('No Items'); endif;?>
           <tbody>
           <?php foreach($items as $item): ?>
              <tr>
                 <th><?php echo $item['item_ID'] ?></th>
                 <td><?php echo $item['item_name'] ?></td>
                 <td><?php echo $item['item_disc'] ?></td>
                 <td><?php echo $item['item_price'] ?></td>
                 <td><?php echo $item['country_made'] ?></td>
                 <td><?php echo $item['cat_name'] ?></td>
                 <td><?php echo $item['Username'] ?></td>
                 <td><?php echo $item['add_date'] ?></td>
                 <td><a href="items.php?page=Edit&itemID=<?php echo $item['item_ID'] ?>"><i class="far fa-edit"></i></a></td>
                 <td><a href="items.php?page=Delete&itemID=<?php echo $item['item_ID'] ?>"><i class="far fa-trash-alt"></i></a></td>
                 <?php if($item['approve'] == 0):?>
                <td><a href="items.php?page=Approve&itemID=<?php echo $item['item_ID'] ?>" class=''><i class="fas fa-check"></i></a></td>
                <?php endif; ?>
                 
              </tr>
           <?php endforeach; ?>
           </tbody>
        </table>
        <!-- Add new Member -->
        <a class='btn btn-primary' href="items.php?page=Add">
        <i class="fas fa-plus-circle mr-3"></i>Add New Item
        </a>
     </div>
    <?php }
    elseif($page == 'Add'){?>
    <section class="add-items">
        <div class="container">
        <h2 class='text-center py-4'>Add New Item</h2>
            <!-- Add Form -->
            <form class="form-horizontal" action="?page=Insert" method='POST'>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Item Name:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='name' id="name" require='require'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="disc"> Discription:</label>
                    <div class="col-sm-10">
                    <textarea name='item-disc' id="disc" require='require' class="form-control"  rows="4"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="price">Price:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='price' id="price" require='require'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cun">Conutry Made:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='country' id="cun">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="">Status:</label>
                    <div class="col-sm-10">
                    <select class="form-control" name='status'>
                        <option value = '0'>.   .   .</option>
                        <option value = '1'>New</option>
                        <option value = '2'>Like New</option>
                        <option value = '3'>Used</option>
                        <option value = '4'>Very Old</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="">Member:</label>
                    <div class="col-sm-10">
                    <select class="form-control" name='member'>
                        <option value = '0'>.   .   .</option>
                        <?php
                        // $stmtMem = $con->prepare("SELECT * FROM users");
                        // $stmtMem->execute();
                        // $members = $stmtMem->fetchAll();
                        $members = getAll("*","users","","","UserID");
                        foreach($members as $member):
                        ?>
                        <option value = '<?php echo $member['UserID']; ?>'><?php echo $member['Username']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="">Category:</label>
                    <div class="col-sm-10">
                    <select class="form-control" name='cat-id'>
                        <option value = '0'>.   .   .</option>
                        <?php
                        // $stmtCat = $con->prepare("SELECT * FROM categorys");
                        // $stmtCat->execute();
                        // $cats = $stmtCat->fetchAll();
                        $cats = getAll("*","categorys","where parent = 0","","ID");
                        foreach($cats as $cat):
                        ?>
                        <option value = '<?php echo $cat['ID']; ?>'><?php echo $cat['cat_name']; ?></option>
                        <?php $subCats = getAll("*","categorys","where parent = {$cat['ID']}","","ID"); 
                        foreach($subCats as $subCat):
                        ?>
                        <option value = '<?php echo $subCat['ID']; ?>'>
                           <?php echo $subCat['cat_name']; ?> <span>---><?php echo $cat['cat_name']; ?></span>
                        </option>
                        <?php endforeach; ?>
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
                    <button type="submit" class="btn btn-info">Add New Item</button>
                    </div>
                </div>
            </form>
            </div>
    </section>

    

<?php
    }
    elseif($page == 'Insert'){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $itemName = $_POST['name'];
            $itemDisc = $_POST['item-disc'];
            $itemPrice = $_POST['price'];
            $itemCountry = $_POST['country'];
            $itemStatus = $_POST['status'];
            $memberID = $_POST['member'];
            $catID = $_POST['cat-id'];
            $tags = $_POST['tags'];
            
      
            $Errors = array(); //هنا هيضيف كل الايرورس اللي هتطلع في الاري دي
            if(empty($itemName)){$Errors[] = 'Pleas Add Item Name';}
            if(empty($itemDisc)){$Errors[] = 'Pleas Add Item Discription';}
            if(empty($itemPrice)){$Errors[] = 'Pleas Add Item Price';}
            if(empty($itemCountry)){$Errors[] = 'Pleas Add Item Country';}
            if($itemStatus == 0){$Errors[] = 'Pleas Add Item Status';}
            if($memberID == 0){$Errors[] = 'Pleas Add Member';}
            if($catID == 0){$Errors[] = 'Pleas Add Category';}
            
            foreach($Errors as $Error){
               echo '<div class="alert alert-danger">'.$Error.'</div>';
            }
      
            if(empty($Errors)){//هنا لو الايرور قاضيه هينفذ الاستعلام
               
               //هنا انا بضيف بيانات في الداتا بيز حددت الحقول اللي هضيف فيها
               $stmt = $con->prepare("INSERT INTO items(item_name,  item_disc, item_price, country_made, `status` , add_date, cat_ID, member_ID, tags) 
                                      VALUES(:itname, :itdisc, :itprice, :itcountry, :itstatus , now(), :itcatID, :itmemberID, :ittags)");//وبعد كده حددت لكل حقل اسم عشان هستخدمه بعدكده
               $stmt-> execute (array( // هنا انا هضيف الداتا في الحقول عن طريق الاسامي اللي انا محددها 
                  'itname' => $itemName,
                  'itdisc' => $itemDisc,
                  'itprice' => $itemPrice,
                  'itcountry' => $itemCountry,
                  'itstatus' => $itemStatus,
                  'itcatID' => $catID,
                  'itmemberID' => $memberID,
                  'ittags' => $tags,
               ));
               redirectFunc('Add Item Done','items.php?page=Add',2,'success');
               
            }else{redirectFunc('Pleas Fix Errors','items.php?page=Add',4,'warning ');}
        }

    }
    elseif($page == 'Edit'){
        echo "<h2 class='text-center py-3'>Edit Items</h2>";
       
       $itemID = isset($_GET['itemID'])&& is_numeric($_GET['itemID']) ? intval($_GET['itemID']) : 0;
       
       $stmt = $con->prepare("SELECT * FROM items WHERE item_ID = ? ");
       $stmt->execute(array($itemID));
       $item = $stmt->fetch();
       $count = $stmt->rowCount();
       if($count > 0){?>

    <section class="edit-items">
        <div class="container">
            <!-- Add Form -->
            <form class="form-horizontal" action="?page=Update" method='POST'>
            <input type="hidden"   name='itemID' value="<?php echo $itemID; ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Item Name:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='name' value="<?php echo $item['item_name'] ?>" id="name" require='require'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="disc"> Discription:</label>
                    <div class="col-sm-10">
                    <textarea name='item-disc' value="" id="disc" require='require' class="form-control"  rows="4">
                    <?php echo $item['item_disc'] ?>
                    </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="price">Price:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='price' value="<?php echo $item['item_price'] ?>" id="price" require='require'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cun">Conutry Made:</label>
                    <div class="col-sm-10"> 
                    <input type="text" class="form-control"  name='country' value="<?php echo $item['country_made'] ?>" id="cun">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="">Status:</label>
                    <div class="col-sm-10">
                    <select class="form-control" name='status'>
                        <option value = '1'<?php if($item['status'] == 1){echo 'selected';}?>>New</option>
                        <option value = '2'<?php if($item['status'] == 2){echo 'selected';}?>>Like New</option>
                        <option value = '3'<?php if($item['status'] == 3){echo 'selected';}?>>Used</option>
                        <option value = '4'<?php if($item['status'] == 4){echo 'selected';}?>>Very Old</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="">Member:</label>
                    <div class="col-sm-10">
                    <select class="form-control" name='member'>

                        <?php
                        // $stmtMem = $con->prepare("SELECT * FROM users");
                        // $stmtMem->execute();
                        // $members = $stmtMem->fetchAll();
                        $members = getAll("*","users","","","UserID");
                        foreach($members as $member):
                        ?>
                        <option value = "<?php echo $member['UserID']; ?>"
                        <?php if( $item['member_ID'] == $member['UserID']){echo 'selected';}?>>
                        <?php echo $member['Username']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="">Category:</label>
                    <div class="col-sm-10">
                    <select class="form-control" name='cat-id'>
                        <option value = '0'>.   .   .</option>
                        <?php
                        // $stmtCat = $con->prepare("SELECT * FROM categorys");
                        // $stmtCat->execute();
                        // $cats = $stmtCat->fetchAll();
                        $cats = getAll("*","categorys","where parent = 0","","ID");
                        foreach($cats as $cat):
                        ?>
                        <option value = '<?php echo $cat['ID']; ?>' <?php if($cat['ID'] == $item['cat_ID']){echo 'selected';}?>>
                            <?php echo $cat['cat_name']; ?>
                        </option>
                        <?php $subCats = getAll("*","categorys","where parent = {$cat['ID']}","","ID"); 
                        foreach($subCats as $subCat):
                        ?>
                        <option value = '<?php echo $subCat['ID']; ?>'>
                           <?php echo $subCat['cat_name']; ?> <span>---><?php echo $cat['cat_name']; ?></span>
                        </option>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="tags">Tags:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name='edTags' id="tags" value="<?php echo $item['tags'] ?>">
                    </div>
                </div>
                


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info">Update Item</button>
                    </div>
                </div>
            </form>
            </div>
    </section>
    <!-- 
        هنا انا بجيب الكومنتات الخاصه بأيتم اللي انا دخلت اعمل فيها اديت
     -->
    <?php
        $stmtComm = $con->prepare("SELECT comments.*, users.Username
                                     FROM comments
                                     INNER JOIN users ON users.UserID = comments.user_id
                                     WHERE item_id = ?");
        $stmtComm->execute(array($itemID));
        $comments = $stmtComm->fetchAll(); 

?>
<div class="container">
<h2 class='text-center py-3'>Manege Comments in [ <?php echo $item['item_name']; ?> ] Item</h2>
<table class="table text-center table-bordered">
<?php if(!empty($comments)): ?>
<thead>
<tr>

<th scope="col">Comment</th>
<th scope="col">UserName</th>
<th scope="col">Date</th>
<th scope="col">Edit</th>
<th scope="col">Delete</th>

</tr>
</thead>
<?php else: alert('No Items'); endif;?>
<tbody>
<?php foreach($comments as $comment): ?>
<tr>

<td><?php echo $comment['comment'] ?></td>
<td><?php echo $comment['Username'] ?></td>
<td><?php echo $comment['c_date'] ?></td>
<td><a href="comments.php?page=Edit&comID=<?php echo $comment['c_ID'] ?>"><i class="far fa-edit"></i></a></td>
<td><a href="comments.php?page=Delete&comID=<?php echo $comment['c_ID'] ?>"><i class="far fa-trash-alt"></i></a></td>
<?php if($comment['status'] == 0):?>
<td><a href="comments.php?page=Approve&comID=<?php echo $comment['c_ID'] ?>" class=''><i class="fas fa-check"></i></a></td>
<?php endif; ?>

</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>


<?php 
       }
  }
    elseif($page == 'Update'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ID = $_POST['itemID'];
            $itemName = $_POST['name'];
            $itemDisc = $_POST['item-disc'];
            $itemPrice = $_POST['price'];
            $itemCountry = $_POST['country'];
            $itemStatus = $_POST['status'];
            $catID = $_POST['cat-id'];
            $memberID = $_POST['member'];
            $edTags = $_POST['edTags'];
            
            
      
            $Errors = array(); //هنا هيضيف كل الايرورس اللي هتطلع في الاري دي
            if(empty($itemName)){$Errors[] = 'Pleas Add Item Name';}
            if(empty($itemDisc)){$Errors[] = 'Pleas Add Item Discription';}
            if(empty($itemPrice)){$Errors[] = 'Pleas Add Item Price';}
            if(empty($itemCountry)){$Errors[] = 'Pleas Add Item Country';}
            if($itemStatus == 0){$Errors[] = 'Pleas Add Item Status';}
            if($memberID == 0){$Errors[] = 'Pleas Add Member';}
            if($catID == 0){$Errors[] = 'Pleas Add Category';}
            
            foreach($Errors as $Error){
               echo '<div class="alert alert-danger">'.$Error.'</div>';
            }
      
            if(empty($Errors)){
            $itemUpdat = $con->prepare("UPDATE  items 
                        SET item_name = ?, item_disc = ?, item_price = ?, country_made = ?, `status` = ?, cat_ID = ?, member_ID = ?, tags = ?
                                WHERE item_ID = ?");
            $itemUpdat->execute(array($itemName, $itemDisc, $itemPrice, $itemCountry, $itemStatus, $catID, $memberID, $edTags ,$ID));
            redirectFunc('Updating Item Done','items.php',3,'success');
            }
        }else{redirectFunc('This Not POSt Requst','items.php',2,'success');}
    }
    elseif($page == 'Delete'){
        $itemDelete = isset($_GET['itemID'])&& is_numeric($_GET['itemID']) ? intval($_GET['itemID']) : 0;
        /**
         * هنا انا بقوله جيبلي الجدول بتاع الايتمز ده عن  طريق الايدي بتاعه
         */
        // $stmt = $con->prepare("SELECT * FROM items WHERE item_ID = ? LIMIT 1");
        // $stmt->execute(array($itemDelet));
        // $count = $stmt->rowCount();
        $checkDelet = checkItems('item_ID','items',$itemDelete);
        if($checkDelet > 0){
           $stmt = $con->prepare("DELETE FROM items WHERE item_ID = :itemid LIMIT 1");
           $stmt->execute(array('itemid'=>$itemDelete));
          redirectFunc('Deleting Item Done','items.php',2,'success');
        }else{redirectFunc('Cant Deleting This Item','items.php',2);}
    }
    elseif($page == 'Approve'){
        $itemID = isset($_GET['itemID'])&& is_numeric($_GET['itemID']) ? intval($_GET['itemID']) : 0;
        $checkApprove = checkItems('item_ID','items',$itemID);
        if($checkApprove > 0){
         $stmt = $con->prepare("UPDATE items SET approve = 1 WHERE item_ID = ?");
         $stmt->execute(array($itemID));
         redirectFunc('Approve Item Done','items.php',2,'success');
        }
    }
    else{redirectFunc('Error Page','items.php',3);}









include $tpl . 'footer.php';
}else{
   header('Location: index.php');
   exit();
}