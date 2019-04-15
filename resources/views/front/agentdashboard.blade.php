<section class="sectionAgent">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="bordered-box spaceboth">
            <ul class="nav nav-tabs">
              <li  class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
              <li><a  data-toggle="tab" href="#account">Account Details</a></li>
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
                        <img src="{{asset('assets/img/avatar.png')}}" width="100" height="100" class="img-circle border-img">
                      </div>
                      <table class="table">
                        <tbody>
                          <tr>
                            <td style="text-align:right;">Name:</td>
                            <td style="text-align:left;">{{Auth::user()->first_name}}</td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Registered As:</td>
                            <td style="text-align:left;">{{ucfirst(Auth::user()->user_type)}}</td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">District:</td>
                            <td style="text-align:left;">---</td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Email:</td>
                            <td style="text-align:left;">{{Auth::user()->email}}</td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Mobile no.:</td>
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
                                <td style="text-align:right;">Old Password:</td>
                                <td style="text-align:left;"><input type="password" name="password"></td>
                              </tr>
                              <tr>
                                <td style="text-align:right;">New Password:</td>
                                <td style="text-align:left;"><input type="password" name="new_password"></td>
                              </tr>
                              <tr>
                                <td style="text-align:right;">Confirm New Password:</td>
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
                      <table class="table tableLeft">
                        <tbody>
                          <tr>
                            <td style="text-align:right;"><input type="hidden" name="id" value="{{\Auth::user()->id}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Upload Profile:</td>
                            <td style="text-align:left;"><input type="file" name="image" onchange="readURL(this)" id="uploadFile" accept="image/*" style="border:none;"></td>
                            <div>
                              <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
                            </div>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Name:</td>
                            <td style="text-align:left;"><input type="text" name="name" value="{{Auth::user()->first_name}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Father's/Mother's Name:</td>
                            <td style="text-align:left;"><input type="text" name="spouse_name" value=""></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Registered As:</td>
                            <td style="text-align:left;"><input type="text" name="user_type" value="{{ucfirst(Auth::user()->user_type)}}" readonly></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">District:</td>
                            <td style="text-align:left;"><input type="text" name="district"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Email:</td>
                            <td style="text-align:left;"><input type="text" name="email" value="{{Auth::user()->email}}" readonly></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Mobile no.:</td>
                            <td style="text-align:left;"><input type="text" name="mobile" value="{{Auth::user()->phone}}"></td>
                          </tr>
                         </tbody>
                      </table>
                       <table class="table tableLeft">
                        <tbody>
                          <tr>
                            <td style="text-align:right;">DOB:</td>
                            <td style="text-align:left;"><input type="date" name="dob"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Adhaar Number:</td>
                            <td style="text-align:left;"><input type="text" name="adhaar" value=""></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">PAN Number:</td>
                            <td style="text-align:left;"><input type="text" name="pan" value=""></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Address</td>
                            <td style="text-align:left;"><input type="text" name="address" id="autocomplete"></td>
                            <input type="hidden" name="city" id="city">
                            <input type="hidden" name="latitude" id="cityLat">
                            <input type="hidden" name="longitude" id="cityLng">
                          </tr>
                          <tr>
                            <td style="text-align:right;">Nominee:</td>
                            <td style="text-align:left;"><input type="text" name="nominee"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Nominee DOB:</td>
                            <td style="text-align:left;"><input type="date" name="dob_nominee"> </td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Relation:</td>
                            <td style="text-align:left;"><input type="text" name="relation"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;"><button type="button" data-request="ajax-submit" data-target='[role="editprofile"]' class="btn-info">Edit Profile</button></td>
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