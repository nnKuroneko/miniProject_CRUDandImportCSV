<?php
include("function/alert.php");
include("db/dbconnect.php");
?>

<div id="my_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                  
                                            
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <center>
                                                        <h5 class="modal-title" id="add">ปรับสถานะ <span id='xx'></span></h5>
                                                    </center>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                
                                                
                                                
                                                <div class="modal-body">
					<form method="post" enctype="multipart/form-data">
					<center>
						<table>
							<tr>
                                                            <td>
                                                                 <div class="col-md-12">
                                                                     <label for="f-option3">ปรับสถานะ : ชำระแล้ว </label>
                                                                     <input type="radio" name="status" class="radio" value="1"> 
                                                                     <br>
                                                                 </div>
            
                                                            </td>
                                                                    

							</tr>
                                                        
                                                        <tr>
							
								<td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
							
							</tr>
							
							<tr>
								<td>
                                                                    <div class="col-md-12">
                                                                     <label for="f-option3">ปรับสถานะ : ค้างชำระ </label>
                                                                     <input type="radio" name="status" class="radio" value="2"> 
                                                                     <br>
                                                                 </div>
                                                                </td>
							</tr>
                                                        
                                                        <tr>
                                                            <td>
                                                                 <div class="col-md-12">
                                                                     <label for="f-option3">ปรับสถานะ : รอการชำระ </label>
                                                                     <input type="radio" name="status" class="radio" value="0"> 
                                                                     <br>
                                                                 </div>
            
                                                            </td>
                                                                    

							</tr>
						
						</table>
					</center>
				</div>
                                                
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                    <input class="btn btn-primary" type="submit" name="add" value="แก้ไข" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
       
       
    
       
         <?php
			if (isset($_POST['add']))
				{
                            $mysqli = new mysqli("localhost", "root", "", "se_project");
                            
                                $idcase = $_POST['id'];
                                if (isset($_GET['id'])) { 
                                
                                $sql = "Select * from payment_reminder where id=". $_GET['id'];
                                $status = $_POST['status'];
                                $result = $mysqli->query($sql);
                                

                                $t_sql = "UPDATE payment_reminder SET status='$status' , timestamp=CURRENT_TIMESTAMP where id=". $_GET['id'];  
                                $t_result = mysqli_query($mysqli,$t_sql); 
                                                        
                             //   echo "<script>alert('คุณได้ทำการสั่งซื้อเรียบร้อยแล้ว')</script>";	
                             //   header( "refresh: 2; url=/house_rental/homepage_detail.php" );
                             //   exit(0);
                                
                                 echo '      <script>
       setTimeout(function() {
        swal({
            title: "เสร็จสิ้น",
            text: "คุณได้ทำการกรอกแบบฟอร์มแล้ว",
            type: "success"
        }, function() {
            window.location = "/Se_project/index.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
</script>';
                    
                                }
              
                        
                        
                                }

				?>


  <script>
  $(document).ready(function(){
    $('.btn-primary').click(function(){
        $('#xx').text($(this).data('id'));
    });
  })
</script>  