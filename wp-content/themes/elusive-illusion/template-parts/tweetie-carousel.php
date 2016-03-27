<?php
/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
$tweet_feeds = get_tweet_feed();
global $eli_options;
?>
<section id="tweetie-feeds">
  <div class="<?php theme_layout_style(); ?>">
    <div class="row tweetie">
      <div class="col-xs-12 col-sm-4">
        <a href="https://twitter.com/<?php echo $eli_options['tweet_username']; ?>" class="tweetie-for" target="_BLANK"><?php echo $eli_options['tweet_feed_title']; ?></a>
      </div>
      <div class="col-xs-12 col-sm-8">
        <div class="tweetie-feeds">
          <div class="tweetie-carousel owl-carousel owl-theme">
            <?php
            if (!empty($tweet_feeds)): foreach ($tweet_feeds as $key => $tfeed) {
                $time = human_time_diff(get_the_time('U'), strtotime($tfeed->created_at)) . ' ago';              
                echo sprintf(' <div class="twites owl-item">%1$s <span class="date">%2$s</span></div>', $tfeed->text, $time);
              }
            endif;
            ?>
          </div>
        </div>
      </div>
    </div>
    <script>
      jQuery(document).ready(function () {
        function tweet_linking(tweet) {
            var replacetweet = tweet.replace(/(https?:\/\/([-\w\.]+)+(:\d+)?(\/([\w\/_\.]*(\?\S+)?)?)?)/ig,'<a href="$1" target="_blank" title="Visit this link">$1</a>');
             replacetweet = replacetweet.replace(/#([a-zA-Z0-9_]+)/g,'<a href="https://twitter.com/search?q=%23$1&amp;src=hash" target="_blank" title="Search for #$1">#$1</a>');
              replacetweet = replacetweet.replace(/@([a-zA-Z0-9_]+)/g,'<a href="https://twitter.com/$1" target="_blank" title="$1 on Twitter">@$1</a>');

            return replacetweet;
        };
        jQuery('.twites', '#tweetie-feeds').each(function () {
          var twites = jQuery(this).html();
          twites = tweet_linking(twites)
          jQuery(this).html(twites);
          //console.log(twites);
        });
      });
    </script>
</section>