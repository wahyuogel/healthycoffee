<?php 
	if($error != NULL)
	{ ?>
		<p class="flash_message" style="position:absolute;top:-3.8em;right:-36.1em;color:#99FFCC;"><?php echo $error;?> </p>
<?php
    }?>

	<h2 style="position:relative;top:-1.8em;left:0em;color:#FFFF00;">Sunting Gejala Penyakit Kopi</h2>
    <h2 style="position:absolute;top:-1em;right:-27.5em;color:#FFFFFF;text-align:right;">division : <?php echo $row->Diseases_Name; ?></h2>
    <div id="content_box" style="top:2em;left:-0.1em;color:#FFFFFF;">
	<?php echo form_open_multipart('admin/symptom/do_edit_symptom'); ?>
     <?php foreach($symptom as $data):?>
	<table class="table_design">
    	<tr>
        	<td width="120">Gejala</td>
            <td width="160"><?php echo form_input(array('name'=>'txttitle', 'maxlength'=>'50', 'class'=>'form_box', 'size'=>'15', 'value'=>set_value('txttitle', $data->Symptom_Name))); ?>
            <?php echo form_hidden('txtcurimg', $data->Symptom_Image); ?>
            <?php echo form_hidden('txtrootid',$data->Coffee_ID); ?>
            <?php echo form_hidden('txtsubid',$data->Diseases_ID); ?>
            <?php echo form_hidden('txtid',$data->Symptom_ID); ?>
            </td>
        </tr>
        
        <tr>
        	<td style="padding-top:10px;">Gambar</td>
            
            <td>
            	<?php echo form_input(array('name'=>'txticon', 'id'=>'txtFileName', 'class'=>'form_box', 'readonly'=>'readonly', 'style'=>'margin-top:10px;', 'value'=>set_value('txticon', $data->Symptom_Image)))?>
            </td>
            <td>
				<div id="file_input_div">
                	<?php echo form_button(array('class'=>'file_input_button', 'content'=>'Browse')); ?>
					<?php echo form_upload(array('name'=>'icon', 'class'=>'file_input_hidden', 'onchange'=>"javascript:document.getElementById('txtFileName').value = this.value")); ?>
				</div>
                <span style="position:absolute;top:6em;right:2.8em;">Preview</span>
                <span style="position:absolute;top:8.3em;right:1em;"><img src="<?php echo base_url(); ?>images/symptom_icon/<?php echo $data->Symptom_Image; ?>" class="preview_style"/></span>
            </td>
        </tr>
        
        <tr>
        	<td style="padding-top:10px;">Status</td>
            <td>
            <?php
				$options = array('Show'=>'Show', 'Hide'=>'Hide');
				echo form_dropdown('txtstatus', $options, set_value('txtstatus', $data->Symptom_Status), 'class="form_box" style="margin-top:10px;"');
			?>
            </td>
        </tr>
        
        <tr>
        	<td style="padding-top:10px;">Deskripsi</td>
            <td>
            	<?php echo form_textarea(array('name'=>'txtoverview', 'class'=>'textarea_box', 'cols'=>'40', 'rows'=>'5', 'spellcheck'=>'false', 'value'=>set_value('txtoverview', $data->Symptom_Overview))); ?>
            </td>
        </tr>
        
        <tr>
        	<td colspan="3" align="center">
            	<?php echo form_submit(array('value'=>'Sunting', 'class'=>'button_style')); ?>
                <?php 
					$attrib = array(
							  'class'=>'button_style',
							  'style'=>'margin-left:30px;',
							  'content'=>'Kembali',
							  'onclick'=>"location.href='".base_url()."admin/symptom/view_symptom/".$data->Coffee_ID."/".$data->Diseases_ID."'"
							  );
					echo form_button($attrib);?> 
            </td>
        </tr>
    </table>
    <?php endforeach; ?>
    <?php echo form_close(); ?>
</div>