<!DOCTYPE html>
<html>
<head>
	<title>print</title>
	<style type="text/css">
		.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
			    padding: 4px;
			    line-height: 1.42857143;
			    vertical-align: top;
			    /*border-top: 1px solid #ddd;*/
			}
			
			.table-print p{
				font-size: 18px;
				margin:0 5px;
			}
	</style>
</head>
<body>



<table width="100%" class="table table-print" style="max-height:960px;border-top:0px">
	<tbody>
		<tr>
			<td valign="top" align="left">
				<p><strong>Ref. No:-</strong> {{$balanceinvoice['invoice_no']}} </p>
			</td><td valign="top" align="right">
				<p><strong>Date:- </strong>{{$balanceinvoice['date']}}</p>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="center" style="font-size: 22px;">
				<strong>DEMAND LETTER</strong>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="left">
				<p><strong>To,<br>
				{{$balanceinvoice['client']['name']}}</strong></p>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="center">
				<strong>Sub: Demand For Due Payment</strong>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="left">
				<p>Dear Sir / Madam,<br></p>
				<p style="margin-top: 20px;"><font style="padding-left:40px;">We are please to allot you the <u><strong>{{ucfirst($balanceinvoice['property']['property_type'])}}</u></strong> which is named as <u><strong>{{ucfirst($balanceinvoice['property']['name'])}}</strong></u> which is a <u><strong>"{{ucfirst($balanceinvoice['property']['property_construct'])}} Property"</strong></u> for a total consideration of <u><strong> <img src="{{url('assets/img/currency.gif')}}" alt="currency"> {{number_format($balanceinvoice['property']['price'])}}/-</strong></u> <strong>({{getIndianCurrency($balanceinvoice['property']['price'])}}).</strong>
				</p>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="left">
				<p>We are please to inform you that the <u><strong>{{$balanceinvoice['name']}}</strong></u> Level of 
				<u><strong>"{{ucfirst($balanceinvoice['property']['property_construct'])}} Property"</strong></u> is completed and as per agreement the total amount <u><strong><img src="{{url('assets/img/currency.gif')}}"> {{number_format($balanceinvoice['amount'])}}/-</strong></u> Plus Service is due at this stage.
				</p>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="left">
			<p>You are requested to pay <u><strong> <img src="{{url('assets/img/currency.gif')}}"> {{number_format($balanceinvoice['amount'])}}/-<strong>({{getIndianCurrency($balanceinvoice['amount'])}})</strong></strong></u> plus Service Tax amount within 15 days from the date of receipt of this letter.</p>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="left">
				<p>Please note that the payment for this transactions should be made by any of the payment mode wether it can be Cash Payment,Chequed Payment,Bank Transfer Payment etc.</p>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="left">
				<u><strong>Note: Please prepare separate cheque for service tax.</strong></u>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="left">
				Thanking You,<br>Yours faithfully,<br>
				<strong>DevDrishti Infrahomes Pvt. Ltd.</strong>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="right"><strong>Contact No:<br>{{$contact[0]['phone']}}, {{$contact[0]['whatsapp']}}</strong>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" align="left"><strong>Director</strong>
			</td>
		</tr>
	</tbody>
</table>

</body>
</html>