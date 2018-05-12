<li>
    <a>{{ $tweet->getAllFavourites() }}</a>
    <a href="#" class="favourite {{ $tweet->isFavourite() ? 'active' : '' }}" data-id="{{ $tweet->id }}"><span class="glyphicon glyphicon-star"></span></a>
</li>