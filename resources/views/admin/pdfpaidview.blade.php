            <h3 align="center">Paid Invoice Data of {{$paid[0]['client']['name']}} for Invoice Number {{$paid[0]['invoice_no']}}</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                  <th style= "border: 1px solid;padding:12px" width="20%">S.No.</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Client Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Client Phone Number</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Property Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Invoice Number</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Payment Due On</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Amount</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Tax Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Tax Percentage</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Taxable Amount</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Late Amount</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Payment Date</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Total Payable Amount</th>
                </tr>
                @if(!empty($paidinvoice))
                @php
                  $i = 0;
                @endphp
                  @foreach($paidinvoice as $paid)
                    @php
                      $i++;
                    @endphp
                    <tr>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$i}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$paid['client']['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$paid['client']['phone']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$paid['property']['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$paid['invoice_no']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$paid['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">Rs.{{$paid['amount']}}</td>
                        @if(!empty($paid['tax_name']['name']))
                          <td style= "border: 1px solid;padding:12px" width="20%">{{$paid['tax_name']['name']}}</td>
                        @else
                          <td style= "border: 1px solid;padding:12px" width="20%">N/A</td>
                        @endif
                        @if(!empty($paid['tax_percent']['percentage']))
                          <td style= "border: 1px solid;padding:12px" width="20%">{{$paid['tax_percent']['percentage']}}%</td>
                        @else
                          <td style= "border: 1px solid;padding:12px" width="20%">N/A</td>
                        @endif
                        @if(!empty($paid['taxable_amount']))
                          <td style= "border: 1px solid;padding:12px" width="20%">Rs.{{$paid['taxable_amount']}}</td>
                        @else
                          <td style= "border: 1px solid;padding:12px" width="20%">Rs.0</td>
                        @endif
                        @if(!empty($paid['late_amount']))
                          <td style= "border: 1px solid;padding:12px" width="20%">Rs.{{$paid['late_amount']}}</td>
                        @else
                          <td style= "border: 1px solid;padding:12px" width="20%">Rs.0</td>
                        @endif
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$paid['date']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">Rs.{{$paid['payable_amount']}}</td>
                    </tr>
                  @endforeach
                  @else
                  <tr>No Data Found.</tr>
                @endif
             </table>