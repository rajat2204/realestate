<table class="table table-striped table-bordered balancepayment">
  <thead>
    <tr>
      <th>Payment Name</th>
      <th>Payment Amount</th>
      <th>Invoice Number</th>
      <th>Payment Date</th>
    </tr>
  </thead>
  <tbody>
   @foreach($balancepayment as $balance)
    <tr>
      <td>{{$balance['name']}}</td>
      <td>Rs.{{number_format($balance['amount'])}}</td>
      <td>{{$balance['invoice_no']}}</td>
      <td>{{$balance['date']}}</td>
    </tr>
   @endforeach
  </tbody>
</table>