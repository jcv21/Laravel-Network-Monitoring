@extends('layout.app')


@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User Profile</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-4 col-sm-4 profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar">
                                <img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar">
                            </div>
                        </div>
                        <h3>Samuel Doe</h3>
                        <ul class="list-unstyled user_data">
                            <li>
                                <i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
                            </li>
                            <li>
                                <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection