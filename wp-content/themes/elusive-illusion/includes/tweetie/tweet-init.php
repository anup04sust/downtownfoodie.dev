<?php

/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
if (!defined('ABSPATH'))
  die();
require_once dirname(__FILE__) . '/api/twitteroauth/twitteroauth.php';

class ELI_Tweet_Feeds {

  public $consumer_key;
  public $consumer_secret;
  public $access_token;
  public $access_secret;
  public $user_name;
  public $cache_enabled = false;
  public $cache_lifetime = 3600;
  public $hash_salt = null;

  public function __construct() {
    add_action('wp_enqueue_scripts', array($this, 'scripts'));
    //add_action('wp_ajax_eli_tweets', array($this, 'tweets'));
    //add_action('wp_ajax_nopriv_eli_tweets', array($this, 'tweets'));
    global $eli_options;
    $this->consumer_key = $eli_options['tweet_api_consumer_key'];
    $this->consumer_secret = $eli_options['tweet_api_consumer_secret'];
    $this->access_token = $eli_options['tweet_api_access_token'];
    $this->access_secret = $eli_options['tweet_api_access_secret'];
    $this->user_name = $eli_options['tweet_username'];
    $this->hash_salt = md5(dirname(__FILE__));
  }

  public function scripts() {
    if (is_page_template('tpl-frotpage.php')) {
      //wp_enqueue_script('tweetie', ELUSICVE_THEME_URI . 'includes/tweetie/tweetie.min.js', array(), '1.0.0', true);
      //wp_enqueue_script('tweet-feeds', ELUSICVE_THEME_URI . 'includes/tweetie/tweets.js', array('tweetie'), '1.0.0', true);
      //wp_localize_script('tweet-feeds', 'object_tweet', array('ajaxurl' => admin_url('admin-ajax.php'), 'action' => 'eli_tweets'));
    }
  }

  public function tweets() {
   

    $number = 10;
    $exclude_replies = FALSE;
    $list_slug = NULL;
    $hashtag = NULL;
    if ($this->cache_enabled) {
      // Generate cache key from query data
      $cache_key = md5(
          var_export(array($this->user_name, $number, $exclude_replies, $list_slug, $hashtag), true) . $this->hash_salt
      );

      // Remove old files from cache dir
      $cache_path = dirname(__FILE__) . '/cache/';
      foreach (glob($cache_path . '*') as $file) {
        if (filemtime($file) < time() - $this->cache_lifetime) {
          unlink($file);
        }
      }

      // If cache file exists - return it
      if (file_exists($cache_path . $cache_key)) {
        header('Content-Type: application/json');

        echo file_get_contents($cache_path . $cache_key);
        exit;
      }
    }
// Connect
    $connection = $this->getConnectionWithToken($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_secret);

    // Get Tweets
    if (!empty($list_slug)) {
      $params = array(
        'owner_screen_name' => $this->user_name,
        'slug' => $list_slug,
        'per_page' => $number
      );

      $url = '/lists/statuses';
    }
    else if ($hashtag) {
      $params = array(
        'count' => $number,
        'q' => '#' . $hashtag
      );

      $url = '/search/tweets';
    }
    else {
      $params = array(
        'count' => $number,
        'exclude_replies' => $exclude_replies,
        'screen_name' => $this->user_name
      );
      $url = '/statuses/user_timeline';
    }

    $tweets = $connection->get($url, $params);

    // Return JSON Object
    //header('Content-Type: application/json');

    //$tweets = json_encode($tweets);
    if ($this->cache_enabled)
      file_put_contents($cache_path . $cache_key, $tweets);
    return $tweets;
    
  }

  public function getConnectionWithToken($cons_key, $cons_secret, $oauth_token, $oauth_secret) {
    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_secret);

    return $connection;
  }

}
function get_tweet_feed(){
  $Tweet_Feeds = new ELI_Tweet_Feeds();
  return $Tweet_Feeds->tweets();
}
