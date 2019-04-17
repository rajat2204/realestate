<section class="sectionAgent">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="bordered-box spaceboth">
            <ul class="nav nav-tabs">
              <li  class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
              <li><a data-toggle="tab" href="#property">Edit Profile</a></li>
              <li><a data-toggle="tab" href="#change">Change Password</a></li>
              <li><a  data-toggle="tab" href="#account">Account Details</a></li>
              <li><a  data-toggle="tab" href="#propertysold">Properties Involved</a></li>
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
                        @if(!empty($agent['image']))
                          <img src="{{url('assets/img/agent')}}/{{$agent['image']}}" width="100" height="100" class="img-circle border-img">
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
                            <td style="text-align:right;" class="inputBold">District:</td>
                            @if(!empty($agent['district']))
                              <td style="text-align:left;">{{$agent['district']}}</td>
                            @else
                              <td style="text-align:left;">----</td>
                            @endif
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Email:</td>
                            <td style="text-align:left;">{{Auth::user()->email}}</td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Mobile no.:</td>
                            <td style="text-align:left;">{{Auth::user()->phone}}</td>
                          </tr>
                         </tbody>
                      </table>
                    </div>

                    <div id="change" class="tab-pane fade">
                      <form role="changepass" method="POST" action="{{url('changepassword')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="user_type" value="{{Auth::user()->user_type}}">
                          <div class="profileHead profileAlignleft">
                            <h3>Change Password</h3>
                          </div>
                          <table class="table">
                            <tbody>
                               <tr>
                                <td style="text-align:right;" class="inputBold">Old Password:</td>
                                <td style="text-align:left;"><input type="password" name="password"></td>
                              </tr>
                              <tr>
                                <td style="text-align:right;" class="inputBold">New Password:</td>
                                <td style="text-align:left;"><input type="password" name="new_password"></td>
                              </tr>
                              <tr>
                                <td style="text-align:right;" class="inputBold">Confirm New Password:</td>
                                <td style="text-align:left;"><input type="password" name="confirm_password"></td>
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
                      <form role="editprofile" method="POST" action="{{url('editprofile')}}">
                        {{csrf_field()}}
                      <div class="profileHead profileAlignleft">
                        <h3>Edit Profile</h3>
                      </div>
                      <div class="clearfix">
                        <table class="table tableLeft">
                          <tbody>
                            <tr>
                              <td style="text-align:right;"><input type="hidden" name="id" value="{{\Auth::user()->id}}"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Upload Profile:</td>
                              <td style="text-align:left;"><input type="file" name="image" onchange="readURL(this)" id="uploadFile" accept="image/*" style="border:none;"></td>
                              <div>
                                @if(!empty($agent['image']))
                                  <img src="{{url('assets/img/agent')}}/{{$agent['image']}}" width="100" height="100" class="img-circle border-img" onchange="readURL(this)" id="uploadFile" accept="image/*">
                                @else
                                  <img src="{{url('assets/img/avatar.png')}}" width="100" height="100" class="img-circle border-img" id="adminimg">
                                @endif
                              </div>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Name:</td>
                              <td style="text-align:left;"><input type="text" name="name" value="{{Auth::user()->first_name}}"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Father's/Mother's Name:</td>
                              <td style="text-align:left;"><input type="text" name="spouse_name" value="{{$agent['spouse_name']}}"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Registered As:</td>
                              <td style="text-align:left;"><input type="text" name="user_type" value="{{ucfirst(Auth::user()->user_type)}}" readonly></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">District:</td>
                              <td style="text-align:left;"><input type="text" name="district" value="{{$agent['district']}}"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Email:</td>
                              <td style="text-align:left;"><input type="text" name="email" value="{{Auth::user()->email}}" readonly></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Mobile no.:</td>
                              <td style="text-align:left;"><input type="text" name="mobile" value="{{Auth::user()->phone}}"></td>
                            </tr>
                           </tbody>
                        </table>
                         <table class="table tableLeft tableEdit">
                          <tbody>
                            <tr>
                              <td style="text-align:right;" class="inputBold">DOB:</td>
                              <td style="text-align:left;"><input type="date" name="dob" value="{{$agent['dob']}}"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Adhaar Number:</td>
                              <td style="text-align:left;"><input type="text" name="adhaar" value="{{$agent['adhaar']}}"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">PAN Number:</td>
                              <td style="text-align:left;"><input type="text" name="pan" value="{{$agent['pan']}}"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Address</td>
                              <td style="text-align:left;"><input type="text" name="address" id="autocomplete" value="{{$agent['address']}}"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Nominee:</td>
                              <td style="text-align:left;"><input type="text" name="nominee" value="{{$agent['nominee']}}"></td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Nominee DOB:</td>
                              <td style="text-align:left;"><input type="date" name="dob_nominee" value="{{$agent['dob_nominee']}}"> </td>
                            </tr>
                            <tr>
                              <td style="text-align:right;" class="inputBold">Relation:</td>
                              <td style="text-align:left;"><input type="text" name="relation" value="{{$agent['relation']}}"></td>
                            </tr>
                           <!--  <tr>

                              <td style="text-align:left;"></td>
                              <td style="text-align:center;"></td>
                            </tr> -->
                          </tbody>
                        </table>
                        </div>
                      <div>
                        <button type="button" data-request="ajax-submit" data-target='[role="editprofile"]' class="btn-info">Edit Profile</button>
                      </div>
                      </form>
                    </div>

                    <div id="propertysold" class="tab-pane fade clearfix bordertable">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>S.no</th>
                            <th>Property Image</th>
                            <th>Client Name</th>
                            <th>Property Name</th>
                            <th>Property Location</th>
                            <th>Property Price</th>
                            <th>Property Area</th>
                            <th>Property Purpose</th>
                            <th>Property Type</th>
                            <!-- <th>Actions</th> -->
                          </tr>
                        </thead>
                          <tbody>
                            @php  
                              $i=0;
                            @endphp
                              @foreach($soldProperty as $soldProperties)
                            @php
                              $i++;
                            @endphp
                            <tr>
                              <td>{{$i}}</td>
                              <td><img src="{{asset('assets/img/properties/'.$soldProperties['property']['featured_image'])}}" class="list_img" style="width: 120px; height: 80px;"></td>
                              <td>{{$soldProperties['client']['name']}}</td>
                              <td>{{$soldProperties['property']['name']}}</td>
                              <td>{{$soldProperties['property']['location']}}</td>
                              <td>Rs.{{number_format($soldProperties['property']['price'])}}</td>
                              <td>{{number_format($soldProperties['property']['area'])}} {{$soldProperties['units']['name']}}</td>
                              <td>{{ucfirst($soldProperties['property']['property_purpose'])}}</td>
                              <td>{{ucfirst($soldProperties['property']['property_construct'])}}</td>
                              
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div id="account" class="tab-pane fade clearfix bordertable">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
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

</script>
@endsection