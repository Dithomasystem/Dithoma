<?php
session_start();
//echo $_SESSION['id'];
//$_SESSION['msg'];
include("dbconnection.php");
include("checklogin.php");
check_login();
if(isset($_POST['send']))
{
$count_my_page = ("hitcounter.txt");
$hits = file($count_my_page);
$hits[0] ++;
$fp = fopen($count_my_page , "w");
fputs($fp , "$hits[0]");
fclose($fp);
$tid=$hits[0];
$email=$_SESSION['login'];
$subject=$_POST['subject'];
$tt=$_POST['tasktype'];
$priority=$_POST['priority'];
$ticket=$_POST['description'];
//$ticfile=$_FILES["tfile'"]["name"];
$st="Open";
$pdate=date('Y-m-d');
//move_uploaded_file($_FILES["tfile"]["tmp_name"],"ticketfiles/".$_FILES["tfile"]["name"]);
$a=mysqli_query($con,"insert into ticket(ticket_id,email_id,subject,task_type,prioprity,ticket,status,posting_date)  values('$tid','$email','$subject','$tt','$priority','$ticket','$st','$pdate')");
if($a)
{
echo "<script>alert('Ticket Genrated'); location.replace(document.referrer)</script>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>DITHOMA| Create Application ticket</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />

<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
</head>
<body class="">
<?php include("header.php");?>
<div class="page-container row-fluid">	
	<?php include("leftbar.php");?>
	<div class="clearfix"></div>
    <!-- END SIDEBAR MENU --> 
  </div>
  </div>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE CONTAINER-->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
		<div class="page-title">	
			<h3>Create Application ticket</h3>
             <div class="row">
                        <div class="col-md-12">
                            
                            <form class="form-horizontal" name="form1" method="post" action="" onSubmit="return valid();">
                            <div class="panel panel-default">
                             
                                <div class="panel-body bg-white">      
                                    <?php if(isset($_SESSION['msg1'])): ?>                                                                  
                                    <p align="center" style="color:#FF0000"><?=$_SESSION['msg1'];?><?=$_SESSION['msg1']="";?></p>
                                    <?php endif; ?>
                                    <div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Full Name</label>
    <div class="col-md-6 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
            <input type="text" name="full_name" id="full_name" value="" required class="form-control"/>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Date of Birth</label>
    <div class="col-md-6 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
            <input type="date" name="birthdate" id="birthdate" value="" required class="form-control"/>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Nationality</label>
    <div class="col-md-6 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
            <input type="text" name="nationality" id="nationality" value="" required class="form-control"/>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Address</label>
    <div class="col-md-6 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
            <textarea name="address" id="address" rows="4" required class="form-control"></textarea>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">High School Name</label>
    <div class="col-md-6 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
            <input type="text" name="high_school" id="high_school" value="" required class="form-control"/>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">High School GPA</label>
    <div class="col-md-6 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
            <input type="text" name="high_school_gpa" id="high_school_gpa" value="" required class="form-control"/>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Intended Major</label>
    <div class="col-md-6 col-xs-12">
        
            <input type="text" name="major_interest" id="major_interest" value="" required class="form-control"/>
        
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Transcripts (Upload)</label>
    <div class="col-md-6 col-xs-12">
       
            <input type="file" name="transcripts" id="transcripts" accept=".pdf,.doc,.docx" required class="form-control"/>
       
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Matriculation Documents (Upload)</label>
    <div class="col-md-6 col-xs-12">
      <input type="file" name="matriculation_documents" id="matriculation_documents" accept=".pdf,.doc,.docx" required class="form-control"/>
       
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Resume/CV (Upload)</label>
    <div class="col-md-6 col-xs-12">
          <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" required class="form-control"/>
       
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">ID(Upload)</label>
    <div class="col-md-6 col-xs-12">
  <input type="file" name="essay" id="essay" accept=".pdf,.doc,.docx" required class="form-control"/>
    </div>
</div>
<!-- Add other fields as needed -->

									
									
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Gender</label>
    <div class="col-md-6 col-xs-12">                                                                                            
        <select name="gender" class="form-control select" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    </div>
</div>

									
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Race</label>
    <div class="col-md-6 col-xs-12">                                                                                            
        <select name="race" class="form-control select" required>
            <option value="asian">Asian</option>
            <option value="black">Black</option>
            <option value="white">White</option>
            <option value="hispanic">Hispanic</option>
            <option value="other">Other</option>
        </select>
    </div>
</div>

									
									  
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Universities in South Africa</label>
    <div class="col-md-6 col-xs-12">
        <label class="checkbox-inline">
            <input type="checkbox" name="universities[]" value="University of Cape Town"> University of Cape Town
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" name="universities[]" value="University of Witwatersrand"> University of Witwatersrand
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" name="universities[]" value="Stellenbosch University"> Stellenbosch University
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" name="universities[]" value="University of Pretoria"> University of Pretoria
        </label>
        <!-- Add more universities as needed -->
    </div>
</div>

									
								
                                    </div>
                                    
                                
                                    
                                
                                    
                               
                                    
                                    

                                </div>
								
                                <div class="panel-footer">
                                    <button class="btn btn-default">Clear Form</button>                                    
                                    <input type="submit" value="Send" name="send" class="btn btn-primary pull-right">
                                </div>
                            </div>
                            </form>
                            
                        </div>
                    </div>                    
            	
		</div>
    </div>
  </div>

 </div>
<script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="assets/plugins/breakpoints.js" type="text/javascript"></script> 
<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
<script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
<script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="assets/js/core.js" type="text/javascript"></script> 
<script src="assets/js/chat.js" type="text/javascript"></script> 
<script src="assets/js/demo.js" type="text/javascript"></script> 

</body>
</html>