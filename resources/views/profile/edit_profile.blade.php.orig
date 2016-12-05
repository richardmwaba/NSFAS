@extends('layouts.hod_template')
@section('title', 'Edit Profile')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->first_name}} ({{$user->man_number}})</div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ url('update_profile') }}">
                                {!! csrf_field() !!}

                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label>First Name</label>
<<<<<<< HEAD
                                    <input class="form-control" name="first_name" placeholder="{{$user->first_name}}"
                                           value="{{$user->first_name}}">
=======
                                    <input class="form-control" name="first_name" placeholder="{{$user->first_name}}" value="{{$user->first_name}}">
>>>>>>> in3rtia
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('other_names') ? ' has-error' : '' }}">
                                    <label>Middle Name</label>
<<<<<<< HEAD
                                    <input class="form-control" name="other_names" placeholder="{{$user->other_names}}"
                                           value="{{$user->other_names}}">
=======
                                    <input class="form-control" name="other_names" placeholder="{{$user->other_names}}" value="{{$user->other_names}}">
>>>>>>> in3rtia
                                    @if ($errors->has('other_names'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('other_names') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label>Last Name</label>
<<<<<<< HEAD
                                    <input class="form-control" name="last_name" placeholder="{{$user->last_name}}"
                                           value="{{$user->last_name}}">
=======
                                    <input class="form-control" name="last_name" placeholder="{{$user->last_name}}" value="{{$user->last_name}}">
>>>>>>> in3rtia
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>E-mail Address</label>
<<<<<<< HEAD
                                    <input class="form-control" placeholder="{{$user->email}}" value="{{$user->email}}"
                                           name="email" type="email">
=======
                                    <input class="form-control" placeholder="{{$user->email}}" value="{{$user->email}}" name="email" type="email">
>>>>>>> in3rtia
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label>Nationality</label>

                                    <select name="nationality" class="form-control">
                                        <option value="{{$user->nationality}}">{{$user->nationality}}</option>
                                        <option value="afghan">Afghan</option>
                                        <option value="albanian">Albanian</option>
                                        <option value="algerian">Algerian</option>
                                        <option value="american">American</option>
                                        <option value="andorran">Andorran</option>
                                        <option value="angolan">Angolan</option>
                                        <option value="antiguans">Antiguans</option>
                                        <option value="argentinean">Argentinean</option>
                                        <option value="armenian">Armenian</option>
                                        <option value="australian">Australian</option>
                                        <option value="austrian">Austrian</option>
                                        <option value="azerbaijani">Azerbaijani</option>
                                        <option value="bahamian">Bahamian</option>
                                        <option value="bahraini">Bahraini</option>
                                        <option value="bangladeshi">Bangladeshi</option>
                                        <option value="barbadian">Barbadian</option>
                                        <option value="barbudans">Barbudans</option>
                                        <option value="batswana">Batswana</option>
                                        <option value="belarusian">Belarusian</option>
                                        <option value="belgian">Belgian</option>
                                        <option value="belizean">Belizean</option>
                                        <option value="beninese">Beninese</option>
                                        <option value="bhutanese">Bhutanese</option>
                                        <option value="bolivian">Bolivian</option>
                                        <option value="bosnian">Bosnian</option>
                                        <option value="brazilian">Brazilian</option>
                                        <option value="british">British</option>
                                        <option value="bruneian">Bruneian</option>
                                        <option value="bulgarian">Bulgarian</option>
                                        <option value="burkinabe">Burkinabe</option>
                                        <option value="burmese">Burmese</option>
                                        <option value="burundian">Burundian</option>
                                        <option value="cambodian">Cambodian</option>
                                        <option value="cameroonian">Cameroonian</option>
                                        <option value="canadian">Canadian</option>
                                        <option value="cape verdean">Cape Verdean</option>
                                        <option value="central african">Central African</option>
                                        <option value="chadian">Chadian</option>
                                        <option value="chilean">Chilean</option>
                                        <option value="chinese">Chinese</option>
                                        <option value="colombian">Colombian</option>
                                        <option value="comoran">Comoran</option>
                                        <option value="congolese">Congolese</option>
                                        <option value="costa rican">Costa Rican</option>
                                        <option value="croatian">Croatian</option>
                                        <option value="cuban">Cuban</option>
                                        <option value="cypriot">Cypriot</option>
                                        <option value="czech">Czech</option>
                                        <option value="danish">Danish</option>
                                        <option value="djibouti">Djibouti</option>
                                        <option value="dominican">Dominican</option>
                                        <option value="dutch">Dutch</option>
                                        <option value="east timorese">East Timorese</option>
                                        <option value="ecuadorean">Ecuadorean</option>
                                        <option value="egyptian">Egyptian</option>
                                        <option value="emirian">Emirian</option>
                                        <option value="equatorial guinean">Equatorial Guinean</option>
                                        <option value="eritrean">Eritrean</option>
                                        <option value="estonian">Estonian</option>
                                        <option value="ethiopian">Ethiopian</option>
                                        <option value="fijian">Fijian</option>
                                        <option value="filipino">Filipino</option>
                                        <option value="finnish">Finnish</option>
                                        <option value="french">French</option>
                                        <option value="gabonese">Gabonese</option>
                                        <option value="gambian">Gambian</option>
                                        <option value="georgian">Georgian</option>
                                        <option value="german">German</option>
                                        <option value="ghanaian">Ghanaian</option>
                                        <option value="greek">Greek</option>
                                        <option value="grenadian">Grenadian</option>
                                        <option value="guatemalan">Guatemalan</option>
                                        <option value="guinea-bissauan">Guinea-Bissauan</option>
                                        <option value="guinean">Guinean</option>
                                        <option value="guyanese">Guyanese</option>
                                        <option value="haitian">Haitian</option>
                                        <option value="herzegovinian">Herzegovinian</option>
                                        <option value="honduran">Honduran</option>
                                        <option value="hungarian">Hungarian</option>
                                        <option value="icelander">Icelander</option>
                                        <option value="indian">Indian</option>
                                        <option value="indonesian">Indonesian</option>
                                        <option value="iranian">Iranian</option>
                                        <option value="iraqi">Iraqi</option>
                                        <option value="irish">Irish</option>
                                        <option value="israeli">Israeli</option>
                                        <option value="italian">Italian</option>
                                        <option value="ivorian">Ivorian</option>
                                        <option value="jamaican">Jamaican</option>
                                        <option value="japanese">Japanese</option>
                                        <option value="jordanian">Jordanian</option>
                                        <option value="kazakhstani">Kazakhstani</option>
                                        <option value="kenyan">Kenyan</option>
                                        <option value="kittian and nevisian">Kittian and Nevisian</option>
                                        <option value="kuwaiti">Kuwaiti</option>
                                        <option value="kyrgyz">Kyrgyz</option>
                                        <option value="laotian">Laotian</option>
                                        <option value="latvian">Latvian</option>
                                        <option value="lebanese">Lebanese</option>
                                        <option value="liberian">Liberian</option>
                                        <option value="libyan">Libyan</option>
                                        <option value="liechtensteiner">Liechtensteiner</option>
                                        <option value="lithuanian">Lithuanian</option>
                                        <option value="luxembourger">Luxembourger</option>
                                        <option value="macedonian">Macedonian</option>
                                        <option value="malagasy">Malagasy</option>
                                        <option value="malawian">Malawian</option>
                                        <option value="malaysian">Malaysian</option>
                                        <option value="maldivan">Maldivan</option>
                                        <option value="malian">Malian</option>
                                        <option value="maltese">Maltese</option>
                                        <option value="marshallese">Marshallese</option>
                                        <option value="mauritanian">Mauritanian</option>
                                        <option value="mauritian">Mauritian</option>
                                        <option value="mexican">Mexican</option>
                                        <option value="micronesian">Micronesian</option>
                                        <option value="moldovan">Moldovan</option>
                                        <option value="monacan">Monacan</option>
                                        <option value="mongolian">Mongolian</option>
                                        <option value="moroccan">Moroccan</option>
                                        <option value="mosotho">Mosotho</option>
                                        <option value="motswana">Motswana</option>
                                        <option value="mozambican">Mozambican</option>
                                        <option value="namibian">Namibian</option>
                                        <option value="nauruan">Nauruan</option>
                                        <option value="nepalese">Nepalese</option>
                                        <option value="new zealander">New Zealander</option>
                                        <option value="ni-vanuatu">Ni-Vanuatu</option>
                                        <option value="nicaraguan">Nicaraguan</option>
                                        <option value="nigerien">Nigerien</option>
                                        <option value="north korean">North Korean</option>
                                        <option value="northern irish">Northern Irish</option>
                                        <option value="norwegian">Norwegian</option>
                                        <option value="omani">Omani</option>
                                        <option value="pakistani">Pakistani</option>
                                        <option value="palauan">Palauan</option>
                                        <option value="panamanian">Panamanian</option>
                                        <option value="papua new guinean">Papua New Guinean</option>
                                        <option value="paraguayan">Paraguayan</option>
                                        <option value="peruvian">Peruvian</option>
                                        <option value="polish">Polish</option>
                                        <option value="portuguese">Portuguese</option>
                                        <option value="qatari">Qatari</option>
                                        <option value="romanian">Romanian</option>
                                        <option value="russian">Russian</option>
                                        <option value="rwandan">Rwandan</option>
                                        <option value="saint lucian">Saint Lucian</option>
                                        <option value="salvadoran">Salvadoran</option>
                                        <option value="samoan">Samoan</option>
                                        <option value="san marinese">San Marinese</option>
                                        <option value="sao tomean">Sao Tomean</option>
                                        <option value="saudi">Saudi</option>
                                        <option value="scottish">Scottish</option>
                                        <option value="senegalese">Senegalese</option>
                                        <option value="serbian">Serbian</option>
                                        <option value="seychellois">Seychellois</option>
                                        <option value="sierra leonean">Sierra Leonean</option>
                                        <option value="singaporean">Singaporean</option>
                                        <option value="slovakian">Slovakian</option>
                                        <option value="slovenian">Slovenian</option>
                                        <option value="solomon islander">Solomon Islander</option>
                                        <option value="somali">Somali</option>
                                        <option value="south african">South African</option>
                                        <option value="south korean">South Korean</option>
                                        <option value="spanish">Spanish</option>
                                        <option value="sri lankan">Sri Lankan</option>
                                        <option value="sudanese">Sudanese</option>
                                        <option value="surinamer">Surinamer</option>
                                        <option value="swazi">Swazi</option>
                                        <option value="swedish">Swedish</option>
                                        <option value="swiss">Swiss</option>
                                        <option value="syrian">Syrian</option>
                                        <option value="taiwanese">Taiwanese</option>
                                        <option value="tajik">Tajik</option>
                                        <option value="tanzanian">Tanzanian</option>
                                        <option value="thai">Thai</option>
                                        <option value="togolese">Togolese</option>
                                        <option value="tongan">Tongan</option>
                                        <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                        <option value="tunisian">Tunisian</option>
                                        <option value="turkish">Turkish</option>
                                        <option value="tuvaluan">Tuvaluan</option>
                                        <option value="ugandan">Ugandan</option>
                                        <option value="ukrainian">Ukrainian</option>
                                        <option value="uruguayan">Uruguayan</option>
                                        <option value="uzbekistani">Uzbekistani</option>
                                        <option value="venezuelan">Venezuelan</option>
                                        <option value="vietnamese">Vietnamese</option>
                                        <option value="welsh">Welsh</option>
                                        <option value="yemenite">Yemenite</option>
                                        <option value="zambian" selected>Zambian</option>
                                        <option value="zimbabwean">Zimbabwean</option>
                                        @if ($errors->has('nationality'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                                        @endif
                                    </select>

                                </div>

                                <div class="form-group{{ $errors->has('NRC') ? ' has-error' : '' }}">
                                    <label>NRC Number</label>
                                    <input class="form-control" placeholder="{{$user->NRC}}" value="{{$user->NRC}}" name="nrc_number" type="">
                                    @if ($errors->has('NRC'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('NRC') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Residential Address</label>
<<<<<<< HEAD
                                    <input class="form-control" placeholder="address" name="address"
                                           value="{{$user->address}}">
=======
                                    <input class="form-control" placeholder="address" name="address" value="{{$user->address}}">
>>>>>>> in3rtia
                                </div>

                                <div class="form-group">
                                    <label>Phone Number</label>
<<<<<<< HEAD
                                    <input class="form-control" placeholder="+260" name="phone_number"
                                           value="{{$user->phone_number}}">
=======
                                    <input class="form-control" placeholder="+260" name="phone_number" value="{{$user->phone_number}}">
>>>>>>> in3rtia
                                </div>
                                <div class="form-group">
                                    <a href="#" class="btn btn-link" role="button" data-toggle="modal"
                                       data-target="#changePass" onclick="" id="">Change password?</a>
                                </div>
                                <div id="demo" class="collapse">

                                </div>

                                <!--Research on how to compare passwords entered in these fields-->

                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                </div>

                            </form>

                            <!-- Change password modal -->
                            <form id="changePassword" class="form-horizontal" role="form">
                                {!! csrf_field() !!}
                                <div class="modal fade" id="changePass" role="dialog">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button id="close" type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-primary"> Change Password</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
<<<<<<< HEAD

                                                        <div id="current_password-group" class="form-group">
                                                            <label>Current Password</label>
                                                            <input class="form-control" placeholder="Password"
                                                                   name="current_password" type="password">
=======
                                                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                                            <label>Current Password</label>
                                                            <input class="form-control" placeholder="Password" name="current_password" type="password">
                                                            @if ($errors->has('current_password'))
                                                                <span class="help-block">
                                                                <strong>{{ $errors->first('current_password') }}</strong>
                                                            </span>
                                                            @endif
>>>>>>> in3rtia
                                                        </div>

                                                        <div id="password-group" class="form-group">
                                                            <label>Enter New Password</label>
                                                            <input class="form-control" placeholder="Password"
                                                                   name="password" type="password">
                                                        </div>

                                                        <div id="password_confirmation-group" class="form-group">
                                                            <label>Confirm New Password</label>
                                                            <input class="form-control" placeholder="Password"
                                                                   name="password_confirmation" type="password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md- ">
<<<<<<< HEAD
                                                    <button onclick="changePassword()" class="btn btn-default">save
                                                    </button>
=======
                                                    <button name="changePassword" id="changePassword" class="btn btn-primary">Save</button>
>>>>>>> in3rtia
                                                    <!--</div>
                                                    <div class="">-->
                                                    <button type="reset" class="btn btn-default">Cancel</button>
                                                </div>

                                                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.Change password modal-->
                            </form>
                        </div>
                        <!-- /.col-md-6-->

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    <script>
        function changePassword() {

            $(document).ready(function () {

                $("#button").click(function () {
                    $("#demo").toggle();
                });
                // process the form
                $('#changePassword').submit(function (event) {
                    event.preventDefault();


                    var formData = {
                        'current_password': $('input[name=current_password]').val(),
                        'password': $('input[name=password]').val(),
                        'password_confirmation': $('input[name=password_confirmation]').val(),
                        '_token': $('input[name=_token]').val()
                    };
                    // process the form

                    $.ajax({
                                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url: '{{ url('change_password')}}', // the url where we want to POST
                                data: formData, // our data object
                                dataType: 'json', // what type of data do we expect back from the server
                                encode: true
                            })
                            // using the done promise callback
                            .done(function (data) {

                                // log data to the console so we can see
                                console.log(data);
                                // here we will handle errors and validation messages
                                // here we will handle errors and validation messages
                                if (!data.success) {

                                    // handle errors for name ---------------
                                    if (data.errors.current_password) {
                                        $('#current_password-group').addClass('has-error'); // add the error class to show red input
                                        $('#current_password-group').append('<div id="error" class="help-block">' + data.errors.current_password + '</div>'); // add the actual error message under our input
                                    }


                                    // handle errors for email ---------------
                                    if (data.errors.password) {
                                        $('#password-group').addClass('has-error'); // add the error class to show red input
                                        $('#password-group').append('<div class="help-block">' + data.errors.password + '</div>'); // add the actual error message under our input
                                    }

                                    // handle errors for superhero alias ---------------
                                    if (data.errors.password_confirmation) {
                                        $('#password_confirmation-group').addClass('has-error'); // add the error class to show red input
                                        $('#password_confirmation-group').append('<div class="help-block">' + data.errors.password_confirmation + '</div>'); // add the actual error message under our input
                                    }

                                } else {

                                    // ALL GOOD! just show the success message!
                                    //$('div.alert').append('<div class="alert alert-success">' + data.message + '</div>');
                                    $("#close").trigger('click');
                                    alert(data.message);
                                    // usually after form submission, you'll want to redirect
                                    // window.location = '/thank-you'; // redirect a user to another page
                                    // for now we'll just alert the user

                                }
                            });

                });
            });


        }
    </script>






@endsection
