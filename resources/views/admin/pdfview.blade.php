            <h3 align="center">Balance Invoice Data</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                  <th style= "border: 1px solid;padding:12px" width="20%">Payment Due On</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Payment Due Date</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Amount</th>
               
                </tr>
                @if(!empty($balanceinvoice))
                  @foreach($balanceinvoice as $balance)
                    <tr>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$balance['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$balance['date']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$balance['amount']}}</td>
                    </tr>
                  @endforeach
                  @else
                  <tr>No Data Found.</tr>
                @endif
             </table>