<div style="position:absolute; text-align:justify; width:800px; margin:-60px 100px 100px 20px;">
<h3>Manajemen Akun Pengguna</h3>
<?php 
	if($this->session->flashdata('message') != NULL)
	{ ?>
		<p class="flash_message" style="position:absolute;top:-3.8em;right:-2.6em"><?php echo $this->session->flashdata('message');?> </p>
<?php
    }?>
    

<?php 
	if($check > 0)
	{ ?>
		<table class='table_header' style="margin:30px 0px 30px -5px;">
			<tr style="font-size:20px;color:#FFFFFF;text-align:center;">
				<td width="200" height="35" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Nama</td>
				<td width="100" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Email</td>
				<td width="50" colspan="3" style="border-bottom:1px solid #FFFFFF;">Aksi</td>
			</tr>
			
            <?php foreach($account as $data): ?>
			<tr class="table_content">
				<td height="30"><?php echo $data->name; ?></td>
                <td height="30"><?php echo $data->email; ?></td>
				
					<?php 
					if($data->status == 'Active')
					{
				?>
						<td width="110" style="text-align:left;padding-left:5px;"><a href="<?php echo base_url(); ?>admin/account/status_changes/<?php echo $data->uid;?>/0"><img src="<?php echo base_url(); ?>images/icons/_0006_Cross.png" width="23" height="23" style="padding-right:5px;float:left;margin-top:-3px;"/>Tidak Aktif</a></td>
                <?php 
					}
					else
					{?>
						<td width="110" style="text-align:left;padding-left:5px;"><a href="<?php echo base_url(); ?>admin/account/status_changes/<?php echo $data->uid;?>/1"><img src="<?php echo base_url(); ?>images/icons/_0007_Tick.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/>Aktif</a></td>
					<?php 
					}?>
				
				<td style="padding-left:5px;"><a href="<?php echo base_url();?>admin/account/delete_account/<?php echo $data->uid; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><img src="<?php echo base_url(); ?>images/icons/_0049_Trash.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
			</tr>
            <?php endforeach; ?>
		</table>
    <?php
	}
	else
	{?>		
    	<p style="color:#FFFFFF;font-size:30px;position:relative;top:3em;left:6em;">Data Akun Pengguna Masih Kosong!</p>
    <?php
	}
	?>
    
   </div>
