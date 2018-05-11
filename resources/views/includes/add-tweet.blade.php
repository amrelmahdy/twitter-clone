<div class="panel-heading">
    <div class="media">
        <a class="media-left" href="#fake">
            <img style="width: 40px;height: 40px" alt="" class="media-object img-rounded" src="{{ Auth::user()->image }}">
        </a>
        <div class="media-body">
            <form id="add-new-tweet">
                <div class="form-group has-feedback">
                    {{ csrf_field() }}
                    <label  class="control-label sr-only" for="add-tweet">Hidden label</label>
                    <input  type="text" name="tweet" class="form-control" id="add-tweet" aria-describedby="search" placeholder="What's happening?">
                   {{-- <span class="glyphicon glyphicon-camera form-control-feedback"
                          aria-hidden="true"></span>
                    <span id="search2" class="sr-only">(success)</span>--}}
                </div>
            </form>
        </div>
    </div>
</div>