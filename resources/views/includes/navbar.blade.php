<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/"><span class="glyphicon glyphicon-home"></span> Home</a>
                </li>
                <li>
                    <a href="#fake"><span class="glyphicon glyphicon-bell"></span> Notifications</a>
                </li>
                <li>
                    <a href="#fake"><span class="glyphicon glyphicon-envelope"></span> Messages</a>
                </li>
            </ul>


            <div class="navbar-brand hidden-xs hidden-sm">
                <a class="navbar-brand" href="#">
                    <img src="/images/logo.png" alt="logo" />
                </a>
            </div>



            <div class="navbar-form navbar-right">
                <!--<div class="form-group has-feedback">
                    <input type="text" class="form-control-nav" id="search" aria-describedby="search1">
                    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                </div>-->


                <ul class="avatar-list">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->image }}" alt="avatar"/>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="user-data-li">
                                <strong>{{ Auth::user()->name }}</strong>
                                <span>{{ '@' . Auth::user()->username }}</span>
                            </li>
                            <li><a href="{{ route('profile', Auth::user()->username) }}">Profile</a></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>


               {{-- <button class="btn btn-primary btn-tweet" style="margin-top: 7px" type="submit" aria-label="Left Align">
                    Tweet
                </button>--}}
            </div>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
