<?php 
	if($error != NULL)
	{ ?>
		<p class="flash_message" style="position:absolute;top:-3.8em;right:-36.1em;color:#99FFCC;"><?php echo $error;?> </p>
<?php
    }?>

	<h2 style="position:relative;top:-1.8em;left:0em;color:#FFFF00;">Tambah Data Gejala Penyakit Kopi</h2>
     <h2 style="position:absolute;top:-1em;right:-20.5em;color:#FFFFFF;text-align:right;">division : <?php echo $row->Diseases_Name; ?></h2>
    <div id="content_box" style="top:2em;left:-0.1em;color:#FFFFFF;">
	<?php echo form_open_multipart('admin/symptom/do_add_symptom'); ?>
	<table class="table_design">
    	<tr>
        	<td width="120">Gejala</td>
            <td width="160"><?php echo form_input(array('name'=>'txttitle', 'maxlength'=>'50', 'class'=>'form_box', 'size'=>'15', 'value'=>set_value('txttitle'))); ?>
            <?php echo form_hidden('txtrootid', $root_id); ?>
            <?php echo form_hidden('txtsubid', $sub_id); ?>
            </td>
        </tr>
        
        <tr>
        	<td style="padding-top:10px;">Gambar</td>
            
            <td>
            	<?php echo form_input(array('name'=>'txticon', 'id'=>'txtFileName', 'class'=>'form_box', 'readonly'=>'readonly', 'style'=>'margin-top:10px;', 'value'=>set_value('txticon'))); ?>
            </td>
            <td>
				<div id="file_input_div">
                	<?php echo form_button(array('class'=>'file_input_button', 'content'=>'Browse')); ?>
					<?php echo form_upload(array('name'=>'icon', 'class'=>'file_input_hidden', 'onchange'=>"javascript:document.getElementById('txtFileName').value = this.value")); ?>
				</div>
                <span style="position:absolute;top:3.55em;right:5em;">( Optional )</span>
            </td>
        </tr>
        
        <tr>
        	<td style="padding-top:10px;">Status</td>
            <td>
            <?php
				$options = array('Show'=>'Show', 'Hide'=>'Hide');
				echo form_dropdown('txtstatus', $options, set_value('txtstatus'), 'class="form_box" style="margin-top:10px;"');
			?>
            </td>
        </tr>
        
        <tr>
        	<td style="padding-top:10px;">Deskripsi</td>
            <td>
            	<?php echo form_textarea(array('name'=>'txtoverview', 'class'=>'textarea_box', 'cols'=>'40', 'rows'=>'5', 'spellcheck'=>'false', 'value'=>set_value('txtoverview'))); ?>
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
							  'onclick'=>"location.href='".base_url()."admin/symptom/view_symptom/".$root_id."/".$sub_id."'"
							  );
					echo form_button($attrib);?> 
            </td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>