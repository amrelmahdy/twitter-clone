@forelse($tweets as $tweet)
    <div class="media">
        <a class="media-left" href="{{ route('profile', $tweet->tweeter->username) }}">
            <img alt="" class="media-object img-rounded" src="{{ $tweet->tweeter->image }}">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $tweet->tweeter->name }}
                <small>{{ '@' . $tweet->tweeter->username  }}</small>
                .
                <small>{{ Super::readableDate($tweet->created_at)  }}</small>
            </h4>
            <p>{{ $tweet->tweet }}</p>
            <ul class="nav nav-pills nav-pills-custom">
              {{--  <li><a href="#"><span class="glyphicon glyphicon-share-alt"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-retweet"></span></a></li>--}}
                <li><a href="#" class="favourite" data-id="{{ $tweet->id }}"><span class="glyphicon glyphicon-star"></span></a></li>
                {{--<li><a href="#"><span class="glyphicon glyphicon-option-horizontal"></span></a></li>--}}
            </ul>
        </div>
    </div>
@empty
    <div class="media">
        <div class="media-body text-center">
            <p>No Tweets Yet.</p>
        </div>
    </div>
@endforelse