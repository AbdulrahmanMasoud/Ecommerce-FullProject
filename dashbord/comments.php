<?php
$title = 'Comments';
session_start();
if(isset($_SESSION['username'])){
   include 'init.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'Mange';

    if ($page == 'Mange'){
        $stmtComm = $con->prepare("SELECT comments.*, items.item_name, users.Username
                                     FROM comments
                                     INNER JOIN items ON items.item_ID = comments.item_id
                                     INNER JOIN users ON users.UserID = comments.user_id");
        $stmtComm->execute();
        $comments = $stmtComm->fetchAll(); 

?>

<div class="container">
<h2 class='text-center py-3'>Manege Comments</h2>
<table class="table text-center table-bordered">
<?php if(!empty($comments)): ?>
<thead>
<tr>
<th scope="col">ID</th>
<th scope="col">Comment</th>
<th scope="col">Item Name</th>
<th scope="col">UserName</th>
<th scope="col">Date</th>
<th scope="col">Edit</th>
<th scope="col">Delete</th>

</tr>
</thead>
<tbody>
<?php else: alert('There Is No Comments'); endif;?>
<?php foreach($comments as $comment): ?>
<tr>
<th><?php echo $comment['c_ID'] ?></th>
<td><?php echo $comment['comment'] ?></td>
<td><?php echo $comment['item_name'] ?></td>
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
    
    elseif($page == 'Edit'){
        echo "<h2 class='text-center py-3'>Edit Comment</h2>";
       
        $comID = isset($_GET['comID'])&& is_numeric($_GET['comID']) ? intval($_GET['comID']) : 0;
        
        $stmt = $con->prepare("SELECT * FROM comments WHERE c_ID = ? ");
        $stmt->execute(array($comID));
        $com = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count > 0){?>
 
     <section class="add-comment">
         <div class="container">
             <!-- Add Form -->
             <form class="form-horizontal" action="?page=Update" method='POST'>
             <input type="hidden"  name='cID' value="<?php echo $comID; ?>">
                 
                 <div class="form-group">
                     <label class="control-label col-sm-2" for="comment"> Comment:</label>
                     <div class="col-sm-10">
                     <textarea name='comm' value="" id="comment" require='require' class="form-control"  rows="4">
                     <?php echo $com['comment'] ?>
                     </textarea>
                     </div>
                 </div>

                 <div class="form-group">
                     <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-info">Save Comment</button>
                     </div>
                 </div>

             </form>
             </div>
     </section>

        <?php }
    }
    
    elseif($page == 'Update'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $c_ID = $_POST['cID'];
                $comm = $_POST['comm'];
                if(!empty($comm)){
                    $comUpdate = $con->prepare("UPDATE comments SET comment = ? WHERE c_ID = ?");
                    $comUpdate->execute(array($comm, $c_ID));
                    redirectFunc('Updating Comment Done','comments.php',3,'success');
                }else{redirectFunc('Pleas add Comment','comments.php',3);}
            }else{redirectFunc('this id not existe','comments.php',3);}
    }

    elseif($page == 'Delete'){
        $comDelete = isset($_GET['comID'])&& is_numeric($_GET['comID']) ? intval($_GET['comID']) : 0;
        $checkDelet = checkItems('c_ID','comments',$comDelete);
        if($checkDelet > 0){
           $stmt = $con->prepare("DELETE FROM comments WHERE c_ID = :commid LIMIT 1");
           $stmt->execute(array('commid'=>$comDelete));
          redirectFunc('Deleting Comment Done','comments.php',2,'success');
        }else{redirectFunc('Cant Deleting This Comment','comments.php',2);}
    }

    elseif($page == 'Approve'){
        $comID = isset($_GET['comID'])&& is_numeric($_GET['comID']) ? intval($_GET['comID']) : 0;
        $checkApprove = checkItems('c_ID','comments',$comID);
        if($checkApprove > 0){
         $stmt = $con->prepare("UPDATE comments SET status = 1 WHERE c_ID = ?");
         $stmt->execute(array($comID));
         redirectFunc('Approve Comment Done','comments.php',2,'success');
        }
    }







include $tpl . 'footer.php';
}else{
   header('Location: index.php');
   exit();
}
