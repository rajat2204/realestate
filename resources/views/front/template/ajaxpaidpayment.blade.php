<table class="table table-striped table-bordered paidpayment">
  <thead>
    <tr>
      <th>Payment Name</th>
      <th>Payment Amount</th>
      <th>Invoice Number</th>
      <th>Payment Type</th>
      <th>Late Amount</th>
      <th>Taxable Amount</th>
      <th>Total Payable Amount</th>
      <th>Payment Date</th>
    </tr>
  </thead>
  <tbody>
   @foreach($paidpayment as $paid)
    <tr>
      <td>{{$paid['name']}}</td>
      <td>Rs.{{number_format($paid['amount'])}}</td>
      <td>{{$paid['invoice_no']}}</td>
      <td>{{ucfirst($paid['payment_type'])}}</td>
      @if(!empty($paid['late_amount']))
        <td>Rs.{{number_format($paid['late_amount'])}}</td>
      @else
        <td>N/A</td>
      @endif
      @if(!empty($paid['taxable_amount']))
        <td>Rs.{{number_format($paid['taxable_amount'])}}</td>
      @else
        <td>N/A</td>
      @endif
      @if(!empty($paid['taxable_amount']))
        <td>Rs.{{number_format($paid['payable_amount'])}}</td>
      @else
        <td>N/A</td>
      @endif
      <td>{{$paid['date']}}</td>
    </tr>
   @endforeach
  </tbody>
</table>