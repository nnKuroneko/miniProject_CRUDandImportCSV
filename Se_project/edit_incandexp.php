<?php
include("function/alert.php");
include("db/dbconnect.php");
?>

<html>
    <body>

        
        
        <main class="container">

                        <div class="starter-template">
                            <center>
                                <h1>แก้ไขข้อมูล รายรับ - รายจ่าย</h1>
                            </center>
                            <br><br>
                           
                             <?php
                
                 $mysqli=mysqli_connect("localhost","root","", "se_project") or die(mysql_error());
                 if(isset($_GET['id']))
                     {
                      $sql = "Select * from incomeandexpenses where id=".$_GET['id'];
                      $result = $mysqli->query($sql);
                       while($data = $result->fetch_object()){
                            $income = $data->income;
                            $expenses = $data->expenses;
                            $month = $data->month;
                            $id = $data->id;
                        ?>
                            <form method="post" action="">
                                <input type="hidden" id="id" name="id" value=<?php echo $id; ?>>
                                
                                 <div class="form-group">
                               <label for="text">รายรับ</label>
                               <input type="text" class="form-control" name="income"  value=<?php echo $income; ?>>
                            </div>
                                
                            <div class="form-group">
                                <label for="text">รายจ่าย</label>
                                <input type="text" class="form-control" name="expenses" value=<?php echo $expenses; ?> >    
                            </div>
                                
                                <div class="form-group">
                                <label for="text">เดือน</label>
                                <input type="text" class="form-control" name="month" value=<?php echo $month; ?> >    
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
                                $income = $_POST['income'];
                                $expenses = $_POST['expenses'];
                                $month = $_POST['month'];
     
                     
                             
				$check = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM `incomeandexpenses`WHERE 'month' ='$month' "));
                
                                                  
                              if($check == 1){
                                  
                                  echo '      <script>
       setTimeout(function() {
        swal({
            title: "ผิดพลาด",
            text: "เดือนนี้มีอยู่ในระบบแล้ว",
            type: "error"
        }, function() {
            window.location = "/Se_project/incandexp.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
</script>';
                                    
                                }else{
                                    
                                      $t_sql = "UPDATE incomeandexpenses SET "
             . "income = '".$income."', "
             . "expenses = '".$expenses."', "
             . "month = '".$month."', "
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
            window.location = "/Se_project/incandexp.php"; //หน้าที่ต้องการให้กระโดดไป
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