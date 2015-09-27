<ul class="tweets">
    <script id="tweets-template" type="text/x-handlebars-template">
        {{#each this}}
        <li>
            <img src="{{thumb}}" alt="{{author}}">
            <img src="{{image}}" alt="{{author}}">
            <span>Created at {{date}}</span>
            <div><i class="fa fa-user-secret"></i>{{userScreenName}}</div>
            <div>{{userLocation}}</div>
            <p><a href="{{url}}">{{text}}</a></p>
        </li>
        {{/each}}
    </script>
</ul>


<script>

    (function(){

        var Twitter = {
            init: function( config ){
                this.url = 'http://weareukraine/tweets/gettweets/?count=6&screen_name=weareukraine&callback=?';
                this.template = config.template;
                //console.log(this.template);
                //return true;
                this.container = config.container;

                this.fetch();
                //console.log(this.tweets);
            },
            attachTemplate: function(){
                var template = Handlebars.compile(this.template);
                this.container.append( template( this.tweets ) );
                //console.log(html);
            },

            fetch: function(){
                var self = this;
                $.getJSON(this.url, function(data){
                    console.log(this);
                    self.tweets = $.map( data, function( tweet ) {
                        return {
                            author: tweet.user.name,
                            userScreenName: tweet.user.screen_name,
                            thumb: tweet.user.profile_image_url,
                            date: tweet.created_at,
                            text: tweet.text,
                            retweetCount: tweet.retweet_count,
                            url: 'https://twitter.com/' + tweet.user.screen_name + '/status/' + tweet.id_str,
                            userLocation: tweet.user.location,
                            // image: data[0].extended_entities.media[0].media_url
                            // image: tweet.extended_entities.media[0].media_url
                            // tweet.extended_entities.media_url_https
                        };
                    });
                    self.attachTemplate();
                    console.log(data[0].extended_entities.media[0].media_url);
                });
            }
        };

        Twitter.init({
            template: $('#tweets-template').html(),
            container: $('ul.tweets')
        });
    })(jQuery);



</script>