<?php
require("conection/connect.php");

$id="";
$opr="";
if(isset($_GET['opr']))
    $opr=$_GET['opr'];

if(isset($_GET['rs_id']))
    $id=$_GET['rs_id'];
    
                        
if(isset($_POST['btn_sub'])){
    $stu_name=$_POST['sudenttxt'];
    $fa_name=$_POST['factxt'];
    $sub_name=$_POST['subjecttxt'];
    $attendance = $_POST['attendance'];
    $attDate = $_POST['attDate'];
    //$attDate = date('Y-m-d H:i:s', $attDate);

    echo $attDate;

//     for ($i=0; $i<sizeof ($attendance);$i++) {  
// $query="INSERT INTO attend_tbl VALUES ('".$attendance[$i]. "')";


$sql_ins=mysqli_query($conn,"INSERT INTO attend_tbl 
                        VALUES(
                            NULL,
                            '$stu_name',
                            '$fa_name' ,
                            '$sub_name',
                            '".$attendance[0]. "',
                            '$attDate'
                            )
                    ");
//echo "attendance".$attendance;
// $sql_ins=mysqli_query($conn,"INSERT INTO stu_score_tbl 
//                         VALUES(
//                             NULL,
//                             '$stu_name',
//                             '$fa_name' ,
//                             '$sub_name',
//                             '$miderm',
//                             '$final',
//                             '$note'
//                             )
//                     ");
 if($sql_ins==true)
     $msg="1 Row Inserted";
 // else
 //     $msg="Insert Error:".mysql_error();
    
}

//------------------uodate data----------
if(isset($_POST['btn_upd'])){
    $stu_id=$_POST['sudenttxt'];
    $faculties_id =$_POST['factxt'];
    $sub_id=$_POST['subjecttxt'];
    $miderm=$_POST['midermtxt'];
    $final=$_POST['finaltxt'];
    $note=$_POST['notetxt'];
    
    $sql_update=mysqli_query($conn,"UPDATE stu_score_tbl SET
                            stu_id='$stu_id' ,
                            faculties_id='$faculties_id' ,
                            sub_id='$sub_id' ,
                            miderm='$miderm' ,  
                            final='$final' ,
                            note='$note' 
                        WHERE ss_id=$id

                    ");
                    
if($sql_update==true)
    echo "<div style='background-color: white;padding: 20px;border: 1px solid black;margin-bottom: 25px;''>"
                . "<span class='p_font'>"
                . "Record Updated Successfully... !"
                . "</span>"
                . "</div>";
    else
        $msg="Update Failed...!";
    
    
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style_entry.css" />
</head>

<body>
<?php
require("conection/connect.php");
if($opr=="upd")
{
    $sql_upd=mysqli_query($conn,"SELECT * FROM stu_score_tbl WHERE ss_id=$id");
    $rs_upd=mysqli_fetch_array($sql_upd);
?>

<div class="panel panel-default">
        <div class="panel-heading"><h1><span class="glyphicon glyphicon-star-empty"></span> Score's Update Form</h1></div>
            <div class="panel-body">
            <div class="container">
                <p style="text-align:center;">Here, you'll update your score's records into database.</p>
            </div>
                  <form method="post" action="home.php">    
                    <div class="teacher_bday_box" style="margin-left: 0px;">
                    <div class="select_style">
                        <select name="sudenttxt" style="width: 200px;">
                                            <option>Student's name</option>
                            <?php
                                $student_name=mysqli_query($conn,"SELECT * FROM stu_tbl");
                                while($row=mysqli_fetch_array($student_name)){
                                     if($row['stu_id']==$rs_upd['stu_id'])
                                        $iselect="selected";
                                    else
                                        $iselect="";
                                ?>
                                <option value="<?php echo $row['stu_id'];?>" <?php echo $iselect ;?> > <?php echo $row['f_name']; echo" "; echo $row['l_name'];?> </option>
                                <?php   
                                }
                            ?>
                            
                    </select>
                </div>
            </div><br><br>
            
            <div class="teacher_bday_box" style="margin-left: 0px;">
                    <div class="select_style">
                                            <select name="factxt" style="width: 200px">
                                            <option>Department name</option>
                            <?php
                               $fac_name=mysqli_query($conn,"SELECT * FROM facuties_tbl");
                               while($row=mysqli_fetch_array($fac_name)){
                                    if($row['faculties_id']==$rs_upd['faculties_id'])
                                        $iselect="selected";
                                    else
                                        $iselect="";
                                ?>
                                <option value="<?php echo $row['faculties_id'];?>" <?php echo $iselect ;?> > <?php echo $row['faculties_name'];?> </option>
                                <?php 
                               }
                            ?>
                    </select>
                </div>
            </div><br><Br>
            
            <div class="teacher_bday_box" style="margin-left: 0px;">
                    <div class="select_style">
                                            <select name="subjecttxt" style="width: 200px">
                                            <option>Subject's name</option>
                            <?php
                               $subject=mysqli_query($conn,"SELECT * FROM sub_tbl");
                               while($row=mysqli_fetch_array($subject)){
                                   if($row['sub_id']==$rs_upd['sub_id'])
                                        $iselect="selected";
                                    else
                                        $iselect="";
                            ?>
                            <option value="<?php echo $row['sub_id'];?>" <?php echo $iselect ;?> > <?php echo $row['sub_name'];?> </option>
                            <?php      
                               }
                            ?>
                    </select>
                </div>
            </div><br><br>
                    
                    <div class="teacher_note_pos">
                    <input type="text" name="midermtxt" class="form-control" id="textbox" value="<?php echo $rs_upd['miderm'];?> "/>
                    </div><br>
                    
                    <div class="teacher_note_pos">
                    <input type="text" name="finaltxt" class="form-control" id="textbox" value="<?php echo $rs_upd['final'];?>" />
                    </div><br>
                    
                    <div class="text_box_pos">
                    <textarea name="notetxt" class="form-control" cols="23" rows="3"><?php echo $rs_upd['note'];?></textarea>
                    </div><br><br>
                    
                    <div>
                    <input type="submit" class="btn btn-primary btn-large" name="btn_upd" value="Update" id="button-in" title="Update"  />
                        <input type="reset" style="margin-left: 9px;" class="btn btn-primary btn-large" value="Cancel" id="button-in"/>
                    </div>
                    </div>
   </div>
</div><!-- end of style_informatios -->
<?php   
}
else
{
?>
    
    <div class="panel panel-default">
        <div class="panel-heading"><h1><span class="glyphicon glyphicon-star-empty"></span>Attendence Entry Form</h1></div>
            <div class="panel-body">
            <div class="container">
                <p style="text-align:center;">Here, you'll entry your Attendence records into database.</p>
            </div>
                  <form method="post">    
                    <div class="teacher_bday_box" style="margin-left: 0px;">
                    <div class="select_style">
                        <select name="sudenttxt" style="width: 200px;">
                                            <option>Student's name</option>
                            <?php
                                $student_name=mysqli_query($conn,"SELECT * FROM stu_tbl");
                                while($row=mysqli_fetch_array($student_name)){
                                ?>
                                <option value="<?php echo $row['stu_id'];?>"> <?php echo $row['f_name']; echo" "; echo $row['l_name'];?> </option>
                                <?php   
                                }
                            ?>
                            
                    </select>
                </div>
                </div><br><br>
            
            <div class="teacher_bday_box" style="margin-left: 0px;">
                    <div class="select_style">
                                            <select name="factxt" style="width: 200px">
                                            <option>Department name</option>
                            <?php
                               $fac_name=mysqli_query($conn,"SELECT * FROM facuties_tbl");
                               while($row=mysqli_fetch_array($fac_name)){
                                ?>
                                <option value="<?php echo $row['faculties_id'];?>"> <?php echo $row['faculties_name'];?> </option>
                                <?php 
                               }
                            ?>
                    </select>
                </div>
            </div><br><br>
            
            <div class="teacher_bday_box" style="margin-left: 0px;">
                    <div class="select_style">
                                            <select name="subjecttxt" style="width: 200px">
                                            <option>Subject's name</option>
                            <?php
                               $subject=mysqli_query($conn,"SELECT * FROM sub_tbl");
                               while($row=mysqli_fetch_array($subject)){
                            ?>
                            <option value="<?php echo $row['sub_id'];?>"> <?php echo $row['sub_name'];?> </option>
                            <?php      
                               }
                            ?>
                    </select>
                </div>
            </div><br><br>
               
               <div>
  <label>
    <input type="checkbox" class="radio" value="Present" name="attendance[]" />Present &nbsp;&nbsp;&nbsp;&nbsp; </label>
  <label>   
    <input type="checkbox" class="radio" value="Absent" name="attendance[]" />Absent</label>
    </div><br>
             <input type="date" id="attDate" name="attDate"><br>
                <!-- <div class="teacher_note_pos">
                    <input type="number" class="form-control" name="finaltxt"  id="textbox" placeholder='End sem marks'/>
                </div> --><br>
                
                <!-- <div class="text_box_pos">
                    <textarea name="notetxt" cols="23" class="form-control" rows="3" placeholder='Add note..'></textarea>
                </div><br><br> -->
                
                <div>
                    <input type="submit" class="btn btn-primary btn-large" name="btn_sub" value="Submit" id="button-in"  />
                    <input type="reset" style="margin-left: 9px;" class="btn btn-primary btn-large" value="Cancel" id="button-in"/>                 
                </div>
                </form>
                </div>
    </div>
<?php
}
?>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="scriptNew.js"></script>
</body>
</html>