<div style="position:absolute; text-align:justify; width:800px; margin:-60px 100px 100px 20px;">
<h3>Manajemen Data Penyakit Kopi</h3>
<?php 
	if($this->session->flashdata('message') != NULL)
	{ ?>
		<p class="flash_message" style="position:absolute;top:-3.8em;right:-8em"><?php echo $this->session->flashdata('message');?> </p>
<?php
    }?>
    
<div class="header_style">
<a href="<?php echo base_url();?>admin/diseases/add_diseases/<?php echo $root_id;?>"><img src="<?php echo base_url(); ?>images/icons/_0009_Add.png" style="margin:0;padding:0;float:left;margin-top:-0.7em;margin-right:5px;"/>Tambah Data Penyakit Kopi</a>
</div>

<?php 
	if($check > 0)
	{ ?>
    	<span style="position:absolute;right:200px;text-align:right;color:#FFFFFF;font-size:20px;">Root : <?php echo $row->Coffee_Name;?></span>
		<table width="620" class='table_header' style="position:relative;top:2.2em;left:2em;">
			<tr style="font-size:20px;color:#FFFFFF;text-align:center;">
				<td width="200" height="35" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Nama Penyakit</td>
				<td width="100" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Status</td>
				<td width="100" colspan="3" style="border-bottom:1px solid #FFFFFF;">Aksi</td>
			</tr>
			
            <?php foreach($diseases as $data): ?>
			<tr class="table_content">
				<td height="30"><?php echo $data->Diseases_Name; ?></td>
				<td><?php echo $data->Diseases_Status; ?></td>
		
               	<?php 
					if($data->Diseases_Status == 'Active')
					{
				?>
						<td style="text-align:left;padding-left:5px;"><a href="<?php echo base_url(); ?>admin/diseases/status_changes/<?php echo $root_id; ?>/<?php echo $data->Diseases_ID;?>/0"><img src="<?php echo base_url(); ?>images/icons/_0006_Cross.png" width="23" height="23" style="padding-right:5px;float:left;margin-top:-3px;"/>Tidak Aktif</a></td>
                <?php 
					}
					else
					{?>
						<td style="text-align:left;padding-left:5px;"><a href="<?php echo base_url(); ?>admin/diseases/status_changes/<?php echo $root_id; ?>/<?php echo $data->Diseases_ID;?>/1"><img src="<?php echo base_url(); ?>images/icons/_0007_Tick.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/>Aktif</a></td>
					<?php 
					}?>
				<td style="padding-left:5px;"><a href="<?php echo base_url();?>admin/diseases/edit_diseases/<?php echo $root_id; ?>/<?php echo $data->Diseases_ID; ?>"><img src="<?php echo base_url(); ?>images/icons/_0018_Pencil.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
				<td style="padding-left:5px;"><a href="<?php echo base_url();?>admin/diseases/delete_diseases/<?php echo $root_id; ?>/<?php echo $data->Diseases_ID; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><img src="<?php echo base_url(); ?>images/icons/_0049_Trash.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
			</tr>
            <?php endforeach; ?>
		</table>
        <div style="margin-bottom:150px;">
         <a href="<?php echo base_url(); ?>admin/coffee" class="button_style" style="font-size:21px;position:relative;top:3em;left:14.2em;border:1px solid #FFF;background-color:#333333;padding:5px 20px 5px 20px;text-align:center;">Kembali</a>
         </div>
    <?php
	}
	else
	{?>	
    	<p style="color:#FFFFFF;font-size:30px;width:500px;position:absolute;top:4em;left:5em;float:none;">Data Penyakit Kopi Masih Kosong !</p>
    <?php
	}
	?>
</div>