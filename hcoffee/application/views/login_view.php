<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<style type="text/css">
@font-face
{
	src:url(<?php echo base_url();?>fonts/DroidSans.ttf);
	font-family:"Droid Sans";
}

body 
{
	margin:0;
	padding:0;
	font-family:"Droid Sans", "Myriad Pro";
	background:url(<?php echo base_url().'images/';?>shattered.png) top left repeat;
}

#panel_title
{
    width:300px;
	height:35px;
	border:2px solid #666666;
	border-bottom-color:#FFFFFF;
	margin:0 auto;
	padding-top:8px;
	background-color:#333333;
	color:#FFFFFF;
	font-size:22px;
	text-align:center;
	-moz-border-radius-topleft:15px;
	-webkit-border-radius-topleft:15px;
	border-radius-topleft:15px;
	-moz-border-radius-topright:15px;
	-webkit-border-radius-topright:15px;
	border-radius-topright:15px;
}

#panel_box
{
	width:260px;
	height:180px;
	border:2px solid #666666;
	margin:0 auto;
	padding:20px;
	background-color:#333333;
	color:#FFFFFF;
	font-size:20px;
	-moz-border-radius-bottomleft:15px;
	-webkit-border-radius-bottomleft:15px;
	border-radius-bottomleft:15px;
	-moz-border-radius-bottomright:15px;
	-webkit-border-radius-bottomright:15px;
	border-radius-bottomright:15px;
}


#form_box
{
	height:25px;
	font-size:20px;
	padding-left:10px;
	font-family:"Droid Sans", "Myriad Pro";
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
}

#submit_box
{
	width:12.4em;
	height:40px;
	margin:25px 0px 15px -15px;
	color:#FFFFFF;
	background-color:#00CC00;
	font-size:23px;
	font-family:"Droid Sans", "Myriad Pro";
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
}

input[type="submit"]::-moz-focus-inner /*remove button outline */
{
    border: none;
}

</style>
</head>

<body>
    <div style="text-align:center;">
  		<img src="<?php echo base_url();?>images/logo.jpg" width="304" height="60" style="margin-top:100px;"/>
    </div>
    <div id="panel_title">
    	Web Administrator Login
    </div>
    
    <div id="panel_box">
    	<?php echo form_open('login/login_error'); ?>
        <table>
        	<tr>
            	<td width="110">Username</td>
                <td><?php echo form_input(array('name'=>'txtuser', 'maxlength'=>'50', 'id'=>'form_box', 'size'=>'10'));?></td>
            </tr>
            
            <tr>
            	<td>Password</td>
                <td><?php echo form_password(array('name'=>'txtpass', 'maxlength'=>'40', 'id'=>'form_box', 'size'=>'10', 'style'=>'margin-top:10px;')); ?></td>
            </tr>
            
            <tr>
            	<td colspan="2"><?php echo form_submit(array('value'=>'Login', 'id'=>'submit_box')); ?></td>
            </tr>
            
            <tr>
            	<td colspan="2" align="center"><span style="font-size:16px;margin-left:-25px;"><?php echo $error; ?></span></td>
            </tr>
        </table>
        <?php echo form_close(); ?>
    </div>
</body>
</html>
