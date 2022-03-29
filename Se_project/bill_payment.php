
<!DOCTYPE html>
<?php

  $mysqli = new mysqli("localhost", "root", "", "se_project");
?>
<html lang="en">
<head>
    
    
		<script type="text/javascript">
		jQuery(document).ready(function($) {
		$('a[rel*=facebox]').facebox() 
		})
		</script>
		
		<script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
		</script>
    
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>บิลใบเสร็จ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
   
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     

                
                
                

</head>
<body>
    
			<form method="post" class="well"  style="background-color:#fff; overflow:hidden;">
                  
                            
                          
<table class="body-wrap">
    
    <tbody><tr>
        <td></td>
      
        
        <td class="container" width="600">
            <center>
            <div id="printablediv" class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="content-wrap aligncenter">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td class="content-block">  
                                        <h1><img src="/Se_project/image/iconhome.png" alt="" width="100" height="100" ></h1>
                                        <h2>Bills</h2>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td class="content-block">
                                        <table class="invoice">
                                            
                                            <?php
		$b_id = $_GET['id'];
		//$query = mysqli_query($mysqli, "SELECT payment_reminder.id,payment_reminder.name,payment_reminder.lastname,payment_reminder.house_number,payment_reminder.arrears"
                 //       . ",useracc.userid,useracc.firstname,useracc.lastname FROM `payment_reminder` INNER JOIN useracc on transaction.customerid = useracc.userid WHERE transaction_id = '$t_id'") or die (mysqli_error());
                
                $query = "SELECT * FROM payment_reminder WHERE id ='$b_id'";
                
                $result = mysqli_query($mysqli, $query);
      
		$fetch = mysqli_fetch_array($result);
                
                $status = $fetch['status'];
             
		echo "เวลา : ". $fetch['timestamp']."<br>";
     
                if($status == "1"){          
          echo " สถานะ : ชำระแล้ว";                                           
       }if($status == "2"){          
          echo " สถานะ : ค้างชำระ ";                                            
       }if($status == "0"){
          echo " สถานะ : รอการชำระ ";                                        
       }
                
                
		echo "<tbody><tr>";
                echo "<td>คุณ ".$fetch['name']." ".$fetch['lastname']." <br>ไอดีบิล #".$fetch['id']."<br> บ้านเลขที่ : ".$fetch['house_number']." </td></tr>";
                echo "<tr>";
                echo "<td>";
                echo "<table class='invoice-items' cellpadding='0' cellspacing='0'>";
                echo "<tbody><tr>";
                
             
		

                
		echo "<td>ค้างชำระ</td>";
		echo "<td class='alignright'>".$fetch['arrears']." บาท</td> </tr>";
		
                echo "<tr class='total'>";
                 echo "<td class='alignleft' width='80%'>ทั้งหมด</td>";
                  echo "<td class='alignright'>".$fetch['arrears']." บาท</td>";
                   
              
                      
		?>
                         
                        
                              <legend></legend>
                    <!--          
                                <tr>
                                    <td class="content-block">
                                        <a href="#">View in browser</a>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="content-block">
                                        Company Inc. 123 Van Ness, San Francisco 94102
                                        
                                    </td>
                                </tr>
                                -->
                            </tbody></table>
                        </td>
                        
                    </tr>
                     
                    </table>
                            
                </tbody>
                
                            </table>
                            
                </div>
            </center>
                <div class='pull-right'>
	<div class="add"><a onclick="javascript:printDiv('printablediv')" name="print" style="cursor:pointer;" class="btn btn-info"><i class="icon-white icon-print"></i> ปริ้นใบเสร็จ</a></div>
	</div>
         

            </div>
        </td>
        <td>
            
        </td>
    </tr>
</tbody>
</table>
                            </form>

<style type="text/css">
/* -------------------------------------
    GLOBAL
    A very basic CSS reset
------------------------------------- */
* {
    margin: 0;
    padding: 0;
    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    box-sizing: border-box;
    font-size: 14px;
}

img {
    max-width: 100%;
}

body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    width: 100% !important;
    height: 100%;
    line-height: 1.6;
}

/* Let's make sure all tables have defaults */
table td {
    vertical-align: top;
}

/* -------------------------------------
    BODY & CONTAINER
------------------------------------- */
body {
    background-color: #f6f6f6;
}

.body-wrap {
    background-color: #f6f6f6;
    width: 100%;
}

.container {
    display: block !important;
    max-width: 600px !important;
    margin: 0 auto !important;
    /* makes it centered */
    clear: both !important;
}

.content {
    max-width: 600px;
    margin: 0 auto;
    display: block;
    padding: 20px;
}

/* -------------------------------------
    HEADER, FOOTER, MAIN
------------------------------------- */
.main {
    background: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 3px;
}

.content-wrap {
    padding: 20px;
}

.content-block {
    padding: 0 0 20px;
}

.header {
    width: 100%;
    margin-bottom: 20px;
}

.footer {
    width: 100%;
    clear: both;
    color: #999;
    padding: 20px;
}
.footer a {
    color: #999;
}
.footer p, .footer a, .footer unsubscribe, .footer td {
    font-size: 12px;
}

/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
    font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    color: #000;
    margin: 40px 0 0;
    line-height: 1.2;
    font-weight: 400;
}

h1 {
    font-size: 32px;
    font-weight: 500;
}

h2 {
    font-size: 24px;
}

h3 {
    font-size: 18px;
}

h4 {
    font-size: 14px;
    font-weight: 600;
}

p, ul, ol {
    margin-bottom: 10px;
    font-weight: normal;
}
p li, ul li, ol li {
    margin-left: 5px;
    list-style-position: inside;
}

/* -------------------------------------
    LINKS & BUTTONS
------------------------------------- */
a {
    color: #1ab394;
    text-decoration: underline;
}

.btn-primary {
    text-decoration: none;
    color: #FFF;
    background-color: #1ab394;
    border: solid #1ab394;
    border-width: 5px 10px;
    line-height: 2;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    display: inline-block;
    border-radius: 5px;
    text-transform: capitalize;
}

/* -------------------------------------
    OTHER STYLES THAT MIGHT BE USEFUL
------------------------------------- */
.last {
    margin-bottom: 0;
}

.first {
    margin-top: 0;
}

.aligncenter {
    text-align: center;
}

.alignright {
    text-align: right;
}

.alignleft {
    text-align: left;
}

.clear {
    clear: both;
}

/* -------------------------------------
    ALERTS
    Change the class depending on warning email, good email or bad email
------------------------------------- */
.alert {
    font-size: 16px;
    color: #fff;
    font-weight: 500;
    padding: 20px;
    text-align: center;
    border-radius: 3px 3px 0 0;
}
.alert a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}
.alert.alert-warning {
    background: #f8ac59;
}
.alert.alert-bad {
    background: #ed5565;
}
.alert.alert-good {
    background: #1ab394;
}

/* -------------------------------------
    INVOICE
    Styles for the billing table
------------------------------------- */
.invoice {
    margin: 40px auto;
    text-align: left;
    width: 80%;
}
.invoice td {
    padding: 5px 0;
}
.invoice .invoice-items {
    width: 100%;
}
.invoice .invoice-items td {
    border-top: #eee 1px solid;
}
.invoice .invoice-items .total td {
    border-top: 2px solid #333;
    border-bottom: 2px solid #333;
    font-weight: 700;
}

/* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
@media only screen and (max-width: 640px) {
    h1, h2, h3, h4 {
        font-weight: 600 !important;
        margin: 20px 0 5px !important;
    }

    h1 {
        font-size: 22px !important;
    }

    h2 {
        font-size: 18px !important;
    }

    h3 {
        font-size: 16px !important;
    }

    .container {
        width: 100% !important;
    }

    .content, .content-wrap {
        padding: 10px !important;
    }

    .invoice {
        width: 100% !important;
    }
}

</style>

<script type="text/javascript">

</script>
</body>
</html>