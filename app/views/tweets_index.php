<h2>These are my tweets</h2>
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

    (function () {

        var Twitter = {
            init: function (config) {

                this.url = 'http://weareukraine/tweets/gettweets/?count=6&screen_name=weareukraine&callback=?';
                this.template = config.template;
//                console.log(this.template);
//                return true;
                this.container = config.container;
                this.fetch();
            },
            attachTemplate: function () {
                var template = Handlebars.compile(this.template);
                this.container.append(template(this.tweets));
                //console.log(html);
            },

            fetch: function () {
                var self = this;
                console.log(this);
//                debugger;
                $.getJSON(this.url, function (data) {
                    console.log('I AM HERE');
                    console.log(data);
                    self.tweets = $.map(data, function (tweet) {
//                        (tweet.hasOwnProperty('extended_entities')) ?
//                            console.log(tweet.extended_entities.media[0].media_url)
//                            : console.log(null);

                        return {
                            author: tweet.user.name,
                            userScreenName: tweet.user.screen_name,
                            thumb: tweet.user.profile_image_url,
                            date: tweet.created_at,
                            text: tweet.text,
                            retweetCount: tweet.retweet_count,
                            url: 'https://twitter.com/' + tweet.user.screen_name + '/status/' + tweet.id_str,
                            userLocation: tweet.user.location
                            image: data[0].extended_entities.media[0].media_url
//                            image: tweet[0].extended_entities.media[0].media_url
                            // tweet.extended_entities.media_url_https
                        };

                    });
                    self.attachTemplate();
                    console.log(data[0].extended_entities.media[0].media_url);
                    console.log(data.length);
                    for (key in data) {
                        console.log(key);
//                        console.log(data[key].extended_entities.media[key]);
                    }
                    data.forEach(function (value, key) {
//                       console.log(data[key].extended_entities.media[key]);
                    });
                    for (var i = 0; i < data.length; i++) {

                        if (data[i].hasOwnProperty('extended_entities')) {
                            console.log(data[i].extended_entities.media);
                        }

                        if (data[i].hasOwnProperty('extended_entities')) {
                            for (key in data[i].extended_entities.media ) {
                                console.log(data[i].extended_entities.media[key].media_url);
                            }

                        }

                    }
                });
            }
        };

        Twitter.init(
            {
                template: $('#tweets-template').html(),
                container: $('ul.tweets')
            }
        );
    })(jQuery);


</script>