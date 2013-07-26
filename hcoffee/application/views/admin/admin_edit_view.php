<?php 
	if($error != NULL)
	{ ?>
		<p class="flash_message" style="position:absolute;top:-3.8em;right:-35.1em;color:#99FFCC;"><?php echo $error;?> </p>
<?php
    }?>

	<h2 style="position:relative;top:-1.8em;left:0em;color:#FFFF00;">Sunting Data Web Administrator</h2>
    <div id="content_box" style="top:2em;left:-0.1em;color:#FFFFFF;">
	<?php echo form_open_multipart('admin/admin/do_edit_admin'); ?>
     <?php foreach($admin as $data):?>
	<table class="table_design">
    	<tr>
        	<td width="120">Nama</td>
            <td width="160"><?php echo form_input(array('name'=>'txtname', 'maxlength'=>'50', 'class'=>'form_box', 'size'=>'15', 'value'=>set_value('txtname', $data->User_Name))); ?>
            </td>
        </tr>
        
        <?php echo form_hidden(array('name'=>'txtAID', 'value'=>set_value('txtAID', $data->AID))); ?>
        <tr>
        	<td width="120">Email</td>
        <td width="160"><?php echo form_input(array('name'=>'txtid', 'maxlength'=>'50', 'class'=>'form_box', 'size'=>'15', 'disable'=>'disable', 'value'=>set_value('txtid', $data->User_ID))); ?>
            </td>
        </tr>
        <tr>
        	<td width="120">Password</td>
            <td width="160"><?php echo form_password(array('name'=>'txtpass', 'maxlength'=>'50', 'class'=>'form_box', 'size'=>'15')); ?> (*Jika Tidak berubah, Biarkan Kosong)</td>
        </tr>
        <tr>
        	<td colspan="3" align="center">
            	<?php echo form_submit(array('value'=>'Sunting', 'class'=>'button_style')); ?>
                <?php 
					$attrib = array(
							  'class'=>'button_style',
							  'style'=>'margin-left:30px;',
							  'content'=>'Kembali',
							  'onclick'=>"location.href='".base_url()."admin/admin'"
							  );
					echo form_button($attrib);?> 
            </td>
        </tr>
    </table>
    <?php endforeach; ?>
    <?php echo form_close(); ?>
</div>