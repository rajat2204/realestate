            <h3 align="center">Balance Invoice Data of {{$balanceinvoice[0]['client']['name']}} for Invoice Number {{$balanceinvoice[0]['invoice_no']}}</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                  <th style= "border: 1px solid;padding:12px" width="20%">Client Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Client Phone Number</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Property Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Invoice Number</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Payment Due On</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Payment Due Date</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Amount</th>
               
                </tr>
                @if(!empty($balanceinvoice))
                  @foreach($balanceinvoice as $balance)
                    <tr>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$balance['client']['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$balance['client']['phone']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$balance['property']['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$balance['invoice_no']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$balance['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$balance['date']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">Rs.{{$balance['amount']}}</td>
                    </tr>
                  @endforeach
                  @else
                  <tr>No Data Found.</tr>
                @endif
             </table>