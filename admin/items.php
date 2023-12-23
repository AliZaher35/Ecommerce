<?php
ob_start();
session_start();
if(isset($_SESSION['username']))
{
    $titlename='Items';//vareiable to put title name to page
    include 'ini.php';
    $do=isset($_GET['do'])? $_GET['do'] : 'Manage';
    if(($do =='Manage')){
        
        $userid=isset($_GET['user_id']) && is_numeric($_GET['user_id'])? intval($_GET['user_id']):0;
        if($userid>0)
        {
          
           $stmt= selectquery('item_id','items');
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
                <a class="text-white" href="items.php?do=Add&user_id=<?php echo $_SESSION['id']?>">
                <i class="fa fa-plus-square" style="font-size:24px;color:#ffff"></i>
                 Add Item 
                </a>
                </h6>
              </div>
              
            </div>
            <div class="card-body px-2 pb-2" >
              <div class="table-responsive p-0" >
                <table class="table align-items-center mb-0 " >
                  <thead >
                    <tr style="background-color:khaki">
                      <th><p class=" font-weight-bold mb-0">Name</p></th>
                      <th><p class=" font-weight-bold mb-0">Description</p></th>
                      <th><p class=" font-weight-bold mb-0">Countray</p></th>
                      <th><p class=" font-weight-bold mb-0">Price</p></th>
                      <th>Add_Date</th>
                      <th>ٍStatus</th>
                      <th>ٍRating</th>
                      <th>Control</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
      foreach($rowid as $value ):
        # code...
        ///function to select query
        
        $stmt=selectquery('*','items','where item_id=?',$value);
        $row= $stmt->fetch();

        
               
    ?>
                  <tr>
                 
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
                          <h6 class="mb-0 text-sm"><?php    echo $row['name'];      ?></h6>
                                                      </div>
                        </div>
                      </td>
                      <td>
                        <p class=" font-weight-bold mb-0"><?php echo $row['des'];  ?></p>
                      </td>
                      <td class="align-middle text-center ">
                      <p class=" font-weight-bold mb-0"><?php echo $row['countray'];  ?></p>
                      </td>
                      <td class="align-middle text-center ">
                      <p class=" font-weight-bold mb-0"><?php echo $row['price'];  ?></p>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary  font-weight-bold"><?php echo $row['add_date'];  ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary  font-weight-bold"><?php echo $row['states'];  ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary  font-weight-bold"><?php echo $row['rating'];  ?></span>
                      </td>
                      <td class="align-middle">
                             <a href="member.php?do=Edit&item_id=<?php echo $row['item_id'];?>"
                              class="btn btn-primary btn-sm" role="button">
                              <i class="fa fa-edit" style="font-size:15px"></i>
                            </a>
                             <a href="member.php?do=Delete&item_id=<?php echo $row['item_id'];?>" 
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
    
