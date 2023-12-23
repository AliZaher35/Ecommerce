<?php
ob_start();
session_start();
if(isset($_SESSION['username']))
{
    $titlename='Member';//vareiable to put title name to page
    include 'ini.php';
    $do=isset($_GET['do'])? $_GET['do'] : 'Manage';
    if(($do =='Manage')){
        
        $userid=isset($_GET['user_id']) && is_numeric($_GET['user_id'])? intval($_GET['user_id']):0;
        if($userid>0)
        {
          if(isset($_GET['pinding']) && ($_GET['pinding']==0))
          {
          $stmt= selectquery('user_id','users','where reg_state=0 order by user_id');
           $rowid=$stmt->fetchAll(PDO::FETCH_COLUMN);
          }else
          {
           $stmt= selectquery('user_id','users','order by user_id');
           $rowid=$stmt->fetchAll(PDO::FETCH_COLUMN);
          }

            $count = $stmt->rowCount();
          if($count>0){
        ?>
        
        <div class="container-fluid py-7">
      <div class="row">
        <div class="col-12">
          <div class="card my-4" >
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white  text-capitalize ps-3" style="font-size: larger;">
                <a class="text-white" href="member.php?do=Add&user_id=<?php echo $_SESSION['id']?>">
                <i class="fa fa-plus-square" style="font-size:24px;color:#ffff"></i>
                 Add member 
                </a>
                </h6>
              </div>
              
            </div>
            <div class="card-body px-2 pb-2" >
              <div class="table-responsive p-0" >
                <table class="table align-items-center mb-0 " >
                  <thead >
                    <tr style="background-color:khaki">
                      <th><p class=" font-weight-bold mb-0">ID</p></th>
                      <th><p class=" font-weight-bold mb-0">User Name</p></th>
                      <th><p class=" font-weight-bold mb-0">Email</p></th>
                      <th>FUll Name</th>
                      <th>Register Date</th>
                      <th>Control</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
      foreach($rowid as $value ):
        # code...
        ///function to select query
        
        $stmt=selectquery('*','users','where user_id=?',$value);
        $row= $stmt->fetch();

        
               
    ?>
                  <tr class="<?php if(isset($_GET['row_id']) && ($_GET['row_id']==$row['user_id']) ){ echo "table-info"; } elseif($row['reg_state']==0){echo "table-danger";} ?>">
                 
                  <td>
                        <div class="d-flex px-2 py-2">
                          <div class="me-2">
                            <i class="fa fa-user"></i>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                          <?php  
                             if(isset($_GET['case']) && ($_GET['row_id']==$row['user_id']))
                               {
      
                                  echo "<spam style='color: green'>
                                   <i class='fa fa-check-square' style='font-size:15px'></i>
                                      </spam>";
                               }
      
                              ?>  
                          <h6 class="mb-0 text-sm"><?php    echo $row['user_id'];      ?></h6>
                                                      </div>
                        </div>
                      </td>
                      <td>
                        <p class=" font-weight-bold mb-0"><?php echo $row['username'];  ?></p>
                      </td>
                      <td class="align-middle text-center ">
                      <p class=" font-weight-bold mb-0"><?php echo $row['email'];  ?></p>
                      </td>
                      <td class="align-middle text-center ">
                      <p class=" font-weight-bold mb-0"><?php echo $row['fullname'];  ?></p>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary  font-weight-bold"><?php echo $row['reg_date'];  ?></span>
                      </td>
                      <td class="align-middle">
                      <?php if($row['reg_state']==0) {  ?>
                           <a href="member.php?do=Activ&user_id=<?php echo 
                           $row['user_id'];?>" class="btn btn-dark btn-sm" role="button">
                           <i class='fas fa-user-clock' style='font-size:15px'></i>
                           </a>
                        <?php 
                           }
                            else
                           {
                        ?>
                             <a href="member.php?do=Edit&user_id=<?php echo $row['user_id'];?>"
                              class="btn btn-primary btn-sm" role="button">
                              <i class="fa fa-edit" style="font-size:15px"></i>
                            </a>
                        <?php
                           }
                         ?>
                             <a href="member.php?do=Delete&user_id=<?php echo $row['user_id'];?>" 
                             class="btn btn-danger btn-sm confirm" role="button">
                             <i class='fas fa-trash-alt' style='font-size:15px'></i>
                             </a>
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
      </div>
                

        </div>
        <?php 
          }}
          else
          {

            header('location: index.php');
          }
        }
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
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Add Member</h4>
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
                <form role="form" class="text-start" method="POST" action="?do=Insert" name="mem">
                  <div class="input-group input-group-outline my-3">
                  <input class="form-control" type="text" name="username"  autocomplete="off" required="required" placeholder="User Name"/>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                  <input class="form-control" type="password" name="pass"  autocomplete="new-password" required="required" placeholder="Password" />
                  </div>
                  <div class="input-group input-group-outline mb-3">
                  <input class="form-control" type="email" name="email" placeholder="Email"  required="required" />
                  </div>
                  <div class="input-group input-group-outline mb-3">
                  <input class="form-control" type="text" name="full"  required="required" placeholder="Full Name"/>  
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
    
 /////////-------activ member---------////////       
        elseif($do == 'Activ')
        {

          $userid=isset($_GET['user_id']) && is_numeric($_GET['user_id'])? intval($_GET['user_id']):0;
        if($userid>0)
        {
          
          $stmt = $db->prepare("UPDATE users SET reg_state = 1 WHERE user_id = ? limit 1");
    $stmt->execute(array($userid));
    $count = $stmt->rowCount();
    header("location: member.php?do=Manage&user_id=".$_SESSION['id']);exit();
          
         }
         else
         {          
            header('location: index.php');


         


        }}
 //////########---------INSERT MEMBER----------########///////       
        elseif($do == 'Insert')
        {
///// GEt VARIABLE FROM POST MSTHOD//////
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
$user = $_POST['username'];
$email= $_POST['email'];
$full = $_POST['full'];
$pass=  $_POST['pass'];
$errorvalue = array(); // variable array to put in it error validation
$errorvalue[] = empty($user) ? 'UserName cannot be empty' :"";
$errorvalue[] = empty($email) ? 'Email cannot be empty' :"";
$errorvalue[] = empty($full) ? 'FullName cannot be empty' :"";
$errorvalue[] = empty($pass) ? 'PassWord cannot be empty' :"";
$errorvalue[] = strlen($user) < 3 ? 'UserName must be at least 3 characters' :"";
$errorvalue[] = strlen($full) < 3 ? 'FullName must be at least 3 characters' :"";
foreach($errorvalue as $key => $error ): //loop to echo error where items of array not null
      if($error != "") {echo errorstyle($error);} 
      else             {unset($errorvalue[$key]);}
endforeach;
if (empty($errorvalue)) // check if array is empty, meaning no errors, then do update
{    
// insert code here
$checkuser=checkitem('username','users',$user);
    $checkemail=checkitem('email','users',$email);
    if(($checkuser == 0) || ($checkemail == 0)){
$passhash=sha1($pass);
$stmt = $db->prepare("INSERT INTO users  (username,password,email,fullname) VALUE(:zuser,:zpass,:zmail,:zname)");
$stmt->execute(array(
    ':zuser'=>$user,
    ':zpass'=>$passhash,
    ':zmail'=>$email,
    ':zname'=>$full
));
    }
//////#########----select user name to get id fo new member to change tr color in table in mamge.php
$stmt=selectquery('user_id','users','where username =?',$user);
//$stmt=$db->prepare("select user_id from users where username=?");

//$stmt->execute(array($user));
$count = $stmt->rowCount();
$row   = $stmt->fetch();
 if($count>0){ header("location: member.php?do=Manage&user_id=".$_SESSION['id']."&row_id=".$row['user_id']."&case=new");exit(); }
  else{ header("location: member.php?do=Manage&user_id=".$_SESSION['id']);exit();  }

} 

}
else////------------- to check if user comming to this page by post method -----------//////////
{
   echo errorstyle("You Cant Enter This Page Directly");
}

        }
    ///////###############-----edit page -------------########/////////////////    
    elseif($do =='Edit'){
        $userid=isset($_GET['user_id']) && is_numeric($_GET['user_id'])? intval($_GET['user_id']):0;
        if($userid>0)
        {
            $stmt = $db->prepare("select * from users where user_id=? limit 1");
            $stmt->execute(array($userid));
            $count = $stmt->rowCount();
            $row   = $stmt->fetch();
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
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Update Member</h4>
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
                <form role="form" class="text-start" method="POST" action="?do=Update" name="umem">
                  <div class="input-group input-group-outline my-3">
                  <input type="hidden" name="id" value="<?php echo $row['user_id'] ?>" />
                  <input class="form-control" type="text" name="username"  autocomplete="off"
                   required="required" placeholder="User Name" value="<?php echo $row['username']; ?>" />
                  </div>
                  <div class="input-group input-group-outline mb-3">
                  <input class="form-control" type="password" name="newpass"  autocomplete="new-password" placeholder="Password" />
                  <input  type="hidden" name="oldpass" value="<?php echo $row['password'];  ?>"  />
                </div>
                  <div class="input-group input-group-outline mb-3">
                  <input class="form-control" type="email" name="email" placeholder="Email" 
                   required="required" value="<?php echo $row['email']; ?>" />
                  </div>
                  <div class="input-group input-group-outline mb-3">
                  <input class="form-control" type="text" name="full"  required="required"
                   placeholder="Full Name" value="<?php echo $row['fullname']; ?>"/>  
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
          else
          {
              echo errorstyle("There is no INfo Wthic Id");

          }
        } else
        {
            echo errorstyle("There Is No Correct Id");
        }
        
        }
         elseif($do == 'Delete')
         {
          $userid=isset($_GET['user_id']) && is_numeric($_GET['user_id'])? intval($_GET['user_id']):0;
          if($userid>0)
         {
          
          $stmt = $db->prepare("DELETE FROM users WHERE user_id = ?");
          $stmt->execute(array($_GET['user_id']));
          header("location: member.php?do=Manage&user_id=".$_SESSION['id']);exit();
          
         }
         else
         {          
            header('location: index.php');


         }


         }
        elseif($do =='Update')/////UPDATE PAGE/////
{

    ///// GEt VARIABLE FROM POST MSTHOD//////
        if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        ?>
    <h3 class="text-center mt-5 mb-5">UPDATE PROFILE</h3>
    <?php

    $id   = $_POST['id'];
    $user = $_POST['username'];
    $email= $_POST['email'];
    $full = $_POST['full'];
    $errorvalue = array(); // variable array to put in it error validation
$errorvalue[] = empty($user) ? 'UserName cannot be empty' :"";
$errorvalue[] = empty($email) ? 'Email cannot be empty' :"";
$errorvalue[] = empty($full) ? 'FullName cannot be empty' :"";
$errorvalue[] = strlen($user) < 3 ? 'UserName must be at least 3 characters' :"";
$errorvalue[] = strlen($full) < 3 ? 'FullName must be at least 3 characters' :"";
foreach($errorvalue as $key => $error ): //loop to echo error where items of array not null
          if($error != "") {echo errorstyle($error);} 
          else             {unset($errorvalue[$key]);}
endforeach;
if (empty($errorvalue)) // check if array is empty, meaning no errors, then do update
{    
    // update code here
    $pass= empty($_POST['newpass'])? $_POST['oldpass']: sha1($_POST['newpass']);
   
   try{
    $stmt = $db->prepare("UPDATE users SET username=?, email=?, fullname=?, password=? WHERE user_id = ? limit 1");
    $stmt->execute(array($user,$email,$full,$pass,$id));
    $count = $stmt->rowCount();
    $row   = $stmt->fetch();
    if($count>0){ header("location: member.php?do=Manage&user_id=".$_SESSION['id']."&row_id=".$_POST['id']."&case=update");exit(); } 
    else{ header("location: member.php?do=Manage&user_id=".$_SESSION['id']);exit();  }  
    }
catch (PDOException $e)
{

echo  errorstyle("This info exsite befor check your information");


}
     

} 
    
}
else
{
       echo errorstyle("You Cant Enter This Page Directly");
}
}else
{
  header('location: index.php'); exit(); 
 

}

       
    
    include $tpl.'footer.php';


}
else{ header('location: index.php'); exit(); }
 ob_end_flush();
 
?>