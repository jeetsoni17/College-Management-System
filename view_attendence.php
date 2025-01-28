<?php
    require("conection/connect.php");

	$msg="";
	$opr="";
	if(isset($_GET['opr']))
	$opr=$_GET['opr'];
	
if(isset($_GET['rs_id']))
	$id=$_GET['rs_id'];
	
	if($opr=="del")
{
	$del_sql=mysqli_query($conn,"DELETE FROM stu_score_tbl WHERE ss_id=$id");
	if($del_sql)
		$msg="<div style='background-color: white;padding: 20px;border: 1px solid black;margin-bottom: 25px;''>"
                . "<span class='p_font'>"
                . "1 Record Deleted... !"
                . "</span>"
                . "</div>";
	else
		$msg="Could not Delete :".mysql_error();	
			
}
	echo $msg;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style_view.css" />
<title>Untitled Document</title>
</head>

<body>
<div class="btn_pos">
        <form method="post">
            <input type="date" id="attDate" name="attDate"><br>
            <div class="btn_pos_search">
            <input type="submit" class="btn btn-primary btn-large" value="Search"/>&nbsp;&nbsp;
            <a href="?tag=score_entry"><input type="button" class="btn btn-large btn-primary" value="Register new" name="butAdd"/></a>
            </div>
        </form>
    </div><br><br>
    
<br />
<div class="table_margin">
<table class="table table-bordered">
        <thead>
            <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">Students ID </th>
            <th style="text-align: center;">Department Name</th>
            <th style="text-align: center;">Subject Name </th>
            <th style="text-align: center;">Date</th>
            <th style="text-align: center;">Attendance</th>
            
            <th style="text-align: center;" colspan="2">Operation</th>
        </tr>
        </thead>
        <?php
		
		$key="";
        $attDate ="";
	if(isset($_POST['searchtxt'])){
		$key=$_POST['searchtxt'];
        $attDate = $_POST['attDate'];}
	
	if($key !="")
        $sql_sel=mysqli_query($conn,"SELECT attend_tbl.*, 
            facuties_tbl.faculties_name, 
            sub_tbl.sub_name, 
            attend_tbl.attendance from attend_tbl 
            join facuties_tbl using(faculties_id) 
            join sub_tbl using(sub_id)  
            where stu_id  like '%$key%'
            AND attend_tbl.sub_id = sub_tbl.sub_id");
		//$sql_sel=mysqli_query($conn,"SElECT * FROM stu_score_tbl WHERE stu_id  like '%$key%' ");
	else
        //$sql_sel=mysqli_query($conn,"SELECT * FROM stu_score_tbl");
        $sql_sel=mysqli_query($conn,"SELECT attend_tbl.*, 
            facuties_tbl.faculties_name, 
            sub_tbl.sub_name, 
            attend_tbl.attendance from attend_tbl 
            join facuties_tbl using(faculties_id)  
            join sub_tbl using(sub_id)
            where attend_tbl.sub_id = sub_tbl.sub_id
            AND attend_tbl.Att_Date = '$attDate'");

	//$sql = mysqli_query($conn,"SELECT faculties_name FROM facuties_tbl")

    $i=0;
    while($row=mysqli_fetch_array($sql_sel)){
    $i++;
    ?>
      <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row['stu_id'];?></td>
            <td><?php echo $row['faculties_name'];?></td>
            <td><?php echo $row['sub_name'];?></td>
            <td><?php echo $attDate ?></td>
            <td><?php echo $row['attendance'];?></td>
            <td align="center"><a href="?tag=score_entry&opr=upd&rs_id=<?php echo $row['ss_id'];?>"><img style="-webkit-box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px 0px 0px 0px rgba(50, 50, 50, 0.75);box-shadow:         0px 0px 0px 0px rgba(50, 50, 50, 0.75);" src="picture/update.png" height="20" alt="Update" /></a></td>
            <td align="center"><a href="?tag=view_scores&opr=del&rs_id=<?php echo $row['ss_id'];?>"><img style="-webkit-box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px 0px 0px 0px rgba(50, 50, 50, 0.75);box-shadow:         0px 0px 0px 0px rgba(50, 50, 50, 0.75);" src="picture/delete.jpg" height="20" alt="Delete" /></a></td>
        </tr>
        
    <?php
		
    }
    ?>
    </table>
</div>
</body>
</html>