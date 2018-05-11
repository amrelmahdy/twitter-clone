@forelse(Auth::user()->usersToFollow()->take(3) as $user)
    <div class="media">
        <div class="media-left">
            <a href="{{ route('profile', $user->username) }}"> <img src="{{ $user->image }}" alt="" class="media-object img-rounded"></a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">{{ $user->name }}</h4>
            <div class="follow-btn-wrapper">
                <button data-id="{{ $user->id }}" class="follow btn btn-primary rounded-bottom">Follow</button>
            </div>
        </div>
    </div>
@empty
    <div class="media">
        <div class="media-body text-center">
            No Suggestions ..
        </div>
    </div>
@endforelse