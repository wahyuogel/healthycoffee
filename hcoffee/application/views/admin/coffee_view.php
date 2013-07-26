<div style="position:absolute; text-align:justify; width:800px; margin:-60px 100px 100px 20px;">
<h3>Manajemen Data Kopi</h3>
<?php 
	if($this->session->flashdata('message') != NULL)
	{ ?>
		<p class="flash_message" style="position:absolute;top:-3.8em;right:-2.6em"><?php echo $this->session->flashdata('message');?> </p>
<?php
    }?>
    
<a href="<?php echo base_url();?>admin/coffee/add_coffee"><img src="<?php echo base_url(); ?>images/icons/_0009_Add.png"/> <span style="font-size:22px;margin-left:20px;">Tambah Data Kopi</span></a>

<?php 
	if($check > 0)
	{ ?>
		<table class='table_header' style="margin:30px 0px 30px -5px;">
			<tr style="font-size:20px;color:#FFFFFF;text-align:center;">
				<td width="200" height="35" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Nama Kopi</td>
				<td width="100" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Status</td>
				<td width="150" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Daftar Penyakit</td>
				<td width="50" colspan="3" style="border-bottom:1px solid #FFFFFF;">Aksi</td>
			</tr>
			
            <?php foreach($coffee as $data): ?>
			<tr class="table_content">
				<td height="30"><?php echo $data->Coffee_Name; ?></td>
				<td><?php echo $data->Coffee_Status; ?></td>
				<td style="padding-left:5px;"><a href="<?php echo base_url();?>admin/diseases/view_sub/<?php echo $data->Coffee_ID; ?>"><img src="<?php echo base_url(); ?>images/icons/_0030_Search.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/>Lihat Daftar</a></td>
               	<?php 
					if($data->Coffee_Status == 'Active')
					{
				?>
						<td width="110" style="text-align:left;padding-left:5px;"><a href="<?php echo base_url(); ?>admin/coffee/status_changes/<?php echo $data->Coffee_ID;?>/0"><img src="<?php echo base_url(); ?>images/icons/_0006_Cross.png" width="23" height="23" style="padding-right:5px;float:left;margin-top:-3px;"/>Tidak Aktif</a></td>
                <?php 
					}
					else
					{?>
						<td width="110" style="text-align:left;padding-left:5px;"><a href="<?php echo base_url(); ?>admin/coffee/status_changes/<?php echo $data->Coffee_ID;?>/1"><img src="<?php echo base_url(); ?>images/icons/_0007_Tick.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/>Aktif</a></td>
					<?php 
					}?>
				<td style="padding-left:5px;"><a href="<?php echo base_url();?>admin/coffee/edit_coffee/<?php echo $data->Coffee_ID; ?>"><img src="<?php echo base_url(); ?>images/icons/_0018_Pencil.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
				<td style="padding-left:5px;"><a href="<?php echo base_url();?>admin/coffee/delete_coffee/<?php echo $data->Coffee_ID; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><img src="<?php echo base_url(); ?>images/icons/_0049_Trash.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
			</tr>
            <?php endforeach; ?>
		</table>
    <?php
	}
	else
	{?>		
    	<p style="color:#FFFFFF;font-size:30px;position:relative;top:3em;left:6em;">Data Kopi Masih Kosong!</p>
    <?php
	}
	?>
</div>