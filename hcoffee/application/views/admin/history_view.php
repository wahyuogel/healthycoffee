<div style="position:absolute; text-align:justify; width:800px; margin:-60px 100px 100px 20px;">
<h3>Manajemen Histori User</h3>
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
				<td width="200" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Dugaan Penyakit</td>
                <td width="200" style="border-right:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;">Waktu</td>
				<td width="100" colspan="3" style="border-bottom:1px solid #FFFFFF;">Aksi</td>
			</tr>
			
            <?php foreach($history as $data): ?>
			<tr class="table_content">
				<td height="30"><?php echo $data->name; ?></td>
                <td height="30"><?php echo $data->Diseases_Name; ?></td>
                <td height="30"><?php echo $data->created_at; ?></td>
				
					<?php 
					if($data->valid == 'Active')
					{
				?>
						<td style="text-align:left;padding-left:5px;"><a href="<?php echo base_url(); ?>admin/history/status_changes/<?php echo $data->hid;?>/0"><img src="<?php echo base_url(); ?>images/icons/_0007_Tick.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/>Valid</a></td>
                <?php 
					}
					else
					{?>
						<td style="text-align:left;padding-left:5px;"><a href="<?php echo base_url(); ?>admin/history/status_changes/<?php echo $data->hid;?>/1"><img src="<?php echo base_url(); ?>images/icons/_0006_Cross.png" width="23" height="23" style="padding-right:5px;float:left;margin-top:-3px;"/>Tidak Valid</a></td>
					<?php 
					}?>
				
				<td style="padding-left:5px;"><a href="<?php echo base_url();?>admin/history/delete_history/<?php echo $data->hid; ?>" onclick="return confirm('Anda Yakin ingin Menghapus Data ini?')"><img src="<?php echo base_url(); ?>images/icons/_0049_Trash.png" width="23" height="23"  style="padding-right:5px;float:left;margin-top:-3px;"/></a></td>
			</tr>
            <?php endforeach; ?>
		</table>
    <?php
	}
	else
	{?>		
    	<p style="color:#FFFFFF;font-size:30px;position:relative;top:3em;left:6em;">History data still empty !</p>
    <?php
	}
	?>
</div>