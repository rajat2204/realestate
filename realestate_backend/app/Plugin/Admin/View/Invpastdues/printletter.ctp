<?php echo $this->Html->css('print.css');?>
<style type="text/css">
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
border-top: 0px solid #ddd;
}
</style>
<table width="100%" class="table" style="max-height:960px;border-top:0px">
<tr><td valign="top" align="left"><p><strong>Ref. No:-</strong> <?php echo$deal['Deal']['invoice_no'];?> </p></td><td valign="top" align="right"><p><strong>Date:- </strong><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($deal['Invpastdue']['date']));?></p></td></tr>
<tr><td colspan="2" valign="top" align="center"><strong>DEMAND LETTER</strong></td></tr>
<tr><td colspan="2" valign="top" align="left"><p><strong>To,<br>
<?php echo h($deal['Client']['name']);?><br>
<?php echo nl2br($deal['Client']['address']);?>
</strong>
</p></td></tr>
<tr><td colspan="2" valign="top" align="center"><strong>Sub: Demand For Due Payment</strong></td></tr>
<tr><td colspan="2" valign="top" align="left"><p>Dear Sir / Madam,<br>
<p><font style='padding-left:40px;'>We are please allot you <u><strong><?php echo$deal['PropertiesFlat']['type'];?></strong></u> bearing no.<u><strong><?php echo$deal['PropertiesFlat']['name'];?></strong></u> on the <u><strong><?php echo$deal['PropertiesFlat']['floor_no'];?></strong></u> No. <u><strong>"<?php echo$deal['Property']['name'];?>"</strong></u> in</font>
complex to be known as <u><strong>"<?php echo$deal['Project']['name'];?>"</strong></u> to be / being constructed on the property being 
<u><strong><?php echo$deal['Property']['remarks'];?> </strong></u> for a total consideration of <u><strong> <?php  echo$currency.$this->Number->format($deal['Deal']['total_amount']);?>/-</strong></u> <strong>(<?php echo$this->NumToWord->NumberToWord($deal['Deal']['total_amount']);?>).</strong>
</p></td></tr>
<tr><td colspan="2" valign="top" align="left">
<p >We are please to inform you that the <u><strong><?php echo$deal['Invpastdue']['name'];?></strong></u> Level of 
<u><strong>"<?php echo$deal['Property']['name'];?>"</strong></u> is completed and as per agreement the total amount <u><strong><?php $total=($deal['Invpastdue']['amount']); echo$currency.$this->Number->format($total);?>/-</strong></u> Plus Service
 is due at this stage.
</p></td></tr>
<tr><td colspan="2" valign="top" align="left">
<p >You are requested to pay <u><strong> <?php echo$currency.$this->Number->format($total);?>/- <strong>(<?php echo$this->NumToWord->NumberToWord($deal['Invpastdue']['amount']);?>).</strong></strong></u> Plus Service Tax amount  within a <?php echo$dueDays;?> days
from the date of receipt of this letter. The interest would be charged @ <?php echo$lateFees;?>% if payment is delayed.
</p></td></tr>
<tr><td colspan="2" valign="top" align="left">
<p>Please note that the payment for this transactions should be made by crossed cheque /<br>
Transfer of funds favouring <u><strong> <?php echo $siteAccount;?> </strong></u> 
</p></td></tr>
<tr><td colspan="2" valign="top" align="left"><u><strong>Note: Please prepare separate cheque for service tax.</strong></u></td></tr>
<tr><td colspan="2" valign="top" align="left">
Thanking You,<br>
Yours faithfully,<br>
<strong>For M/s. <?php echo$siteOrganization; ?></strong>
</td></tr>
<tr><td colspan="2" valign="top" align="right"><strong>Contact No:<br>
<?php echo$contact;?></strong>
</td></tr>
<tr><td colspan="2" valign="top" align="left"><strong>Director</strong></td></tr>
</table>
<script type="text/javascript" language="javascript1.2">
<!--
// Do print the page
if (typeof(window.print) != 'undefined') {
    window.print();
}
//-->
</script>