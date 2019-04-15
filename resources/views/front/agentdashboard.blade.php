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
                            <td style="text-align:right;">City:</td>
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
                      <div class="profileHead profileAlignleft">
                        <h3>Edit Profile</h3>
                      </div>
                      <table class="table tableLeft">
                        <tbody>
                          <tr>
                            <td style="text-align:right;">Upload Profile:</td>
                            <td style="text-align:left;"><input type="file" name="name" style="border:none;"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Name:</td>
                            <td style="text-align:left;"><input type="text" name="name"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Registered As:</td>
                            <td style="text-align:left;"><input type="text" name="name"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">City:</td>
                            <td style="text-align:left;"><input type="text" name="name"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Email:</td>
                            <td style="text-align:left;"><input type="text" name="name"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Mobile no.:</td>
                            <td style="text-align:left;"><input type="text" name="name"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Password:</td>
                            <td style="text-align:left;"><input type="text" name="name"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;"><button class="btn-info">Edit Profile</button></td>
                            <td style="text-align:left;"></td>
                          </tr>
                         </tbody>
                      </table>
                       <table class="table tableLeft">
                        <tbody>
                          <tr>
                            <td style="text-align:right;">Upload Profile:</td>
                            <td style="text-align:left;"><input type="file" name="image" style="border:none;"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Father's/Mother's Name:</td>
                            <td style="text-align:left;"><input type="text" name="spouse_name"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Date of Birth:</td>
                            <td style="text-align:left;"><input type="date" name="dob"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">City:</td>
                            <td style="text-align:left;"><input type="text" name="name"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Email:</td>
                            <td style="text-align:left;"><input type="text" name="name" readonly value="{{Auth::user()->email}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;">Mobile no.:</td>
                            <td style="text-align:left;"><input type="text" name="phone" readonly value="{{Auth::user()->phone}}"></td>
                          </tr>
                          <tr>
                            <td style="text-align:right;"><button class="btn-info">Edit Profile</button></td>
                            <td style="text-align:left;"></td>
                          </tr>
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
  </section>