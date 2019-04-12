            <h3 align="center">All Contacts Leads List</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                  <th style= "border: 1px solid;padding:12px" width="20%">Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">E-mail</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Subject</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Message</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Phone Number</th>
               
                </tr>
                @if(!empty($contactleads))
                  @foreach($contactleads as $contactlead)
                    <tr>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{ucfirst($contactlead['name'])}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$contactlead['email']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$contactlead['subject']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$contactlead['message']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$contactlead['number']}}</td>
                    </tr>
                  @endforeach
                  @else
                  <tr>No Data Found.</tr>
                @endif
             </table>