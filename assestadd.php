
<?php
session_start();

if (isset($_SESSION['id'])) {
$_SESSION['id'];
include'connection.php';

  if(isset($_GET['a']))
      {
      $mysql="SELECT serialassestid,tblasseststock.assestnamee,description,assestcost,serialno
      ,mas_assestname.coassestname
      FROM  php.mas_assestitem
      left join mas_assestname on mas_assestitem.assestname_id=php.mas_assestname.assestnameid 
      left join tblasseststock on mas_assestitem.stock_id=php.tblasseststock.stockid
      where serialassestid=".$_GET['a'];
        $retval1 = mysql_query( $mysql);
               
          $row1=mysql_fetch_array($retval1);
              
            $serialassestid=$row1['serialassestid'];
            $coassestname=$row1['coassestname'];
            $stock_id=$row1['stock_id'];
            $assestnamee = $row1['assestnamee'];
            $description=$row1['description'];
            $assestcost=$row1['assestcost'];
            $slno=$row1['serialno'];
         }
         if(!$_FILES['uploadFile']['error'])
       {
         $cvnm=$_FILES["uploadFile"]["name"];          
         move_uploaded_file($_FILES["uploadFile"]["tmp_name"], "uploads/".basename( $_FILES["uploadFile"]["name"]));
         
        }
 
    if(isset($_POST['submit']))  {
          {
          header("location:assestdetail.php");
          }
            
            $serialassestid1=$_POST['serialassestid'];
            $assestname_id=$_POST['assestname_id'];
            $coassestname=$_POST['coassestname'];
            $assestcost=$_POST['assestcost'];
            $cvnm=$_POST['description'];
            $serialno=$_POST['serialno'];
            $stock_id=$_POST['stock_id'];
            $assestnamee=$_POST['assestnamee'];

             $serialassestid1= mysql_real_escape_string($serialassestid1);
           $assestname_id = mysql_real_escape_string($assestname_id);

    
        if($serialassestid1=='')
          {
           $sql = "INSERT INTO mas_assestitem ". "(assestname_id, assestcost,description,serialno,stock_id) ". 
          "VALUES('".$coassestname."', '".$assestcost."','".$cvnm."','".$serialno."','".$assestnamee."')";
           
            $retval = mysql_query($sql);
            }
        else{
           $mysql1="UPDATE mas_assestitem SET assestname_id='".$coassestname."', assestcost='".$assestcost."', description='".$cvnm."',stock_id='".$assestnamee."'
            where serialassestid=".$serialassestid1; 
            $retval2 = mysql_query($mysql1); 

              }
          }
               
?>

<html>
<head>
    <title>adddetail</title>
    <link href="login.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.6-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script>

    function addconfig(){
      var x = document.forms["adddetail"]["assestnamee"].value;
        if (x == null || x == "") {
            alert("Assest Name must be filled out");
            return false;
        }
    else{
      var id = document.getElementById("serialassestid").value;
        if(id=="" )
        {

          var del=confirm("Are you sure you want to insert this record?");
          if (del==true){
           alert ("Record inserted")
           }else{
           alert("Unable to insert record")
           }
           return del;
          }
        
          else
        {
          var del=confirm("Are you sure you want to update this record?");
          if (del==true){
          alert ("Record updated")
          }else{
          alert("Unable to update record")
           }
           return del;
        
        }
      }
      }
      </script>
</head>
<body>
  <div class="wrapper">
   <div class="header" height="20%" width="100%">
   </div>
    <div class="drop">
      <ul class="drop_menu">
      <li>
        <a href='dashboard.php'>Dashboard</a>
      </li>
      <li>
        <a href='#'>Employee</a>
      <ul>
      <li>
        <a href='empdetail.php'>Employee Detail</a></li>
      <li>
        <a href='empadd.php'>Add Employee</a></li>
      </ul>
      </li>
      <li>
        <a href='#'>Asset</a>
      <ul>
      <li>
        <a href='assestdetail.php'>Asset Detail</a></li>
      <li>
        <a href='assestadd.php'>Add Asset</a></li>
      </ul>
      </li>
      <li>
        <a href='#'>Stock Detail</a>
      <ul>
        <li>
          <a href='stockdetail.php'>Stock Detail</a></li>
        <li>
          <a href='addstockdetail.php'> Add Stock Asset</li>
      </ul>
        <li><a href='#'>Assignment</a>
      <ul>
      <li><a href='transactiondetail.php'>Assignment Detail</a></li>
      <li><a href='addtransactiondetail.php'> Add Assignment</a>
      </li>
      </ul>
  </ul>
</div>
<hr>
    <div class="wrapper1" width="100%">
      <div class="link" width="20%">
        <ol>
          <h3 style="color:grey;"><img src="img/link.png" height="40px" width="40px">
            <span style="border-bottom: solid 4px;"> <u>Quick links</u></span></img></h3>
          <a href="dashboard.php" disable="true"><li type= "disc" class="active">Dashboard</li></a>
          <a href="empdetail.php"><li type="disc">Employee detail</li></a>
      
          <a href="stockdetail.php" ><li type="disc">Stock detail</li></a>
          <a href="assestdetail.php" ><li type="disc">Asset detail</li></a>
      
          <a href="transactiondetail.php"><li type="disc">Assignment</li></a>
   
          <a href="logout.php"><li type="disc">logout</li></a>
         </ol>
       </div>
    
  <div class="contnt" align="right" width="80%">
  <div class="panel panel-primary">
   <div class="panel-heading">
    <h3 class="panel-title">Add Asset</h3>
   </div>
   <div class="panel-body" id="cntnt">
    <form name="adddetail" method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>" autocomplete="off" enctype="multipart/form-data">
      <table width = "100%" height="49%" cellspacing = "4" 
           cellpadding = "4">
        
      <tr>
        <td><input name = "serialassestid" type = "hidden" id = "serialassestid" value="<?php echo $serialassestid;?>">
        </td>
      </tr>
           
        
      <tr>
      <td width = "200">Asset:</td>
      <td>
        <select name="coassestname">
          <option selected="selected">select asset </option>
        <?php
          $select="SELECT * FROM php.mas_assestname";
          $res1= mysql_query($select);

          while($row2=mysql_fetch_array($res1))
          {
          echo '<option value="'. $row2['assestnameid'].'"'.($coassestname==$row2['coassestname'] ? '
           selected=\"selected\"' : '') . '>' . $row2['coassestname'] . '</option>';
                        
          }
        ?>
                  
        </select><br/>
      </td>
      </tr>

      <tr>
      <td width = "200">Asset Name: </td>
      <td>
        <select name="assestnamee">
          <option selected="selected">select asset name</option>
          <?php
              $select="SELECT * FROM php.tblasseststock";
              $res= mysql_query($select);

              while($row3=mysql_fetch_array($res))
              {
                echo '<option value="'. $row3['stockid'].'"'.($assestnamee==$row3['assestnamee'] ? ' 
                selected=\"selected\"' : '') . '>' . $row3['assestnamee'] . '</option>';
                    
              }
          ?>
              
            </select><br />
       </td>
       </tr>

       <tr>
          <td width = "200">Asset cost:</td>
          <td><input name = "assestcost" type = "text" id = "assestcost" value= "<?php echo $assestcost;?>"></td>
       </tr>
                
       <tr>
          <td width = "200">Serial No:</td>
          <td><input name = "serialno" type = "text" id = "serialno" value= "<?php echo $slno;?>"></td>
       </tr>
       <tr>
          <td width = "200">Description: </td>
          <td><input type="file" name="uploadFile"></input> </td>
       </tr>

       <tr>
        <td></td>
        <td>
        <input type="submit" name="submit" id="save" value="save" onclick="return addconfig();"></input> </td>                           
       </tr>
        
                  
   </table>
  </form>
 </div>
 </div>
</div>
</div>
<div class="footer">
  <h3 align="center">Computer assest management project<br>&copy;Relyon softech limited<br>&reg; certified company</h3>
</div>
</div>
</body>
</html>
<?php

}
else
  header("location:mainlogin.php");
?>
