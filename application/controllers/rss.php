<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__)."/../libraries/feedwriter/FeedTypes.php");
require_once(dirname(__FILE__)."/../libraries/feedwriter/FeedWriter.php");

class Rss extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function entity($term) {
        // Open the Open Duka API
        $api_key = "";
        $api_url = "http://www.openduka.org/index.php/api/search?key={$api_key}&term={$term}";

        $response = file_get_contents($api_url);
        $response_objects = json_decode($response);

        // Feed object initiation
        $feed_object = new RSS2FeedWriter();

        $feed_object->setTitle('Open Duka RSS Feed');
        $feed_object->setLink('http://www.openduka.org');
        $feed_object->setDescription('List of Entities from Open Duka');
        //Use core setChannelElement() function for other optional channels
        $feed_object->setChannelElement('language', 'en-us');
        $feed_object->setChannelElement('pubDate', date(DATE_RSS, time()));

        foreach($response_objects as $response_object) {
            $new_item = $feed_object->createNewItem();

            $new_item->setTitle($response_object->Name);
            $new_item->setLink('http://www.openduka.org/index.php/homes/tree/'.$response_object->ID);
            //The parameter is a timestamp for setDate() function
            $new_item->setDate(time());
            $new_item->setDescription($response_object->Name);

            $feed_object->addItem($new_item);
        };

        $feed_object->generateFeed();
    }

}
