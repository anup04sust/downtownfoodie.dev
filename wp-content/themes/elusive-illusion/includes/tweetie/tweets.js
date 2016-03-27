/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
"use strict";
var nc = jQuery.noConflict();
nc(document).ready(function(){
        nc('.tweetie-carousel .tweet').twittie({
            apiPath : object_tweet.ajaxurl,
            username: object_tweet.username,           
            action: object_tweet.action,           
            dateFormat: '%b. %d, %Y',
            template: '{{tweet}} <span class="date">{{date}}</span>',
            count: 10,
        }, function () {
            setInterval(function() {
                var item = nc('.tweetie-carousel .tweet ul').find('li:first');
                item.animate( {marginLeft: '-220px', 'opacity': '0'}, 500, function() {
                    nc(this).detach().appendTo('.tweetie-carousel .tweet ul').removeAttr('style');
                });
            }, 5000);
        });
});