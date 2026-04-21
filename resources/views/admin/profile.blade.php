@extends('layouts.adminlayout')



@section('content')

    <div class="nk-content p-0">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm pt-3">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Profile</h3>
                            </div>
                            <div class="nk-block-head-content">
                            </div>
                        </div>
                    </div>
                    <!-- .nk-block-head -->
                    <div class="nk-block">
                        @include('layouts.error')
                        <div class="row">
                            <div class="col-md-9">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="form-group">
                                                    <label class="form-label" for="first-name">First Name <span class="color-red">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="first-name" required value="{{ $user->firstname }}" readonly name="firstname" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="last-name">Last Name  <span class="color-red">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="last-name" required name="lastname" readonly value="{{ $user->lastname }}" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email  <span class="color-red">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="email" id="email" class="form-control" required name="email" readonly value="{{ $user->email }}"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="telephone">Telephone</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" id="telephone" class="form-control" name="telephone" readonly value="{{ $user->telephone }}"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="job_title">Team</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" id="job_title" class="form-control" name="job_title" readonly value="{{ $user->team }}"  />
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    {{--<div class="card card-bordered">
                                        <div class="card-header">
                                            <h4>Your Hospital Preferences</h4>
                                        </div>
                                        <div class="card-inner">
                                            <form method="post" action="{{ ADMIN_PROFILE }}" enctype="multipart/form-data" >
                                             <p>Using the selectlist below, tell us what hospitals you work with.</p>
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" name="hospitals[]" multiple="multiple" >
                                                            <option value="">Select Hospital</option>
                                                            <?php if(count($hospitals)){
                                                                    foreach ($hospitals  as $hosp){ ?>
                                                            <option value="{{ $hosp->hospital_id }}" @if(!empty($cmsuserhospitals)&&in_array($hosp->hospital_id,$cmsuserhospitals)) selected @endif >{{ $hosp->eclipse_client_name }}</option>
                                                                <?php    } }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="submittype" value="update-hospitals" />
                                                    <button type="submit" class="btn btn-primary" >Save/Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>--}}
                            </div>
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-header">
                                        <h4>Last Updated</h4>
                                    </div>
                                    <div class="card-inner">
                                        <ul>
                                            <li>Last Created: {{ format_date($user->createdate) }}</li>
                                            <li>Last Updated: {{ format_date($user->updatedate) }}</li>
                                        </ul>
                                    </div>
                                    </div>

                                {{--<div class="card card-bordered">
                                    <div class="card-header">
                                        <h4>Preferences</h4>
                                    </div>
                                    <div class="card-inner">
                                        <form method="post" action="{{ ADMIN_PROFILE }}">
                                        <div class="form-group">
                                            <label class="form-label" for="hide_payroll_week">Hide Payroll Week?</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="hide_payroll_week" name="preference[hide_payroll_week]">
                                                    <option value="1" <?php if(!empty($userpreference)&&$userpreference->hide_payroll_week=='1'){ echo 'selected'; }?>>Yes</option>
                                                    <option value="0"  <?php if(!empty($userpreference)&&$userpreference->hide_payroll_week=='0'){ echo 'selected'; }?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="order_by_job_title">Order candidates by job title?</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="order_by_job_title" name="preference[order_by_job_title]">
                                                    <option value="1" <?php if(!empty($userpreference)&&$userpreference->order_by_job_title=='1'){ echo 'selected'; }?>>Yes</option>
                                                    <option value="0"  <?php if(!empty($userpreference)&&$userpreference->order_by_job_title=='0'){ echo 'selected'; }?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="disable_bulk_sms">Disable bulk SMS</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="disable_bulk_sms" name="preference[disable_bulk_sms]">
                                                    <option value="1" <?php if(!empty($userpreference)&&$userpreference->disable_bulk_sms=='1'){ echo 'selected'; }?>>Yes</option>
                                                    <option value="0"  <?php if(!empty($userpreference)&&$userpreference->disable_bulk_sms=='0'){ echo 'selected'; }?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="default_weeks_to_display">Weeks to display as default?</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="default_weeks_to_display" name="preference[default_weeks_to_display]">
                                                    <option value="2" <?php if(!empty($userpreference)&&$userpreference->default_weeks_to_display=='2'){ echo 'selected'; }?>>2</option>
                                                    <option value="3"  <?php if(!empty($userpreference)&&$userpreference->default_weeks_to_display=='3'){ echo 'selected'; }?>>3</option>
                                                    <option value="4"  <?php if(!empty($userpreference)&&$userpreference->default_weeks_to_display=='4'){ echo 'selected'; }?>>4</option>
                                                    <option value="5"  <?php if(!empty($userpreference)&&$userpreference->default_weeks_to_display=='5'){ echo 'selected'; }?>>5</option>
                                                    <option value="6"  <?php if(!empty($userpreference)&&$userpreference->default_weeks_to_display=='6'){ echo 'selected'; }?>>6</option>
                                                </select>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <label class="form-label" for="enable_booking_reminder">Enable booking reminder</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="enable_booking_reminder" name="preference[enable_booking_reminder]">
                                                        <option value="1" <?php if(!empty($userpreference)&&$userpreference->enable_booking_reminder=='1'){ echo 'selected'; }?>>Yes</option>
                                                        <option value="0"  <?php if(!empty($userpreference)&&$userpreference->enable_booking_reminder=='0'){ echo 'selected'; }?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="prereg_limit">Pre Reg limit</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="prereg_limit" required value="<?php if(!empty($userpreference)&&!empty($userpreference->prereg_limit)){ echo $userpreference->prereg_limit; }?>" name="preference[prereg_limit]" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="submittype" value="preference-update" />
                                                <button type="submit" class="btn btn-primary" >Save/Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>--}}
                                {{--<div class="card card-bordered">
                                    <div class="card-header">
                                        <h4>Job title - colours</h4>
                                    </div>
                                    <div class="card-inner">
                                        <p>Assign colours to your job titles</p>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Job title</th>
                                                <th>Colour</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(count($cujtcarray) > 0)
                                            {
                                            $i = 0;
                                            foreach($cujtcarray as $data)
                                            {
                                            ?>
                                            <tr>
                                                <td data-label="Name: "><?php echo $data->discipline?></td>
                                                <td data-label="Colour: "><a class="editableTextbox" data-pk="<?php echo $data->discipline; ?>"><?php if(!empty($data->colour_hex)){ echo $colours_hex[$data->colour_hex][1]; }?></a></td>
                                            </tr>
                                            <?php
                                            $i++;
                                            }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>--}}

                            </div>

                        <!--card card-bordered-->
                        </div>
                    </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

<!-- content @e -->

@endsection
@section('footerscripts')
    <script>
        $("#changepassword").click(function () {
            var pass = $(this).is(':checked');
            if(pass){
                $("#passwordblock").show();
            }else{
                $("#passwordblock").hide();
            }
        });
    </script>
@endsection
