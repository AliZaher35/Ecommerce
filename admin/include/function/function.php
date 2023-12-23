<?php 
// function to change  title of page
function Gettitle()
{
global $titlename;
if(isset($titlename)){ echo $titlename;}else{echo 'Defult';}
}
//function to error 
function errorstyle($error) {
    // create an HTML-formatted error message
    $error1 = '<div class="container alert alert-danger mb-5 mt-5 col-lg-6">
    <strong><spam style="color: red">ERROR: </spam>' . $error . '</strong></div>';
    
    // set refresh header to redirect user
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
       // redirect to previous page
       echo $error1;
       header('refresh:6;url='.$_SERVER['HTTP_REFERER']);
       
       exit();
    } else {
       // redirect to index page
       echo $error1;
       header('refresh:6;url=index.php');
       exit();
    }
    
    // return the HTML-formatted error message
    
    
 }
////function to select query
function selectquery($colms,$tables,$condetions=null,$exe= null)
{
    global $db;
 $stmt = $db->prepare("select $colms from $tables $condetions ");
 if($exe == null){
 $stmt->execute();
 }
 else
 {
   $stmt->execute(array($exe)); 
 }
return $stmt; 
}
//////////functio check info in database//////
function checkitem($select,$tabels,$value)
{
$stmt= selectquery($select,$tabels,'where '.$select.'=?',$value);
$count= $stmt->rowcount();
$row= $stmt->fetch();
if($count > 0)
{

errorstyle('This '.$select.' is exesist try another '. $select);

}
 return ($count);
}