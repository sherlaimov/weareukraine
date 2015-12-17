<h2>These are my tweets</h2>
<!--<ul class="tweets">-->
<!--    <script id="tweets-template" type="text/x-handlebars-template">-->
<!--        {{#each this}}-->
<!--        <li>-->
<!--            <img src="{{thumb}}" alt="{{author}}">-->
<!--            <span>Created at {{date}}</span>-->
<!---->
<!--            <div><i class="fa fa-user-secret"></i>{{userScreenName}}</div>-->
<!--            <div>{{userLocation}}</div>-->
<!--            <p><a href="{{url}}" target="_blank">{{text}}</a></p>-->
<!--            <img src="{{image}}" alt="{{author}}">-->
<!--        </li>-->
<!--        {{/each}}-->
<!--    </script>-->
<!--</ul>-->
<div class="tweets">
    <script id="tweets-template" type="text/x-handlebars-template">
        {{#each this}}
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" src="{{thumb}}" alt="{{author}}">
                </a>
            </div>
            <div class="media-body">
                <div>{{author}}</div>
            <span class="glyphicon glyphicon-time">
               <a href="{{url}}" target="_blank"> <span class="date sub-text">{{date}}</a></span>
            </span>
                <div>{{userLocation}}</div>
                <p>{{text}}</p>
                {{#if image}}
                <img src="{{image}}" alt="{{author}}">
                {{/if}}

            </div>
        </div>
        {{/each}}
    </script>
</div>

<script>

    (function () {

        var Twitter = {
            init: function (config) {

                this.url = 'http://weareukraine/tweets/gettweets/?count=10&screen_name=weareukraine&callback=?';
                this.template = config.template;
//                console.log(this.template);
//                return true;
                this.container = config.container;
                this.fetch();
            },
            attachTemplate: function () {
                var template = Handlebars.compile(this.template);
                this.container.append(template(this.tweets));
            },

            fetch: function () {
                var self = this;
                console.log(this);
//                debugger;
                $.getJSON(this.url, function (data) {
                    console.log('I AM HERE');
                    console.log(data);
                    self.tweets = $.map(data, function (tweet, i) {
//                        (tweet.hasOwnProperty('extended_entities')) ?
//                            console.log(tweet.extended_entities.media[0].media_url)
//                            : console.log(null);
//                        console.log(index);
                        return {
                            author: function () {
                                if (tweet.hasOwnProperty('retweeted_status')) {
                                    return tweet.retweeted_status.user.name;
                                }
                                return tweet.user.name;
                            },
                            thumb: function () {
                                if (tweet.hasOwnProperty('retweeted_status')) {
                                    return tweet.retweeted_status.user.profile_image_url;
                                }
                                return tweet.user.profile_image_url;
                            },
                            date: function () {
                                if (tweet.hasOwnProperty('retweeted_status')) {
                                    return tweet.retweeted_status.created_at;
                                }
                                return tweet.created_at;
                            },
                            text: function() {
                                if (tweet.hasOwnProperty('retweeted_status')) {
                                    return tweet.retweeted_status.text;
                                }
                              return tweet.text;
                            },
                            retweetCount: tweet.retweet_count,
                            url: 'https://twitter.com/' + tweet.user.screen_name + '/status/' + tweet.id_str,
                            userLocation: function () {
                                if (tweet.hasOwnProperty('retweeted_status')) {
                                    return tweet.retweeted_status.user.location;
                                }
                                return tweet.user.location;
                            },
                            image: function () {
                                if (tweet.hasOwnProperty('extended_entities')) {
                                    return tweet.extended_entities.media[0].media_url;
                                }
                            }
                        };

                    });
                    self.attachTemplate();
//                    console.log(data[0].extended_entities.media[0].media_url);
                    data.forEach(function (value, key) {
//                       console.log(data[key].extended_entities.media[key]);
                    });
                    for (var i = 0; i < data.length; i++) {

                        if (data[i].hasOwnProperty('extended_entities')) {
//                            console.log(data[i].extended_entities.media);
                        }

                    }
                });
            }
        };

        Twitter.init(
            {
                template: $('#tweets-template').html(),
                container: $('div.tweets')
            }
        );
    })(jQuery);


</script>