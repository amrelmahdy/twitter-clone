<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>


<script>
    $(document).ready(function (e) {

        URL = "{{ url('/') }}"
        token = "{{ csrf_token() }}"

        // add tweets ...
        let tweet = {}
        $('#add-new-tweet').submit(function (e) {
            e.preventDefault();
            let tweetText = $('#add-tweet').val();

            tweet.user_id = "{{ Auth::user()->id }}"
            tweet.tweet = tweetText

             if(tweetText !== ""){
                 $.ajax({
                     url: URL + '/tweets/add-tweet',
                     type: 'POST',
                     data: $(this).serialize(),
                     dataType: 'json',
                     success: function (data) {
                         if(data.Error.status === true){
                             let currentUrl = document.URL
                             if(currentUrl === URL || currentUrl === URL + '/'){
                                 $('.tweets').load(URL + '/tweets/reload-tweets')
                             } else {
                                 $('.tweets').load(URL + '/tweets/reload-tweets/' + "{{ Auth::user()->id }}")
                             }
                             $('.user-info').load(URL + '/tweets/reload-user-info')
                         }
                     },
                     error: function (error) {
                         alert('whoops something went wrong')
                     }
                 })

                 this.reset();
             }
        })

        // follow
        $(document).on('click', '.follow', function (e) {
            let user_to_follow = $(this).data('id');
            $.ajax({
                url: URL + '/follow',
                type: 'POST',
                data: {_token: token, user_id: user_to_follow},
                success: function (data) {
                    $('.user-info').load(URL + '/tweets/reload-user-info')
                    $('.who-to-follow').load(URL + '/follow/reload-who-to-follow')
                },
                error: function (err) {

                }
            })
        })

        // favourite a tweet
        $(document).on('click', '.favourite', function (e) {
            e.preventDefault()
            let that = $(this);
            let tweet_id = $(this).data('id');
            var status = 1
            if(that.hasClass('active')){
               status = 0
            }
            $.ajax({
                url: URL + '/tweets/favourite',
                type: 'POST',
                data: {_token: token, tweet_id: tweet_id, status: status},
                success: function (data) {
                    console.log(data)
                    that.toggleClass('active')
                    console.log($(this))
                    $('.tweet-icons' + tweet_id).load(URL + '/tweets/reload-tweet-info/' + tweet_id)
                },
                error: function (err) {

                }
            })
        })
    })
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script>

@yield('scripts')