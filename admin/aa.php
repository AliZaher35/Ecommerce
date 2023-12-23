<div class="container mb-5 mt-5 text-center">
        <h3 class="text-center mt-5 mb-5">MANAG CATEGORISE</h3>
        <div class="card mb-3">
  <div class="card-header">
    <div class="row">
    <div class="col-md-2 col-sm-3 mb-1 mt-1">
    <?php if(isset($_GET['cat_id'])){ echo "<h4>".$_GET['cat_name']."</h4>"; }?>
          </div>
        <div class="col-md-2 col-sm-3 mb-1 mt-1">
        <?php if(isset($_GET['cat_id'])){?>

  <a href="categories.php?do=Delete&cat_id=<?php echo $_GET['cat_id']; ?>" class="confirm"><i class='fas fa-trash-alt' style='font-size:24px; color:#ffff'></i></a>
  <?php } ?>        
</div>
          
          <div class="col-md-2 col-sm-3 mb-1 mt-1">
            <?php if(isset($_GET['cat_id'])){?>
  <a href="categories.php?do=Edit&cat_id=<?php echo $_GET['cat_id']; ?>" >
  
  <i class="fa fa-edit" style="font-size:24px;color:#ffff"></i></a>
  <?php } ?>
          </div>
          <div class="col-md-1 col-sm-3 mb-1 mt-1 pull-right"> 
    <a href="categories.php?do=Add&user_id=<?php echo $_SESSION['id']?>"><i class="fa fa-plus-square" style="font-size:24px;color:#ffff"></i>
</a>
          </div>
          <div class="col-md-5 col-sm-3 mb-1 mt-1 pull-right ">
            <div class="row">
              <div class="col-md-4 ">
              ordering by:
              </div>
             <div class="col-md-2  ">
            <form method="POST"  >
            <select name="form_order" onchange="this.form.submit()">
            <option></option>
            <option <?php if(isset($_GET['q'])&&($_GET['q']=='cat_id')){ echo "selected='selected'";}
            elseif(isset($_POST['form_order'])&&($_POST['form_order']=='cat_id')){ echo "selected='selected'";}
            ?> value="cat_id">Id</option>
            <option <?php if(isset($_POST['form_order'])&&($_POST['form_order']=='cat_name')){ echo "selected='selected'";}?> value="cat_name">Name</option>
           <option <?php if(isset($_POST['form_order'])&&($_POST['form_order']=='ordering')){ echo "selected='selected'";}?> value="ordering">Ordering</option>
           </select>
           </form>
            </div>
           <div class="col-md-5"> 
          <a href="?do=Manage&user_id=<?php  echo $_SESSION['id']; ?>&ord=desc&q=<?php if(isset($_POST['form_order'])){echo $_POST['form_order'];} else{ echo 'null';} ?>">desc</a>
          <?php echo "|"?>
          <a href="?do=Manage&user_id=<?php  echo $_SESSION['id']; ?>&ord=asc&q=<?php if(isset($_POST['form_order'])){echo $_POST['form_order'];} else{ echo 'null';} ?>">Asc</a>   
               </div>
            </div> 
        </div>
          </div>
  </div>
  <div class="card-body">
    <div class="row">
        <div class="col-md-6">
       
        <table class="table table-hover  container">
  <thead class="">
    <tr class="table-dark">
      
      <th scope="col" style="font-size:24px;background-color:#f1ce02; border-radius:5px;">Categories Name</th>
      
    </tr>
  </thead>
  <tbody class="">
  <?php 
      foreach($row as $value ):
               
    ?>
<tr>
    
      <td scope="row" ><a  class="nav-link" style="font-size:20px" href="categories.php?do=Manage&user_id=<?php echo $_SESSION['id'];?>&cat_id=<?php echo $value['cat_id']; ?>&cat_name=<?php echo $value['cat_name'];?>" ><i class="fa fa-eye"></i> viev <?php  
      echo ":  ".$value['cat_name']; ?></a></td>
     
    </tr>


    <?php
      endforeach;   
    ?>
    
</tbody>
</table>

    
    </div>
        <div class="col-md-6">
            <h3 >Description:</h3>
            <p class="card-text"><?php
            if($do =='Manage'){

                $catid=isset($_GET['cat_id']) && is_numeric($_GET['cat_id'])? intval($_GET['cat_id']):0;
                if($catid>0){

                $stmt=selectquery('description,visib,allow_comment,allow_ads','categories','where cat_id=?',$catid);
                $row_des=$stmt->fetch();
                    echo "<p>" . $row_des['description'] . "</p>";
                }
            }
            ?></p>
            <?php if(isset($row_des['allow_ads'])&& isset($row_des['allow_comment'])&& isset($row_des['visib']))
             {?>
            <div class="row">
                <div class="col-md-4 mb-1 mtt-1">
                <?php
           
           if($row_des['allow_ads']==0){
                   
          
           
           ?>
           <span class="" style="background-color:darkolivegreen;color:antiquewhite;border-radius:5px; padding:2px">
             <i class="fa fa-close"></i>
           <?php  echo " Forbeddin Ads";  ?>
           </span>
           <?php }?>
           </div>
           <div class="col-md-5 mb-1 mtt-1">
           <?php
                       if($row_des['allow_comment']==0){
            ?>
           <span class="" style="background-color:chocolate;color:antiquewhite;border-radius:5px; padding:2px">
           <i class="fa fa-close"></i>
                <?php
                    echo "Forbidden Comment";
           ?>
            
            
           </span>
           <?php } ?>
           </div>
           <div class="col-md-3 mb-1 mtt-1">
           <?php
           
           if($row_des['visib']==0){
          ?>
           <span class="" style="background-color:#611f1f;color:antiquewhite;border-radius:5px; padding:2px">
            <!-- #region -->
            <i class="fa fa-eye"></i>
            <?php
                    echo " Hidden ";
    
            ?>
           </span>
           <?php }?>
           </div>

           </div>
           <?php }?>
        </div>
    </div>
</div>
</div>


        </div>