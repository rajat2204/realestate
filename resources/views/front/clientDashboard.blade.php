<section class="sectionAgent">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="bordered-box spaceboth">
          <ul class="nav nav-tabs">
            <li  class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
            <li><a data-toggle="tab" href="#property">Edit Profile</a></li>
            <li><a data-toggle="tab" href="#change">Change Password</a></li>
            <li><a data-toggle="tab" href="#enquiry">Wish List</a></li>
            <li><a data-toggle="tab" href="#purchased">Properties Purchased</a></li>
            <li><a data-toggle="tab" href="#partners">Partners Enquiry</a></li>
          </ul>
          <div class="borderBoxinner">
            <div class="row">
              <div class="col-md-12">
                <div class="agentprofile tab-content">
                  <div id="profile" class="tab-pane fade active profile_details">
                    <div class="profileHead profileAlignleft">
                      <h3>Profile Details</h3>
                    </div>
                    <div class="profileUpload text-center">
                      @if(!empty($client['photo']))
                        <img src="{{url('assets/img/Clients')}}/{{$client['photo']}}" width="100" height="100" class="img-circle border-img">
                      @else
                        <img src="{{url('assets/img/avatar.png')}}" width="100" height="100" class="img-circle border-img">
                      @endif
                    </div>
                    
                      <table class="table">
                        <tbody>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Name:</td>
                            <td style="text-align:left;">{{Auth::user()->first_name}}</td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Registered As:</td>
                            <td style="text-align:left;">{{ucfirst(Auth::user()->user_type)}}</td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Email:</td>
                            <td style="text-align:left;">{{Auth::user()->email}}</td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Mobile no.:</td>
                            <td style="text-align:left;">{{Auth::user()->phone}}</td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Address:</td>
                            @if(!empty($client['address']))
                              <td style="text-align:left;">{{$client['address']}}</td>
                            @else
                              <td style="text-align:left;">----</td>
                            @endif
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">District:</td>
                            @if(!empty($client['district']))
                              <td style="text-align:left;">{{$client['district']}}</td>
                            @else
                              <td style="text-align:left;">----</td>
                            @endif
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">State:</td>
                            @if(!empty($client['state']))
                              <td style="text-align:left;">{{$client['state']}}</td>
                            @else
                              <td style="text-align:left;">----</td>
                            @endif
                          </tr>
                         </tbody>
                      </table>
                    
                  </div>

                  <div id="change" class="tab-pane fade">
                    <form role="changepass" method="POST" action="{{url('changepassword')}}">
                      {{csrf_field()}}
                        <div class="profileHead profileAlignleft">
                          <h3>Change Password</h3>
                        </div>
                        <table class="table">
                          <tbody>
                             <tr>
                              <td style="text-align:right;" class="inputBold">Old Password:</td>
                              <td style="text-align:left;"><input type="password" name="password" placeholder="Old password"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">New Password:</td>
                              <td style="text-align:left;"><input type="password" name="new_password" placeholder="New password"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Confirm New Password:</td>
                              <td style="text-align:left;"><input type="password" name="confirm_password" placeholder="Confirm New password"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;"><button type="button" data-request="ajax-submit" data-target='[role="changepass"]' class="btn-info">Update</button></td>
                              <td style="text-align:left;"></td>
                            </tr>
                           </tbody>
                        </table>
                    </form>
                  </div>

                  <div id="property" class="tab-pane fade clearfix">
                    <form role="clienteditprofile" method="POST" action="{{url('clienteditprofile')}}">
                      {{csrf_field()}}
                      <div class="profileHead profileAlignleft">
                        <h3>Edit Profile</h3>
                      </div>
                      <table class="table tableLeft">
                        <tbody>
                          <tr>
                            <td style="text-align:right;"><input type="hidden" name="id" value="{{\Auth::user()->id}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Upload Profile:</td>
                            <td style="text-align:left;"><input type="file" name="photo" onchange="readURL(this)" id="uploadFile" accept="image/*" style="border:none;"></td>
                            <div>
                              @if(!empty($client['photo']))
                                <img src="{{url('assets/img/Clients')}}/{{$client['photo']}}" id="adminimg" alt="No Featured Image Added" width="100" height="100" class="img-circle border-img">
                              @else
                                <img src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added" width="100" height="100" class="img-circle border-img">
                              @endif
                            </div>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Name:</td>
                            <td style="text-align:left;"><input type="text" name="name" value="{{Auth::user()->first_name}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Father's/Mother's Name:</td>
                            <td style="text-align:left;"><input type="text" name="father_name" value="{{!empty($client['father_name'])?$client['father_name']:''}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Registered As:</td>
                            <td style="text-align:left;"><input type="text" name="user_type" value="{{ucfirst(Auth::user()->user_type)}}" readonly></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Occupation:</td>
                            <td style="text-align:left;"><input type="text" name="occupation" value="{{!empty($client['occupation'])?$client['occupation']:''}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Email:</td>
                            <td style="text-align:left;"><input type="text" name="email" value="{{Auth::user()->email}}" readonly></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Mobile no.:</td>
                            <td style="text-align:left;"><input type="text" name="phone" value="{{Auth::user()->phone}}"></td>
                          </tr>
                         </tbody>
                      </table>
                      <table class="table tableLeft">
                        <tbody>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Address</td>
                            <td style="text-align:left;"><input type="text" name="address" id="autocomplete" value="{{!empty($client['address'])?$client['address']:''}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">District:</td>
                            <td style="text-align:left;"><input type="text" name="district" value="{{!empty($client['district'])?$client['district']:''}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">State:</td>
                            <td style="text-align:left;"><input type="text" name="state" value="{{!empty($client['state'])?$client['state']:''}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">DOB:</td>
                            <td style="text-align:left;"><input type="date" name="dob" value="{{!empty($client['dob'])?$client['dob']:''}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">PAN Number:</td>
                            <td style="text-align:left;"><input type="text" name="pan" value="{{!empty($client['pan'])?$client['pan']:''}}"> </td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Nationality:</td>
                            <td style="text-align:left;"><input type="text" name="nationality" value="{{!empty($client['nationality'])?$client['nationality']:''}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;"><button type="button" data-request="ajax-submit" data-target='[role="clienteditprofile"]' class="btn-info">Edit Profile</button></td>
                            <td style="text-align:left;"></td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>

                  <div id="enquiry" class="tab-pane fade clearfix bordertable">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>S.no</th>
                            <th>Property Name</th>
                            <th>Property Location</th>
                            <th>Property Price</th>
                            <th>Property Area</th>
                            <th>Property Purpose</th>
                            <th>Property Type</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php  
                            $i=0;
                          @endphp
                            @foreach($propertyenquiry as $propertyenquiries)
                          @php
                            $i++;
                          @endphp
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$propertyenquiries['property']['name']}}</td>
                              <td>{{$propertyenquiries['property']['location']}}</td>
                              <td>Rs.{{number_format($propertyenquiries['property']['price'])}}</td>
                              <td>{{number_format($propertyenquiries['property']['area'])}}</td>
                              <td>{{ucfirst($propertyenquiries['property']['property_purpose'])}}</td>
                              <td>{{ucfirst($propertyenquiries['property']['property_construct'])}}</td>
                              @if($propertyenquiries['property']['deals'] == 'no')
                                <td>Not Sold</td>
                              @else
                                <td>Sold</td>
                              @endif
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div id="purchased" class="tab-pane fade clearfix bordertable">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>S.no</th>
                            <th>Property Image</th>
                            <th>Property Name</th>
                            <th>Property Location</th>
                            <th>Property Price</th>
                            <th>Property Area</th>
                            <th>Property Purpose</th>
                            <th>Property Type</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php  
                            $i=0;
                          @endphp
                            @foreach($purchased as $purchases)
                          @php
                            $i++;
                          @endphp
                          <tr>
                            <td>{{$i}}</td>
                            <td><img src="{{asset('assets/img/properties/'.$purchases['property']['featured_image'])}}" class="list_img" style="width: 120px; height: 80px;"></td>
                            <td>{{$purchases['property']['name']}}</td>
                            <td>{{$purchases['property']['location']}}</td>
                            <td>Rs.{{number_format($purchases['property']['price'])}}</td>
                            <td>{{number_format($purchases['property']['area'])}} {{$purchases['units']['name']}}</td>
                            <td>{{ucfirst($purchases['property']['property_purpose'])}}</td>
                            <td>{{ucfirst($purchases['property']['property_construct'])}}</td>
                            <td>
                              <a href="{{url('properties')}}/{{($purchases['property']['slug'])}}" target="_blank" title="View Property Details"><i class="fa fa-fw fa-file-image-o"></i></a>|
                            @if(!empty($purchases['payment_plan']))
                              <a href="#" title="Show Payment Plan"><i class="fa fa-eye"></i></a>|
                              <a href="#" title="Show Paid Payments"><i class="fa fa-money"></i></a> |
                              <a href="#" title="Show Balance Payments"><i class="fa fa-briefcase"></i></a>
                            @endif
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                  <div id="partners" class="tab-pane fade clearfix bordertable">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>S.no</th>
                            <th>Partner Name</th>
                            <th>Partner Contact Number</th>
                            <th>Location</th>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php  
                            $i=0;
                          @endphp
                          @foreach($enquiry as $enquiries)
                          @php
                            $i++;
                          @endphp
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$enquiries['slider_name']}}</td>
                            <td>+91-{{$enquiries['slider_contact']}}</td>
                            <td>{{$enquiries['location']}}</td>
                            <td>{!! $enquiries['description'] !!}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@section('requirejs')
<script type="text/javascript">

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adminimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

function showyourPopup() {
    $("#yourPopup").dialog({
        autoOpen: true,
        resizable: false,
        height: 'auto',
        width: 'auto',
        modal: true,
        //show: { effect: "puff", duration: 300 }, 
        draggable: true
    });

    $(".ui-widget-header").css({"display":"none"}); 
}

function closeyourPopup() { 
  $("#yourPopup").dialog('close'); 
}

function submitResources(id){   

    $("#yourPopup").dialog('open');

    $.ajax({
        url:"{{url('admin/property/ajaxproperties?id=')}}"+value,
        data:'',
        type:'POST',
        error:function(){},
        success:function(data){ 
            $('#yourPopup').html(data); 
            showyourPopup();
        }
    });
}
</script>
@endsection