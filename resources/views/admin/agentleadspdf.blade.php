            <h3 align="center">All Agent Leads List</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                  <th style= "border: 1px solid;padding:12px" width="20%">Agent Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Agent Contact</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Customer Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Customer Contact</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">E-mail</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Message</th>
               
                </tr>
                @if(!empty($agentleads))
                  @foreach($agentleads as $agentlead)
                    <tr>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{ucfirst($agentlead['agent_name'])}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$agentlead['agent_contact']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{ucfirst($agentlead['customer_name'])}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$agentlead['customer_contact']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$agentlead['email']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$agentlead['message']}}</td>
                    </tr>
                  @endforeach
                  @else
                  <tr>No Data Found.</tr>
                @endif
             </table>