<?php
 $title ='Dashbord';
session_start();
if(isset($_SESSION['username'])){
    include 'init.php'; 

    $lastUsers = getLatest('*','users','UserID',6);//دي بتجيب اخر 6 اعضاء مسجلين في الموقع
    $lastItems = getLatest('*','items','item_ID',6);//دي بتجيب اخر 6 اتمز مسجلين في الموقع
    
    /**
     * دي بتجيب اخر 3 عملو كومنت في الموقع 
     * هتجيب المنتج اللي عمل عليه كومنت 
     * واسم اللي عمل كومنت 
     * والكومنت
     */
    $stmtComm = $con->prepare("SELECT comments.*, items.item_name, users.Username
                                     FROM comments
                                     INNER JOIN items ON items.item_ID = comments.item_id
                                     INNER JOIN users ON users.UserID = comments.user_id
                                     ORDER BY c_id DESC LIMIT 3");
        $stmtComm->execute();
        $lastComments = $stmtComm->fetchAll(); 
    ?>

<!----------- Start Dashbord Page ------------>
<section class="stats">
<div class="container pt-3">
<h2 class="text-center py-4"><?php echo $title; ?></h2>
    <div class="row">
        <!-- Total Member -->
        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body text-center">
                <p class="card-text">Total Member</p>
                <h4 class='h1'>
                <a href="members.php">
                <?php echo countItems('UserID','users'); ?>
                </a>
                </h4>
                </div>
            </div>
        </div>

        <!-- Pending Member -->
        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body text-center">
                <p class="card-text">Pending Member</p>
                <h4 class='h1'>
                <a href="members.php?page=Mange&action=pending">
                <?php echo checkItems('RegStatues','users',0); ?>
                </a>
                </h4>
                </div>
            </div>
        </div>

        <!-- Total Items -->
        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body text-center">
                <p class="card-text">Total Items</p>
                <h4 class='h1'>
                <a href="items.php">
                <?php echo countItems('item_ID','items'); ?>
                </a></h4>
                </div>
            </div>
        </div>

        <!-- Total Comments -->
        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body text-center">
                <p class="card-text">Total Comments</p>
                <h4 class='h1'>
                <a href="comments.php">
                <?php echo countItems('c_ID','comments'); ?>
                </a></h4>
                </h4>
                </div>
            </div>
        </div>
    </div><hr>
</div>
</section>
    
<section class='letst-users-items'>
<div class="container">
    <div class="row">
        <!-- Letst Register Users -->
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title m-0"><i class="fas fa-users"></i> Letst Register Users</h5>
                </div>
                <div class="card-body">
                <?php if(!empty($lastUsers)): ?>
                    <ul class="list-group  ">
                        <?php foreach($lastUsers as $user): ?>
                        <li class="list-group-item  overflow-hidden">
                        <?php echo $user['FullName']; ?>
                        <?php if($user['RegStatues'] == 0):?>
                        <a class='ml-2 float-right' href="members.php?page=Activat&id=<?php echo $user['UserID'] ?>">
                            <span class="badge btn btn-success">
                                <i class="fas fa-check"></i> Activat
                            </span>
                        </a>
                        
                        <?php endif; ?>
                        <a class='float-right' href="members.php?page=Edit&id=<?php echo $user['UserID'] ?>">
                            <span class="badge btn btn-primary">
                                <i class="far fa-edit"></i> Edit
                            </span>
                        </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else: alert('There Is No Members');?>
                    <a class='btn btn-primary' href="members.php?page=Add">
                    <i class="fas fa-plus-circle mr-3"></i>Add New Member
                    </a>
                <?php endif;?>
                </div>
            </div>
        </div>

        <!-- Letst Items -->
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title m-0"><i class="fas fa-store"></i> Letst Items</h5>
                </div>
                <div class="card-body">
                <?php if(!empty($lastItems)): ?>
                <ul class="list-group  ">
                        <?php foreach($lastItems as $item): ?>
                        <li class="list-group-item  overflow-hidden">
                        <?php echo $item['item_name']; ?>
                        <?php if($item['approve'] == 0):?>
                        <a class='ml-2 float-right' href="items.php?page=Approve&itemID=<?php echo $item['item_ID'] ?>">
                            <span class="badge btn btn-success">
                                <i class="fas fa-check"></i> Approve
                            </span>
                        </a>
                        
                        <?php endif; ?>
                        <a class='float-right' href="items.php?page=Edit&itemID=<?php echo $item['item_ID'] ?>">
                            <span class="badge btn btn-primary">
                                <i class="far fa-edit"></i> Edit
                            </span>
                        </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: alert('There Is No Items');?>
                    <a class='btn btn-primary' href="items.php?page=Add">
                    <i class="fas fa-plus-circle mr-3"></i>Add New Item
                    </a>
                <?php endif;?>
                </div>
            </div>
        </div>

        <!-- Letst Comments -->
        <div class="col-sm-6">
            <div class="card mt-3">
                <div class="card-header">
                <h5 class="card-title m-0"><i class="fas fa-comments"></i></i> Letst Comments</h5>
                </div>
                <?php if(!empty($lastComments)): ?>
                <div class="card-body letst-comments">
                    <div class="row">
                <?php foreach($lastComments as $comment): ?>
                    <div class="col-md-6">
                    <div class="card bg-light mb-3 overflow-hidden">
                        <div class="card-header p-2"><?php echo $comment['item_name'] ?></div>
                        <div class="card-body p-2">
                            <div class=" del-comment position-relative float-right">
                            <?php if($comment['status'] == 0):?>
                            <a class='approve' href="comments.php?page=Approve&comID=<?php echo $comment['c_ID'] ?>" class=''><i class="fas fa-check"></i></a>
                            <?php endif; ?>
                            <a class='delete ml-2' href="comments.php?page=Delete&comID=<?php echo $comment['c_ID'] ?>"><i class="far fa-trash-alt"></i></a>
                            </div>

                            <span class="badge badge-info px-2"><?php echo $comment['Username'] ?></span>
                            <p class="card-text"><?php echo $comment['comment'] ?></p>
                            
                        </div>
                    </div>
                    </div>
                <?php endforeach; ?>
                </div>
                </div>
                <?php else: alert('There Is No Comments'); endif;?>
            </div>

        </div>
</div>
</section>


<!----------- End Dashbord Page ------------>

<?php
    include $tpl . 'footer.php';
}else{
    header('Location:index.php');
    //echo 'This Page Is protected';
    //redirectFunc('This Page Is protected','index.php',3,'danger');
}


?>