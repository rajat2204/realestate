    <table class="table table-striped table-bordered paymentplan">
      <thead>
        <tr>
          <th>Payment Name</th>
          <th>Payment Amount</th>
          <th>Payment Due Date</th>
        </tr>
      </thead>
      <tbody>
       @foreach($purchased['payment_plan'] as $plan)
        <tr>
          <td>{{$plan['name']}}</td>
          <td>Rs.{{number_format($plan['amount'])}}</td>
          <td>{{$plan['date']}}</td>
        </tr>
       @endforeach
      </tbody>
    </table>