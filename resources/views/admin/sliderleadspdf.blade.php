            <h3 align="center">All Slider Leads List</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                  <th style= "border: 1px solid;padding:12px" width="20%">Slider Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Slider Contact</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Location</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Customer Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Customer Contact</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">E-mail</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Message</th>
               
                </tr>
                @if(!empty($sliderleads))
                  @foreach($sliderleads as $sliderlead)
                    <tr>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{ucfirst($sliderlead['slider_name'])}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$sliderlead['slider_contact']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$sliderlead['location']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{ucfirst($sliderlead['customer_name'])}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$sliderlead['customer_contact']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$sliderlead['email']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$sliderlead['message']}}</td>
                    </tr>
                  @endforeach
                  @else
                  <tr>No Data Found.</tr>
                @endif
             </table>