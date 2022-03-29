<?php
include("function/alert.php");
include("db/dbconnect.php");
?>

<?php
//index.php

$message = '';

if(isset($_POST["upload"]))
{
 if($_FILES['product_file']['name'])
 {
  $filename = explode(".", $_FILES['product_file']['name']);
  if(end($filename) == "csv")
  {
   $handle = fopen($_FILES['product_file']['tmp_name'], "r");
   while(($data = fgetcsv($handle)) !== FALSE)
   {
    //$id = $data[0];
    $name = $data[0];
    $lastname = $data[1];
    $house_number = $data[2];
    $arrears = $data[3];
    
    $prevQuery = "SELECT id FROM payment_reminder WHERE name = '".$data[0]."'";
    $prevResult = $connect->query($prevQuery);
    
    if($prevResult->num_rows > 0){
                    
        //. "timestamp = CURRENT_TIMESTAMP "
        
     $connect->query("UPDATE payment_reminder SET "
             . "name = '".$name."', "
             . "lastname = '".$lastname."', "
             . "house_number = '".$house_number."', "
             . "arrears = '".$arrears."'"            
             . "WHERE name = '".$name."'");
                }else{
                    // Insert member data in the database
      $connect->query("INSERT INTO payment_reminder (name, lastname, house_number, arrears, timestamp) "
              . "VALUES ('".$name."', '".$lastname."', '".$house_number."', '".$arrears."' , CURRENT_TIMESTAMP)");
                }
    }
    
   fclose($handle);
   header("location: index.php?updation=1");
  }
  else
  {
   $message = '<label class="text-danger">Please Select CSV File only</label>';
  }
 }
 else
 {
  $message = '<label class="text-danger">Please Select File</label>';
 }
}

if(isset($_GET["updation"]))
{
 $message = '<label class="text-success">Product Updation Done</label>';
   echo '      <script>
       setTimeout(function() {
        swal({
            title: "เสร็จสิ้น",
            text: "เข้าสู่ระบบเรียบร้อยแล้ว",
            type: "success"
        }, function() {
            window.location = "/Se_project/index.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
</script>';
}

$query = "SELECT * FROM payment_reminder";
$result = mysqli_query($connect, $query);
?>
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>หนังสือค้างชำระ</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
               
                 <h2 align="center">บันทึก & อัพเดทหนังสือเตือนค้างชำระ </a></h2>
   <br />
   
  
    
    
   <form method="post" enctype='multipart/form-data'>
    <p><label>ใส่ไฟล์ Csv เพื่อเพิ่มข้อมูลเข้าฐานข้อมูล)</label>
    <input type="file" name="product_file" /></p>
    <br />
    <input type="submit" name="upload" class="btn btn-info" value="Upload" />
   </form>
   

   
   
   
   <br />
   <?php echo $message; ?>
   <h3 align="center">ฐานข้อมูลหนังสือค้างชำระ</h3>
   <br />
  
   <a href="#add" role="button" class="btn btn-info" data-toggle="modal" style="padding:5px; float:right;"> เพิ่มข้อมูลเข้าสู่ระบบ </a>
       
      
       
       
                <div class="col-md-3">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="ก่อนวันที่" />  
                </div>  
                <div class="col-md-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="ถึงวันที่" />  
                </div>  
                <div class="col-md-3">  
                     <input type="button" name="filterdate" id="filterdate" value="ค้นหา" class="btn btn-success" />  
                </div>  
   
                 <label  class="input-group-prepend" style="padding:5px; float:right;"><span class="input-group-text">ค้นหา</span>
                  <input type="text" name="filter" placeholder="ค้นหาข้อมูล....." id="filter"></label>
              
                
                
                <div id="order_table">  
                     <table class="table table-bordered table-striped">
        <br>
     <tr>
         <th>ไอดี</th>
      <th>ชื่อ</th>
      <th>นามสกุล</th>
      <th>บ้านเลขที่</th>
      <th>ยอดค้างชำระ</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     while($row = mysqli_fetch_array($result))
       
     {
         
      
       
         
         
         
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
       <td>'.$row["name"].'</td>
       <td>'.$row["lastname"].'</td>
       <td>'.$row["house_number"].'</td>
       <td>'.$row["arrears"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_payment.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_payment.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_payment.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }
       
       echo '<td>'
       . '<a href="edit_payment.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_payment.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_payment.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
                    
                    
                    
                    
                </div>  
                
                 <div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <center>
                                                    <h5 class="modal-title" id="add">เพิ่มข้อมูลหนังสือค้างชำระ</h5>
                                                    </center>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
					<form method="post" enctype="multipart/form-data">
					<center>
						<table>
					
						
							<tr>
								<td><label  class="col-form-label">ชื่อ:</label>
                                                                    <input  class="form-control" type="text" name="name" placeholder="ใส่ชื่อ..." style="width:250px;" required></td>
							<tr/>
							<tr>
								<td><label  class="col-form-label">นามสกุล:</label>
                                                                    <input class="form-control" type="text" name="lastname" placeholder="ใส่นามสกุล..." style="width:250px;" required></td>
							</tr>
							
							<tr>
								<td><label  class="col-form-label">บ้านเลขที่:</label>
                                                                    <input class="form-control" type="number" name="house_number" placeholder="ใส่บ้านเลขที่..." style="width:250px;" required></td>
							</tr>
                                                        <tr>
								<td><label  class="col-form-label">ค้างชำระ:</label>
                                                                    <input class="form-control" type="number" name="arrears" placeholder="ใส่จำนวนเงิน..." style="width:250px;" required></td>
							</tr>
						
						</table>
					</center>
				</div>
                                                
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                    <input class="btn btn-primary" type="submit" name="add" value="เพิ่มข้อมูล" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
       
       <?php
			if (isset($_POST['add']))
				{
                            $mysqli = new mysqli("localhost", "root", "", "se_project");
                            
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
                                       $t_sql = "INSERT INTO payment_reminder (name, lastname, house_number, arrears, timestamp) "
                                 . "VALUES ('".$name."', '".$lastname."', '".$house_number."', '".$arrears."' , CURRENT_TIMESTAMP)";
                                
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
      </body>  
 </html>  
 <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filterdate').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"function/filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>
 
   <script>
  $(document).ready(function(){
    $('.btn-primary').click(function(){
        $('#xx').text($(this).data('id'));
    });
  })
</script>  
<script src="/Se_project/javascripts/filter.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
	$(document).ready( function() {
		
		$('.remove').click( function() {
		
		var id = $(this).attr("id");

		
		if(confirm("Are you sure you want to delete this product?")){
			
		
			$.ajax({
			type: "POST",
			url: "",
			data: ({id: id}),
			cache: false,
			success: function(html){
			$(".del"+id).fadeOut(2000, function(){ $(this).remove();}); 
			}
			}); 
			}else{
			return false;}
		});				
	});

</script>
