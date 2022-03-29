<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "se_project");  
      $output = '';  
      $query = "  
           SELECT * FROM incomeandexpenses  
           WHERE timestamp BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {
              
           
               
               
               $status = $row['status'];
                 $id = $row['id'];
                 
        $output .= '<br> ';
        
        $output .= '<tr> ';
        $output .= '<td>'.$row["id"].'</td>';
        $output .= '<td>'.$row["income"].'</td>';
        $output .= '<td>'.$row["expenses"].'</td>';
        $output .= '<td>'.$row["month"].'</td>';
        $output .= '<td>'.$row["timestamp"].'</td>';
if($status == "1"){
           
          $output .= '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
                                               
       }if($status == "2"){
           
          $output .= '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
                                               
       }if($status == "0"){
          $output .= '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
                                               
       }
        $output .= '<td><a href="status_payment.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
        $output .= '<td><a href="edit_payment.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a> ';
        $output .= '<a href="bill_payment.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a> ';
        $output .= '<a href="function/delete_payment.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a> </td>';

           
           

      
    
       
        
       
                 $output .= '   </tr>  ';
               
           }  
           
           
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">ไม่เจอข้อมูลที่คุณต้องการ</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>
