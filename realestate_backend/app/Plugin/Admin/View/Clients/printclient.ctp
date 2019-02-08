<?php echo $this->Html->css('print.css');?>
<style type="text/css">
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
border-top: 0px solid #ddd;
}
</style>
<table width="100%">
<tr>
        <td>
            <?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'','height'=>'100'));}?>  
        </td>
        <td colspan="4">
            <table>
            <tr><td><h2><?php echo$siteOrganization;?></h2></td></tr>
            <tr><td><p><?php echo$siteAddress;?></p></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="center"><strong>CLIENT DETAILS</strong></td>        
    </tr>
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger">Name of the Applicant</small></strong></td>
				<td><?php echo h($post['Client']['name']);?></td>
				<td><strong><small class="text-danger">Father's Husband Name</small></strong></td>
				<td><?php echo h($post['Client']['father_name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Address</small></strong></td>
				<td><?php echo h($post['Client']['address']);?></td>
				<td><strong><small class="text-danger">District</small></strong></td>
				<td><?php echo h($post['Client']['district']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">State</small></strong></td>
				<td><?php echo h($post['Client']['state']);?></td>
				<td><strong><small class="text-danger">Pincode</small></strong></td>
				<td><?php echo h($post['Client']['pincode']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Nationality</small></strong></td>
				<td><?php echo h($post['Client']['nationality']);?></td>
				<td><strong><small class="text-danger">Pan</small></strong></td>
				<td><?php echo h($post['Client']['pan']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Date of Birth</small></strong></td>
				<td><?php echo $this->Time->Format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$post['Client']['dob']);?></td>
				<td><strong><small class="text-danger">Occupation with detail</small></strong></td>
				<td><?php echo h($post['Client']['occupation']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Mobile</small></strong></td>
				<td><?php echo h($post['Client']['phone']);?></td>
				<td><strong><small class="text-danger">Email</small></strong></td>
				<td><?php echo h($post['Client']['email']);?></td>
			    </tr>
			    <tr>
				<td colspan="4">
				<?php $photo=null; if($post['Client']['photo'])$photo='client_thumb/'.$post['Client']['photo'];else $photo='nia.png';echo$this->Html->image($photo,array('height'=>130));?>
				</td>
			    </tr>
			    <tr>
				<td colspan="4">
				<?php if($post['Client']['id_proof'])echo$this->Html->image('client/'.$post['Client']['id_proof']);?>
				</td>				
			    </tr>
			    <tr>
			    <td colspan="4">
				<?php if($post['Client']['address_proof'])echo$this->Html->image('client/'.$post['Client']['address_proof']);?>
				</td>
			    </tr>
			     <?php if($post['ClientsCoapplicant']){
				foreach($post['ClientsCoapplicant'] as $k=>$value):?>
			    <tr>
				<td colspan="4"><h3>Co-Applicant Information (<?php echo++$k;?>)</h3></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Name of the Applicant</small></strong></td>
				<td><?php echo h($value['name']);?></td>
				<td><strong><small class="text-danger">Father's Husband Name</small></strong></td>
				<td><?php echo h($value['father_name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Address</small></strong></td>
				<td><?php echo h($value['address']);?></td>
				<td><strong><small class="text-danger">District</small></strong></td>
				<td><?php echo h($value['district']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">State</small></strong></td>
				<td><?php echo h($value['state']);?></td>
				<td><strong><small class="text-danger">Pincode</small></strong></td>
				<td><?php echo h($value['pincode']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Nationality</small></strong></td>
				<td><?php echo h($value['nationality']);?></td>
				<td><strong><small class="text-danger">Pan</small></strong></td>
				<td><?php echo h($value['pan']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Date of Birth</small></strong></td>
				<td><?php echo $this->Time->Format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$value['dob']);?></td>
				<td><strong><small class="text-danger">Occupation with detail</small></strong></td>
				<td><?php echo h($value['occupation']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Mobile</small></strong></td>
				<td><?php echo h($value['phone']);?></td>
				<td><strong><small class="text-danger">Email</small></strong></td>
				<td><?php echo h($value['email']);?></td>
			    </tr>
			    <tr>
				<td colspan="4">
				<?php $photo=null; if($value['photo'])$photo='coapplicant_thumb/'.$value['photo'];else $photo='nia.png';echo$this->Html->image($photo,array('height'=>130));?>
				</td>
			    </tr>
			    <tr>
				<td colspan="4">
				<?php if($value['id_proof'])echo$this->Html->image('coapplicant/'.$value['id_proof']);?>
				</td>
			    </tr>
			    <tr>
				<td colspan="4">
				<?php if($value['address_proof'])echo$this->Html->image('coapplicant/'.$value['address_proof']);?>
				</td>
			    </tr>
			    <?php endforeach;unset($value); }?>
			</table>
<script type="text/javascript" language="javascript1.2">
<!--
// Do print the page
if (typeof(window.print) != 'undefined') {
    window.print();
}
//-->
</script>