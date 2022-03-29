<?php
include("function/alert.php");
include("db/dbconnect.php");
?>

<html>
    <body>

        
        
        <main class="container">

                        <div class="starter-template">
                            <center>
                                <h1>แก้ไข ข้อมูลหนังสือค้างชำระ</h1>
                            </center>
                            <br><br>
                           
                             <?php
                
                 $mysqli=mysqli_connect("localhost","root","", "se_project") or die(mysql_error());
                 if(isset($_GET['id']))
                     {
                      $sql = "Select * from payment_reminder where id=".$_GET['id'];
                      $result = $mysqli->query($sql);
                       while($data = $result->fetch_object()){
                            $name = $data->name;
                            $lastname = $data->lastname;
                            $house_number = $data->house_number;
                            $arrears = $data->arrears;
                            $id = $data->id;
                        ?>
                            <form method="post" action="">
                                <input type="hidden" id="id" name="id" value=<?php echo $id; ?>>
                                
                                 <div class="form-group">
                               <label for="text">ชื่อ</label>
                               <input type="text" class="form-control" name="name"  value=<?php echo $name; ?>>
                            </div>
                                
                            <div class="form-group">
                                <label for="text">นามสกุล</label>
                                <input type="text" class="form-control" name="lastname" value=<?php echo $lastname; ?> >    
                            </div>
                                
                                <div class="form-group">
                                <label for="text">บ้านเลขที่</label>
                                <input type="text" class="form-control" name="house_number" value=<?php echo $house_number; ?> >    
                            </div>
                                
                                <div class="form-group">
                                <label for="text">ค้างชำระ</label>
                                <input type="text" class="form-control" name="arrears" value=<?php echo $arrears; ?> >    
                            </div>
                                
                                
                                
                                
                      
                            <br><br>
                                
                                <input class="btn btn-primary" type="submit" name="edit" value="บันทึก" >
                            </form>
                      <?php
                     } // while 
                     
                } //if
                      ?>    
                            
                             <?php
			if (isset($_POST['edit']))
				{
                            $mysqli = new mysqli("localhost", "root", "", "se_project");
                            
                                $id = $_POST['id'];
                                $name = $_POST['name'];
                                $lastname = $_POST['lastname'];
                                $house_number = $_POST['house_number'];
                                $arrears = $_POST['arrears'];
                     
                             
				$check = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM `payment_reminder` WHERE `house_number` = '$house_number'"));
                
                                                  
                              if($check == 1){
                                  
                                  echo '      <script>
       setTimeout(function() {
        swal({
            title: "ผิดพลาด",
            text: "บ้านเลขที่นี้อยู่ในระบบอยู่แล้ว",
            type: "error"
        }, function() {
            window.location = "/Se_project/index.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
</script>';
                             
                                }else{
                                            $t_sql = "UPDATE payment_reminder SET "
             . "name = '".$name."', "
             . "lastname = '".$lastname."', "
             . "house_number = '".$house_number."', "
             . "arrears = '".$arrears."' , "
             . "timestamp = CURRENT_TIMESTAMP "
             . "WHERE id = '".$id."'";
                                
                                $t_result = mysqli_query($mysqli,$t_sql); 
                                
                                echo '      <script>
       setTimeout(function() {
        swal({
            title: "เสร็จสิ้น",
            text: "ข้อมูลเข้าสู่ฐานข้อมูลแล้ว",
            type: "success"
        }, function() {
            window.location = "/Se_project/index.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
</script>';
                                
                                }

                        
                                }

				?>
                            
                            
                        </div>

                    </main>
        
    </body>
</html>