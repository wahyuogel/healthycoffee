<?php 
	if($error != NULL)
	{ ?>
		<p class="flash_message" style="position:absolute;top:-3.8em;right:-35.1em;color:#99FFCC;"><?php echo $error;?> </p>
<?php
    }?>

	<h2 style="position:relative;top:-1.8em;left:0em;color:#FFFF00;">Tambah Data Kopi</h2>
    <div id="content_box" style="top:2em;left:-0.1em;color:#FFFFFF;">
	<?php echo form_open_multipart('admin/coffee/do_add_coffee'); ?>
	<table class="table_design">
    	<tr>
        	<td width="120">Nama Kopi</td>
            <td width="160"><?php echo form_input(array('name'=>'txttitle', 'maxlength'=>'50', 'class'=>'form_box', 'size'=>'15', 'value'=>set_value('txttitle'))); ?></td>
        </tr>
              
        <tr>
        	<td style="padding-top:10px;">Status</td>
            <td>
            <?php
				$options = array('Active'=>'Active', 'Non-Active'=>'Non-Active');
				echo form_dropdown('txtstatus', $options, set_value('txtstatus'), 'class="form_box" style="margin-top:10px;"');
			?>
            </td>
        </tr>
        
        <tr>
        	<td style="padding-top:10px;">Deskripsi</td>
            <td>
            	<?php echo form_textarea(array('name'=>'txtdescription', 'class'=>'textarea_box', 'cols'=>'40', 'rows'=>'5', 'spellcheck'=>'false', 'value'=>set_value('txtdescription'))); ?>
            </td>
        </tr>
        
        <tr>
        	<td colspan="3" align="center">
            	<?php echo form_submit(array('value'=>'Tambah', 'class'=>'button_style')); ?>
                <?php 
					$attrib = array(
							  'class'=>'button_style',
							  'style'=>'margin-left:30px;',
							  'content'=>'Kembali',
							  'onclick'=>"location.href='".base_url()."admin/coffee'"
							  );
					echo form_button($attrib);?> 
            </td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>