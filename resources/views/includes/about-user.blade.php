<div class="row">
    <div class="col-xs-3">
        <h5>
            <small>TWEETS</small>
            <a href="#">
                {{ Auth::user()->tweets->count() }}
            </a>
        </h5>
    </div>
    <div class="col-xs-4">
        <h5>
            <small>FOLLOWING</small>
            <a class="block" href="#">{{ Auth::user()->followings->count() }}</a>
        </h5>
    </div>
    <div class="col-xs-5">
        <h5>
            <small>FOLLOWERS</small>
            <a class="block" href="#">
                {{ Auth::user()->followers->count() }}
            </a>
        </h5>
    </div>
</div>
