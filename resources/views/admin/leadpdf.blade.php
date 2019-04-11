            <h3 align="center">All Admin Leads List</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                  <th style= "border: 1px solid;padding:12px" width="20%">Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">E-mail</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Property Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Phone Number</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Available For</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Follow Up</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Status</th>
               
                </tr>
                @if(!empty($leads))
                  @foreach($leads as $lead)
                    <tr>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$lead['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$lead['email']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$lead['property']['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$lead['phone']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{ucfirst($lead['available'])}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$lead['followup']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{ucfirst($lead['status'])}}</td>
                    </tr>
                  @endforeach
                  @else
                  <tr>No Data Found.</tr>
                @endif
             </table>