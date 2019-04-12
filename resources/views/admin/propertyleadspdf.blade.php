            <h3 align="center">All Property Leads List</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                  <th style= "border: 1px solid;padding:12px" width="20%">Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Property Name</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Property Type</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Availability</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Property Location</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Property Price</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">E-mail</th>
                  <th style= "border: 1px solid;padding:12px" width="20%">Phone Number</th>
               
                </tr>
                @if(!empty($propertyEnquiryLeads))
                  @foreach($propertyEnquiryLeads as $propertyEnquiryLead)
                    <tr>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$propertyEnquiryLead['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$propertyEnquiryLead['property']['name']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{ucfirst($propertyEnquiryLead['property']['property_construct'])}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{ucfirst($propertyEnquiryLead['property']['property_purpose'])}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$propertyEnquiryLead['property']['location']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">Rs.{{number_format($propertyEnquiryLead['property']['price'])}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$propertyEnquiryLead['email']}}</td>
                        <td style= "border: 1px solid;padding:12px" width="20%">{{$propertyEnquiryLead['mobile']}}</td>
                    </tr>
                  @endforeach
                  @else
                  <tr>No Data Found.</tr>
                @endif
             </table>