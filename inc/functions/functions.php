<?php


/******************************************* This Functions For FrontEnd *******************************/
//Get All Function to get all records from database
function getAll($select,$tabel,$where = NULL, $and, $orderBy, $order = 'DESC'){
    global $con;

   
    $stmtAll = $con->prepare("SELECT $select FROM $tabel $where $and ORDER BY $orderBy $order");
    $stmtAll->execute();
    $all = $stmtAll->fetchAll();
    return $all;
   }


// //Get Category Function To get categorys from database
// function getCategory(){
//     global $con;

//     $stmtCats = $con->prepare("SELECT * FROM categorys ORDER BY ID ASC");
//     $stmtCats->execute();
//     $Cats = $stmtCats->fetchAll();
//     return $Cats;
//    }
//Get Items Function To get Items from database
//    function getItems($where , $value, $approve = NULL){
//     global $con;
// /**
//  * هنا انا بقوله حددلي جدول الايتمز كله بناء علي الكاتيجوري اي دي يساوي المتغير اللي انا اديتهوله
//  */
// if($approve == NULL){
//     $sql =NULL;
// }else{
//     $sql ='AND approve = 1';
// }
//     $stmtItems = $con->prepare("SELECT * FROM items WHERE $where = ? $sql ORDER BY item_ID DESC ");
//     $stmtItems->execute(array($value));
//     $Items = $stmtItems->fetchAll();
//     return $Items;
//    }

// This function To Check If User Is Activet Or Not
   function checkUserIsActive($userActive){
       global $con;

       $active = $con->prepare("SELECT  Username , RegStatues FROM users WHERE Username = ? AND RegStatues = 0");
        $active->execute(array($userActive));
        $count = $active->rowCount();
        return $count;
   }






















/******************************************* This Functions For Dashbord *******************************/
function getTitle(){ //دي داله بتغير اسم البيدج دينامك
    global $title; // هنا اانا حددت متغير وعملته جلوبل عشان يتقرأ من اي صفحه

    if (isset($title)){ // هنا انا بقوله لو لقيت المتغير ده هتطبع اللي فيه ولو ملقتهوش هتكتب ديفولت بيدج
          echo $title; 
    }else{
        echo 'Defult Page';
    }
    
}

//Redirect Function v0.1
function redirectFunc($messag,$redirect = 'index.php' ,$time = 3,$success = 'danger'){//الداله دي بتحولني علي الاندكس بيدج انا بحددلها الرساله و عدد الثواني اللي بتحولني بعده
  
//     if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] ==''){
//     $redirect = $_SERVER['HTTP_REFERER'];
//    }
    echo '<div class="alert alert-'.$success.'">'.$messag.'</div>';
    header("refresh:$time; url=$redirect");//هنا عشان يحولني بعد عدد ثواني معين بستخدم رفريش بدل لوكيشن وبعدين العنوان اللي هيحولني عليه
    exit();
}





// Chke if this in Tha databas or not v0.1
function checkItems($select, $from, $value){//دي داله بتشوف هل القيمه اللي انا كتبتها دي موجوده في الداتابيز ولا لا
    global $con;//هنا انا عملت المتغير ده جلوبل عشان يبقا ظهار في كل مكان
   // $stmtFunc = $con->prepare("SELECT Username FROM users WHERE Username = ?");
   //$stmt->execute(array('abdo'));

    /*
    *هنا انا عملت الاستعلام عادي جدا وحطيت الارجيومنتس اللي هستخدمها لما استدعي الداله
    *وبعدين هشوف هلي فيه ريكورد موجود في الداتا بيز ولا لا عن طريق ال rowCount
    *وبعدين  هيخزن قيمه الروكونت في الفنكشن
    */
    $stmtFunc = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $stmtFunc->execute(array($value));
    $count = $stmtFunc->rowCount();
    return $count;//عملتها في ريتيرن عشان متنطبعش بس لما احب اطبعها اطبعها
}


/*
**Count Items Function From Database
**
*/
function countItems($item,$from){
    /*
    *دي داله بتحسب عدد اي حاجه في الداتا بيز انا بحددلها الحاجه اللي هتحسبها 
    *و المكان اللي هتحسبها منه زي المثال اللي اانا عامله كومنت تحت ده 
    *ده بيجيب عدد اليوزرز اللي موجوده في الداتابيز عن طريق انه بيشوف كام اي دي موجود
    */
    global $con;
    //$item = $con->prepare("SELECT COUNT('UserID') FROM users");

    $stmtCountFunc = $con->prepare("SELECT COUNT($item) FROM $from");
    $stmtCountFunc->execute();
    return $stmtCountFunc->fetchColumn();//دي بتشوف كم عدد موجود
}


/**
 * getLatest();
 * الداله دي بتجيب اخر كذا كذا حاجه في الداتابيز سواء بقا اخير مثلا 5 يوزر سجلو او اخر 10كومنتات وهكذا
 * $select دي هتحدد انا عايز اسلكت ايه سواء حاجه معينه او كله
 * $from دي بتقوله اجيب الداتا دي من جدول ايه
 * ORDER BY $orderBY المتغير ده انا بقول يرتبهم علي اساس مين اليوزر نيم ولا الاي دي انا بختار بقا
 * $limit ده بعرفه انا عايز كام يوزر مثلا 
 * ORDER BY userID DESC  في دي انا بقوله هاتلي عن طريق اليوزراي دي بس رتبهم تنازلي يعني هاتلي اجدد حاجه في الداتا بيز
 */

 function getLatest($select,$from,$orderBY='UserID',$limit = 4){
     global $con;
     //$stmtLatst = $con->prepare("SELECT * FROM users ORDER BY userID DESC LIMIT 4");
     $stmtLatst = $con->prepare("SELECT $select FROM $from ORDER BY $orderBY DESC LIMIT $limit");
     $stmtLatst->execute();
     $latest = $stmtLatst->fetchAll();
     return $latest;// هرجع الداله دي في المتغير ده عشان اقدر احطه في متغير تاني واعمل عليه لوب
 }


    function alert($alert,$colr='warning'){
        echo '<div class="alert alert-'.$colr.'">' .$alert.'</div>';
    }

?>