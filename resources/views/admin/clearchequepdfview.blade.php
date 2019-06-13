            <h3 align="center">All Clear Cheques List</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                  <th style= "border: 1px solid;padding:12px" width="20%">Client Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Client Phone Number</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Property Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Payment Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Invoice Number</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Amount Paid</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Cheque Number</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Bank Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Status</th>
               
                </tr>
                @if(!empty($cheque))
                  @foreach($cheque as $chequeslist)
                    <tr>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$chequeslist['client']['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$chequeslist['client']['phone']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$chequeslist['property']['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$chequeslist['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$chequeslist['invoice_no']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">Rs.{{$chequeslist['amount']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$chequeslist['cheque_no']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">Rs.{{$chequeslist['bank_name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$chequeslist['status']}}</td>
                    </tr>
                  @endforeach
                  @else
                  <tr>No Data Found.</tr>
                @endif
             </table>