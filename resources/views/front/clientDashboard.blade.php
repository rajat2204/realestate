<section class="sectionAgent">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="bordered-box spaceboth">
            <ul class="nav nav-tabs">
              <li  class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
              <li><a data-toggle="tab" href="#property">Edit Profile</a></li>
              <li><a data-toggle="tab" href="#change">Change Password</a></li>
            </ul>
            <div class="borderBoxinner">
              <div class="row">
                
                <div class="col-md-12">
                  <div class="agentprofile tab-content">
                    <div id="profile" class="tab-pane fade active">
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
                            <td style="text-align:left;"><input type="text" name="father_name" value="{{$client['father_name']}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Registered As:</td>
                            <td style="text-align:left;"><input type="text" name="user_type" value="{{ucfirst(Auth::user()->user_type)}}" readonly></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Occupation:</td>
                            <td style="text-align:left;"><input type="text" name="occupation" value="{{$client['occupation']}}"></td>
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
                            <td style="text-align:left;"><input type="text" name="address" id="autocomplete" value="{{$client['address']}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">District:</td>
                            <td style="text-align:left;"><input type="text" name="district" value="{{$client['district']}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">State:</td>
                            <td style="text-align:left;"><input type="text" name="state" value="{{$client['state']}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">DOB:</td>
                            <td style="text-align:left;"><input type="date" name="dob" value="{{$client['dob']}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">PAN Number:</td>
                            <td style="text-align:left;"><input type="text" name="pan" value="{{$client['pan']}}"> </td>
                          </tr>
                          <tr>
                            <td style="text-align:right;" class="inputBold">Nationality:</td>
                            <td style="text-align:left;"><input type="text" name="nationality" value="{{$client['nationality']}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;"><button type="button" data-request="ajax-submit" data-target='[role="clienteditprofile"]' class="btn-info">Edit Profile</button></td>
                            <td style="text-align:left;"></td>
                          </tr>
                        </tbody>
                      </table>
                      </form>
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