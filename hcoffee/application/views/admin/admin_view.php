<div style="position:absolute; text-align:justify; width:800px; margin:-60px 100px 100px 20px;">
<h3>Manajemen Web Administrator</h3>
<?php 
	if($this->session->flashdata('message') != NULL)
	{ ?>
		<p class="flash_message" style="position:absolute;top:-3.8em;right:-2.6em"><?php echo $this->session->flashdata('message');?> </p>
<?php
    }?>
    
<a href="<?php echo base_url();?>admin/admin/add_admin"><img src="<?php echo base_url(); ?>images/icons/_0009_Add.png"/> <span style="font-size:22px;margin-left:20px;">Tambah Data Web Administrator</span></a>

<?php 
	if($check > 0)
	{ ?>
		<table class='table_header' style="margin:30px 0px 30px -5px;">
			<tr style="font-size:20px;color:#FFFFFF;text-align:center;">
				<td width="200" height="35" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Nama Administrator</td>
				<td width="100" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Email</td>
				<td width="50" colspan="3" style="border-bottom:1px solid #FFFFFF;">Aksi</td>
			</tr>
			
            <?php foreach($admin as $data): ?>
			<tr class="table_content">
				<td height="30"><?php echo $data->User_Name; ?></td>
                <td height="30"><?php echo $data->User_ID; ?></td>
				
				
				<td style="padding-left:5px;"><a href="<?php echo base_url();?>admin/admin/edit_admin/<?php echo $data->AID; ?>"><img src="<?php echo base_url(); ?>images/icons/_0018_Pencil.png" width="23" height="23"style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
				<td style="padding-left:5px;"><a href="<?php echo base_url();?>admin/admin/delete_admin/<?php echo $data->AID; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><img src="<?php echo base_url(); ?>images/icons/_0049_Trash.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
			</tr>
            <?php endforeach; ?>
		</table>
    <?php
	}
	else
	{?>		
    	<p style="color:#FFFFFF;font-size:30px;position:relative;top:3em;left:6em;">Data Web Administrator Masih Kosong!</p>
    <?php
	}
	?>
</div>