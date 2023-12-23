
<?php
ob_start();
session_start();
if(isset($_SESSION['username']))
{
    $titlename='Categoreis';//vareiable to put title name to page
    include 'ini.php';
    $do=isset($_GET['do'])? $_GET['do'] : 'Manage';
    if(($do =='Manage')){
        
        $userid=isset($_GET['user_id']) && is_numeric($_GET['user_id'])? intval($_GET['user_id']):0;
        if($userid>0)
        {
          $ord=array('desc','asc');
          if(isset($_GET['ord']) && in_array($_GET['ord'],$ord))
            {
              if(isset($_GET['q']) && ($_SERVER['REQUEST_METHOD'] === 'POST'))
              {
              $order='order by '. $_GET['q'].' '.$_GET['ord'];
              }
              else
              {
                $order='order by cat_id '. $_GET['ord'];
              }
          }
              else
              {
              $order=null;
                  
             } 
             $stmt=selectquery('cat_id','categories',$order);
            $count = $stmt->rowCount();
            $row=$stmt->fetchall(PDO::FETCH_COLUMN);
            
          if($count>0){
        ?>
        
        <div class="container-fluid py-7">
       <div class="row mb-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0" >
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6><a  href="categories.php?do=Add&user_id=<?php echo $_SESSION['id']?>">
                <i class="fa fa-plus-square" style="font-size:24px;"></i>
                 Add Categories 
                </a>
</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1"><?php echo count($row);?></span> Categories
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                  <span class="font-weight-bold ms-1">Ordering: </span>
                    
                    <a href="?do=Manage&user_id=<?php  echo $_SESSION['id']; ?>&ord=desc&q=<?php if(isset($_POST['form_order'])){echo $_POST['form_order'];} else{ echo 'null';} ?>">desc</a>
          <?php echo "|"?>
          <a href="?do=Manage&user_id=<?php  echo $_SESSION['id']; ?>&ord=asc&q=<?php if(isset($_POST['form_order'])){echo $_POST['form_order'];} else{ echo 'null';} ?>">Asc</a>   
    
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary  font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary  font-weight-bolder opacity-7 ps-2">Visibility</th>
                      <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7"> Comment</th>
                      <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">Ads</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
      foreach($row as  $value ):
        # code...
        ///function to select query
        
        $stmt=selectquery('*','categories','where cat_id=?',$value);
        $row= $stmt->fetch();

     
               
    ?>
    
                    <tr>
                      <td>
                      
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">
                            <a href="#" class="item-link" id="myLink" data-id="<?php echo $row['cat_id']; ?>">
                          
                            <script>
                              data-item-id=<?php echo $row['cat_id'];?>
                        $(document).ready(function() {
  $('.item-link').click(function(event) {
    event.preventDefault();
    var itemId = $(this).data('data-id');
    $.ajax({
      url: 'categories.php?do=Manage',
      type: 'GET',
      data: { 'data-id': itemId },
      success: function(data) {
        $('.item-description[data-item-id="' + itemId + '"]').html(data);
      },
      error: function() {
        console.log('Error retrieving item description');
      }
    });
  });
});
                      </script>

                            <?php echo $row['cat_name']; ?></a></h6>
                          </div>
                        </div>
                      
                                         </td>
                      <td>
                      <div class="progress-wrapper w-85 mx-auto">
                        <?php
                          if($row['visib']==0){
                        ?>
                                <span class=""
                                 style="background-color:#611f1f;color:antiquewhite;border-radius:5px;
                                  padding:2px">
                               <i class="fa fa-eye"></i>
                              <?php  echo " Hidden";  ?>
                              </span>
                        <?php }?>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <div class="progress-wrapper w-50 mx-auto">
                        <?php
                          if($row['allow_comment']==0){
                        ?>
                                <span class=""
                                 style="background-color:chocolate;color:antiquewhite;border-radius:5px;
                                  padding:2px">
                               <i class="fa fa-close"></i>
                              <?php  echo " No comment";  ?>
                              </span>
                        <?php }?>
                        </div>
                      </td>
                      <td class="align-middle text-sm">
                        <div class="progress-wrapper w-50 mx-auto">
                        <?php
                          if($row['allow_ads']==0){
                        ?>
                                <span class=""
                                 style="background-color:darkolivegreen;color:antiquewhite;border-radius:5px;
                                  padding:2px">
                               <i class="fa fa-close"></i>
                              <?php  echo " No Ads";  ?>
                              </span>
                        <?php }?>
                        </div>
                      </td>
                      <td class="align-middle text-sm">
                      <div class="progress-wrapper w-50 mx-auto">
                      <a href="categories.php?do=Edit&cat_id=<?php echo $row['cat_id'];?>"
                               role="button">
                              <i class="fa fa-edit" style="font-size:15px"></i>
                            </a>
                        
                             <a href="categories.php?do=Delete&cat_id=<?php echo $row['cat_id'];?>" 
                              role="button">
                             <i class='fas fa-trash-alt' style='font-size:15px'></i>
                             </a>
                      </div>
                    </td>
                    </tr>
                    <?php 
                    endforeach;
                    
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Description</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                <span class="font-weight-bold">
                 
                </span>
              </p>
            </div>
            <div class="card-body p-3" >
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0" class="item-description">
                


                    </h6>
                    </div>
                </div>
                              </div>
            </div>
          </div>
        </div>
      </div>
                  </div>
             
  
  

        <?php 
          }}
          else
          {

            header('location: index.php');
          }
        }
        ///////////---------add----------------/////////////////////
        elseif($do=='Add')
        {
            $userid=isset($_GET['user_id']) && is_numeric($_GET['user_id'])? intval($_GET['user_id']):0;
            if($userid>0)
            {
                
             
    ?>
  <main class="  mt-2">
    <div class="page-header align-items-start min-vh-100" >
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Add Categories</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      
                    </div>
                    <div class="col-2 text-center px-1">
                     
                    </div>
                    <div class="col-2 text-center me-auto">
                     
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" method="POST" action="?do=Insert">
                  <div class="input-group input-group-outline my-3">
                  <input class="form-control" type="text" name="name"  autocomplete="off" required="required" placeholder="Name"/>
                   
                  </div>
                  <div class="input-group input-group-outline mb-3">
                  <input class="form-control" type="text" name="des" required placeholder="Description"/>
                  
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <input class="form-control" type="number" name="ordering" placeholder="Ordering"  />
                  </div>
                 
                  <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" name="visib" id="visib" checked>
  <label class="form-check-label" for="visib">Visibility</label>
  <input type="hidden" id="myValue" name="myValue" value="0">
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" name="comment" id="comment" checked >
  <label class="form-check-label" for="comment">Comment</label>
  <input type="hidden" id="myValue1" name="myValue1" value="0">
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" name="ads" id="ads" checked>
  <label class="form-check-label" for="ads">Ads</label>
  <input type="hidden" id="myValue2" name="myValue2" value="0">
</div>

                  <div class="text-center">
                    <input type="submit"  value="Insert" class="btn bg-gradient-primary w-100 my-4 mb-2"/>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>

   
    <?php
              }
              
             else
            {
                echo errorstyle("There Is No Correct Id");
            }
            




            
        }
 /////////////////--------insert-----------//////////       
        elseif($do == 'Insert')
        {
///// GEt VARIABLE FROM POST MSTHOD//////
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $mySwitchValue = isset($_POST['visib']) ? '1' : '0';
    $mySwitchValue1 = isset($_POST['comment']) ? '1' : '0';
    $mySwitchValue2 = isset($_POST['ads']) ? '1' : '0';
$errorvalue = array(); // variable array to put in it error validation
$errorvalue[] = empty($_POST['name']) ? 'UserName cannot be empty' :"";
$errorvalue[] = strlen($_POST['name']) < 3 ? ' Categories Name must be at least 3 characters' :"";
foreach($errorvalue as $key => $error ): //loop to echo error where items of array not null
      if($error != "") {echo errorstyle($error);} 
      else             {unset($errorvalue[$key]);}
endforeach;
if (empty($errorvalue)) // check if array is empty, meaning no errors, then do insert
{    
// insert code here
$checkname=checkitem('cat_name','categories',$_POST['name']);
    if(($checkname == 0)){

$stmt = $db->prepare("INSERT INTO categories  (cat_name,description,ordering,visib,allow_comment,allow_ads) VALUE(:zname,:zdes,:zord,:zvisib,:zcomment,:zads)");
$stmt->execute(array(
    ':zname'=>$_POST['name'],
    ':zdes'=>$_POST['des'],
    ':zord'=>$_POST['ordering'],
    ':zvisib'=>$mySwitchValue,
    ':zcomment'=>$mySwitchValue1,
    ':zads'=>$mySwitchValue2
));
header("location: categories.php?do=Manage&user_id=".$_SESSION['id']);exit();
    }
} 

}
else////------------- to check if user comming to this page by post method -----------//////////
{
   echo errorstyle("You Cant Enter This Page Directly");
 }

            }
         elseif($do=='Edit')
         {

            $catid=isset($_GET['cat_id']) && is_numeric($_GET['cat_id'])? intval($_GET['cat_id']):0;
            if($catid>0)
            {
                $stmt=selectquery('*','categories','where cat_id=?',$_GET['cat_id']);
                $row=$stmt->fetch();
                $count=$stmt->rowcount();
                if($count>0){

             
    ?>
     <main class="  mt-2">
    <div class="page-header align-items-start min-vh-100" >
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Add Categories</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      
                    </div>
                    <div class="col-2 text-center px-1">
                     
                    </div>
                    <div class="col-2 text-center me-auto">
                     
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" method="POST" action="?do=Update">
                  <div class="input-group input-group-outline my-3">
                  <input type="hidden" name="id" value="<?php echo $row['cat_id'] ?>" />
                  <input class="form-control" type="text" name="name"  autocomplete="off"
                   required="required" placeholder="Name" value="<?php echo $row['cat_name']?> "/>
                   
                  </div>
                  <div class="input-group input-group-outline mb-3">
                  <input class="form-control" type="text" name="des" 
                  required placeholder="Description" value="<?php echo $row['description']?> "/>
                  
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <input class="form-control" type="text" name="ordering" 
                    placeholder="Ordering" value="<?php echo intval($row['ordering']); ?> " />
                  </div>
                 
                  <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" name="visib" id="visib"  <?php if($row['visib']==1){ echo "checked";} ?>>
  <label class="form-check-label" for="visib">Visibility</label>
  <input type="hidden" id="myValue" name="myValue" value="0">
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" name="comment" id="comment" <?php if($row['allow_comment']==1){ echo "checked";}?>>
  <label class="form-check-label" for="comment">Comment</label>
  <input type="hidden" id="myValue1" name="myValue1" value="0">
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" name="ads" id="ads" <?php if($row['allow_ads']==1){ echo "checked";}?>>
  <label class="form-check-label" for="ads">Ads</label>
  <input type="hidden" id="myValue2" name="myValue2" value="0">
</div>

                  <div class="text-center">
                    <input type="submit"  value="Update" class="btn bg-gradient-primary w-100 my-4 mb-2"/>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>

    <?php
                }
              }
              
             else
            {
                echo errorstyle("There Is No Correct Id");
            }
            




            








         }
       
         elseif($do == 'Update')
         {
 ///// GEt VARIABLE FROM POST MSTHOD//////
 if($_SERVER['REQUEST_METHOD'] === 'POST')
 {
  $mySwitchValue = isset($_POST['visib']) ? '1' : '0';
  $mySwitchValue1 = isset($_POST['comment']) ? '1' : '0';
  $mySwitchValue2 = isset($_POST['ads']) ? '1' : '0';
 $errorvalue = array(); // variable array to put in it error validation
 $errorvalue[] = empty($_POST['name']) ? 'Categorie Name cannot be empty' :"";
 $errorvalue[] = strlen($_POST['name']) < 3 ? ' Categories Name must be at least 3 characters' :"";
 foreach($errorvalue as $key => $error ): //loop to echo error where items of array not null
       if($error != "") {echo errorstyle($error);} 
       else             {unset($errorvalue[$key]);}
 endforeach;
 if (empty($errorvalue)) // check if array is empty, meaning no errors, then do insert
 {    
 // update
 try {
 $stmt = $db->prepare("UPDATE categories SET  cat_name=?, description=?,ordering=?,visib=?,allow_comment=?,allow_ads=? 
 where cat_id=? limit 1");
 $stmt->execute(array(
     $_POST['name'],
     $_POST['des'],
     $_POST['ordering'],
     $mySwitchValue,
     $mySwitchValue1,
     $mySwitchValue2,
     $_POST['id']
 ));
 header("location: categories.php?do=Manage&user_id=".$_SESSION['id']);exit();
     
 } 
 catch (PDOException $e)
{
    echo  errorstyle("This info exsite befor check your information");

}

 }}
 else////------------- to check if user comming to this page by post method -----------//////////
 {
    echo errorstyle("You Cant Enter This Page Directly");
 }
 
             }
            
            elseif($do == 'Delete')
            {
             $catid=isset($_GET['cat_id']) && is_numeric($_GET['cat_id'])? intval($_GET['cat_id']):0;
             if($catid>0)
            {
             
             $stmt = $db->prepare("DELETE FROM categories WHERE cat_id = ?");
             $stmt->execute(array($_GET['cat_id']));
             header("location: categories.php?do=Manage&user_id=".$_SESSION['id']);exit();
             
            }
            else
            {          
               header('location: index.php');
   
               exit();
            }
   
        
            }
            
    include $tpl.'footer.php';

    }
else{ header('location: index.php'); exit();
 }
 
 ob_end_flush();
?>