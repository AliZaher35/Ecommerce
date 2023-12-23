<?php
ob_start();
session_start();
$titlename='login';
if(isset($_SESSION['username'])) // to redirect the location to dashboard.php if session active
 { header('location: dashboard.php'); exit(); }
$nonamvbar = ''; // to unload navbar, we use  it only at pages no want tp show navbar nside it
include 'ini.php';


/////////// check if post request has any interies/////////
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
$username=$_POST['user'];
$pass=$_POST['pass'];
$passhash=sha1($pass);
$stmt = $db->prepare("select user_id,username,password from users where username= ? and password= ? and group_id =1 limit 1");
$stmt->execute(array($username,$passhash));
$count = $stmt->rowCount();
$row   = $stmt->fetch();

if($count>0)///// check if user name and pass are correct then the query returend one row
{
    $_SESSION['username']= $username;
    $_SESSION['id'] =$row['user_id'];
    header('location: dashboard.php');
    exit();
}
}
?>


<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-2 pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
              AZ Shop
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-up.html">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Sign Up
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-in.html">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Sign In
                  </a>
                </li>
              </ul>
              
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image:
     url('<?php echo $img;?>pexels-aleksandar-pasaric-325193.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Welcom</h4>
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
                <form role="form" class="text-start" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                  <div class="input-group input-group-outline my-3">
                    
                    <input type="text"  name="user" class="form-control" autocomplete="off" required placeholder="User Name">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    
                    <input type="password" name="pass" class="form-control" autocomplete="off" required placeholder="Password">
                  </div>
                 
                  <div class="text-center">
                    <input type="submit"  value="login" class="btn bg-gradient-primary w-100 my-4 mb-2"/>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>
<?php include $tpl ."footer.php";

ob_end_flush();
?>
