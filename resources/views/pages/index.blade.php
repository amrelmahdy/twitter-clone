@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <!-- user info -->
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <!-- about user -->
                        <a href="{{ route('profile', Auth::user()->username) }}"><img class="img-responsive avatar"
                                                                                      alt=""
                                                                                      style="width:64px !important; height: 64px !important;"
                                                                                      src="{{ Auth::user() &&  Auth::user()->image ?  Auth::user()->image  :'http://placehold.it/800x500' }}"></a>
                        <div class="user-info">
                            @include('includes.about-user', ['width' => 64, 'height' => 64])
                        </div>
                    </div>
                </div>
                 <!-- trends -->
                <div class="panel panel-default panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Trends
                            <small><a href="#">ciao</a></small>
                        </h3>
                    </div>

                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li><a href="#">#Cras justo odio</a></li>
                            <li><a href="#">#Dapibus ac facilisis in</a></li>
                            <li><a href="#">#Morbi leo risus</a></li>
                            <li><a href="#">#Porta ac consectetur ac</a></li>
                            <li><a href="#">#Vestibulum at eros</a></li>
                            <li><a href="#">#Vestibulum at eros</a></li>
                            <li><a href="#">#Vestibulum at eros</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-info">

                    @include('includes.add-tweet')

                    <div class="panel-body tweets">
                        @include('includes.tweets', ['tweets' => Auth::user()->timelineTweets() ])
                    </div>
                </div>

            </div>

            <div class="col-sm-3">
                <div class="panel panel-default panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Who to follow
                            <small><a href="#">Refresh</a> ● <a href="#">View all</a></small>
                        </h3>
                    </div>
                    <div class="panel-body who-to-follow">
                        @include('includes.user-to-follow')
                    </div>
                    <div class="panel-footer">
                        <a href="www.google.it">
                            <span class="glyphicon glyphicon-user"></span>
                            Find people you know
                        </a>
                    </div>
                </div>
                <div class="well well-sm">
                    <ul class="list-inline">
                        <li>© 2015 Twitter</li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Cookies</a></li>
                        <li><a href="#">Ads info</a></li>
                        <li><a href="#">Brand</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Status</a></li>
                        <li><a href="#">Apps</a></li>
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Advertise</a></li>
                        <li><a href="#">Businesses</a></li>
                        <li><a href="#">Media</a></li>
                        <li><a href="#">Developers</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop