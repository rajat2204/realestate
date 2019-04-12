<html>
  <head>
  <style type="text/css">
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
        border-top: 0px solid #ddd;
      }
      .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
          padding: 4px;
          font-size: 20px;
          line-height: 1.42857143;
          vertical-align: top;
          /*border-top: 1px solid #ddd;*/
      }
    .recipt_footer{position:relative;top: 25px;}
  </style>
<link id="avast_os_ext_custom_font" href="chrome-extension://mbckjcfnjmoiinpgddefodcighgikkgn/common/ui/fonts/fonts.css" rel="stylesheet" type="text/css">
</head>
<body>
  <table width="100%" class="table" style="max-height:960px;border-top: 0px">
    <tbody>
      <tr>
        <td colspan="4">
            <table>
              <tbody>
                <tr><td><b>DevDrishti Infrahomes Pvt. Ltd.</b></td></tr>
                <tr><td><p>Site Office: {{$dealplan[0]['property']['location']}} - {{$dealplan[0]['property']['pincode']}}</p></td></tr>
              </tbody>
          </table>
        </td>
      </tr>
    <tr>
        <td colspan="4" align="left"><strong>INVOICE</strong></td>        
    </tr>
    <tr>
      <td valign="top" align="left"><strong>Invoice Number</strong></td>
      <td valign="top" align="left">{{$dealplan[0]['invoice_no']}}</td>
      <td align="left" valign="top"><strong>Invoice Date </strong></td>
      <td align="left" valign="top">{{$dealplan[0]['date']}}</td>
    </tr>
    <tr>
      <td align="left" valign="top"><strong>Client</strong> </td>
      <td align="left" valign="top">{{$dealplan[0]['client']['name']}}</td>
      <td align="left" valign="top"><strong>Contact</strong> </td>
      <td align="left" valign="top">{{$dealplan[0]['client']['phone']}}</td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="top"><hr></td>
    </tr>
    <tr>
      <td align="left" valign="top"><strong>Property</strong></td>
      <td align="left" valign="top">{{$dealplan[0]['property']['name']}}</td>
    </tr>
    <tr>
      <td align="left" valign="top"><strong>Type</strong></td>
      <td align="left" valign="top">{{ucfirst($dealplan[0]['property']['property_construct'])}}&nbsp;<strong>For</strong>&nbsp;{{ucfirst($dealplan[0]['property']['property_purpose'])}}</td>
      <td align="left" valign="top"><strong>Area</strong></td>
      <td align="left" valign="top">{{number_format($dealplan[0]['property']['area'])}}</td>
    </tr>
    <tr>
      <td align="left" valign="top"><strong>Amount</strong></td>
      <td valign="top" align="left"><img src="{{url('assets/img/currency.gif')}}"> {{number_format($dealplan[0]['deal']['amount'])}}</td>
      <td align="left" valign="top"><strong>Discount</strong></td>
      <td valign="top" align="left">{{$dealplan[0]['deal']['discount']}}%</td>
    </tr>
    @php
      $totalamount = $dealplan[0]['deal']['amount'];
      $discounts = $dealplan[0]['deal']['discount'];
      $balance = $dealplan[0]['deal']['amount'] - $dealplan[0]['deal']['amount'] *(($dealplan[0]['deal']['discount'])/100);
      $balanceAmount = $balance;
    @endphp
    <tr>
        <td align="left" valign="top"><strong>Total Amount</strong></td>
        <td colspan="3" valign="top" align="left"><strong><img src="{{url('assets/img/currency.gif')}}"> {{number_format($balanceAmount)}}</strong></td>  
    </tr>
  </tbody>
</table>
<table width="100%" class="table" border="1">
  <tbody>
    @php  
      $i=0;
    @endphp
    <tr>
      <td colspan="4" align="left"><strong>PAYMENT DETAILS</strong></td>
    </tr>
    <tr>
      <th align="left" valign="top">S.No.</th>
      <th align="left" valign="top">Installment</th>
      <th align="left" valign="top">Amount</th>
      <th align="left" valign="top">Due Date</th>           
    </tr>
    @foreach($dealplan as $dealplanss)
    @php
      $i++;
    @endphp
    <tr>
        <td align="left" valign="top">{{$i}}</td>
        <td align="left" valign="top">{{$dealplanss['name']}}</td>
        <td align="left" valign="top"><img src="{{url('assets/img/currency.gif')}}">{{number_format($dealplanss['amount'])}}</td>
        <td align="left" valign="top">{{$dealplanss['date']}}</td>
    </tr>
    @endforeach
    <tr>
      <td colspan="2" align="right"><strong>Total</strong>
      </td>
      <td colspan="2"><strong>{{number_format($balanceAmount)}}</strong>
      </td>
    </tr>
  </tbody>
</table>
<table width="100%" class="table">        
  <tbody>
    <tr>
      <td colspan="4" valign="top" align="LEFT">
        <div class="recipt_footer"><strong>Signture</strong></div>
      </td>
    </tr>
    <tr>
      <td colspan="2" valign="top" align="LEFT"><div class="recipt_footer"><p>Thanking You,<br>Yours faithfully,<br><strong>DevDrishti Infrahomes Pvt. Ltd.</strong></p></div></td>
      <td colspan="2" valign="top" align="right"><div class="recipt_footer"><strong>Contact No:<br>{{$contact[0]['phone']}},{{$contact[0]['whatsapp']}}</strong></div>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>