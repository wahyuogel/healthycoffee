<div style="position:absolute; text-align:justify; width:800px; margin:-60px 100px 100px 20px;">
<h3>Manajemen Data Gejala Penyakit Kopi</h3>
<br />
<?php 
	if($this->session->flashdata('message') != NULL)
	{ ?>
		<p class="flash_message" style="position:absolute;top:-3.8em;right:-2.5em"><?php echo $this->session->flashdata('message');?> </p>
<?php
    }?>
   
    <table style="margin-top:-1.5em;">
 	<tr>
    <td>
    <select name="txtstatus" class="form_box" style="width:300px;font-size:18px;margin-left:-8px;" onchange="location.href='<?php echo base_url();?>admin/symptom/view_symptom/'+this.options[this.selectedIndex].value;">
    	<option value="0/0">-Pilih Salah Satu-</option>
		<?php $curOptGroup = ''; ?>
			
    	<?php foreach($dropdown as $data): ?>
        <?php if($curOptGroup != $data->Coffee_Name): ?>
				<optgroup label="<?php echo ucwords($data->Coffee_Name);?>" style="font-family:'Droid Sans', 'Myriad Pro';font-style:normal;">
        <?php endif; ?>
					<?php $curOptGroup = $data->Coffee_Name;?>
                    <option value="<?php echo $data->Coffee_ID;?>/<?php echo $data->Diseases_ID;?>" <?php if($data->Diseases_ID == $sub_id){echo "selected";}?>><?php echo ucwords($data->Diseases_Name); ?></option>
              <?php if($curOptGroup != $data->Coffee_Name): ?>
				</optgroup>
              <?php endif; ?>
        <?php endforeach; ?>
    </select>
    </td>
   </tr>
   </table>

 	<?php
	if($sub_id > 0)
	{?>
		<a href="<?php echo base_url();?>admin/symptom/add_symptom/<?php echo $root_id;?>/<?php echo $sub_id;?>"><img src="<?php echo base_url(); ?>images/icons/_0009_Add.png" style="position:absolute;top:1.6em;left:29em;" width="36" height="36"/> <span style="font-size:21px;width:200px;position:absolute;top:1.5em;left:24em;">Tambah Data Gejala</span></a>
        <?php
		if($check > 0)
		{?>
			<table class='table_header' style="margin:50px 0px 0px -5px;">
			<tr style="font-size:15px;color:#FFFFFF;text-align:center;">
            	<td width="110" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Gambar Gejala</td>
				<td width="200" height="35" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Gejala</td>
				<td width="50" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Status</td>
				<td width="80" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Tanggal</td>
				<td colspan="3" style="border-bottom:1px solid #FFFFFF;">Aksi</td>
			</tr>
			
         	<?php foreach($symptom as $data): ?>
			<tr class="table_content">
            	<td style="padding-left:0px;"><img src="<?php echo base_url();?>images/symptom_icon/<?php echo $data->Symptom_Image; ?>" width="150" height="100"/></td>
				<td height="30" style="font-size:13px;"><?php echo $data->Symptom_Name; ?></td>
				<td style="font-size:13px;"><?php echo $data->Symptom_Status; ?></td>
				<td style="font-size:13px;"><?php echo $data->Date_Updated; ?></td>
               	<?php 
					if($data->Symptom_Status == 'Show')
					{
				?>
				<td style="text-align:left;padding-left:5px;font-size:13px;"><a href="<?php echo base_url(); ?>admin/symptom/status_changes/<?php echo $data->Coffee_ID;?>/<?php echo $data->Diseases_ID;?>/<?php echo $data->Symptom_ID;?>/0"><img src="<?php echo base_url(); ?>images/icons/_0006_Cross.png" width="23" height="23" style="padding-right:5px;float:left;margin-top:-3px;"/>Tidak Tampil</a></td>
                <?php 
					}
					else
					{?>
				<td style="text-align:left;padding-left:5px;font-size:13px;"><a href="<?php echo base_url(); ?>admin/symptom/status_changes/<?php echo $data->Coffee_ID;?>/<?php echo $data->Diseases_ID;?>/<?php echo $data->Symptom_ID;?>/1"><img src="<?php echo base_url(); ?>images/icons/_0007_Tick.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/>Tampil</a></td>
				<?php 
					}?>
				<td style="padding-left:5px;font-size:13px;"><a href="<?php echo base_url();?>admin/symptom/edit_symptom/<?php echo $data->Coffee_ID;?>/<?php echo $data->Diseases_ID;?>/<?php echo $data->Symptom_ID; ?>"><img src="<?php echo base_url(); ?>images/icons/_0018_Pencil.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
				<td style="padding-left:5px;font-size:13px;"><a href="<?php echo base_url();?>admin/symptom/delete_symptom/<?php echo $data->Coffee_ID;?>/<?php echo $data->Diseases_ID;?>/<?php echo $data->Symptom_ID;?>" onclick="return confirm('Anda Yakin ingin Menghapus Data ini?')"><img src="<?php echo base_url(); ?>images/icons/_0049_Trash.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
			</tr>
            <?php endforeach; ?>
		</table>
		<?php 
		}
		else
		{?>
			<h1 style="position:absolute;top:4em;left:7em;width:500px;color:#FFFFFF;">Data Gejala Penyakit Kopi Masih Kosong!</h1>
		<?php 
		}
	}
	?>
</div>