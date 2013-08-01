<?

register_nav_menu( 'primary', __( 'Primary Menu', 'idlerocks' ) ); 

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);


add_shortcode('column', 'addColumn');

function addColumn( $atts, $content = null ) {
	extract(shortcode_atts(array(
	"type" => 'full-width'
	), $atts));
	$html  = '<div class="'.$type.'">'.do_shortcode($content).'</div>';
	if(strpos($type,"last")>0){
		$html.="<div class=clear></div>";
	}

	return $html;
}

function is_child($pageID) {
	global $post;
	if( is_page() && ($post->post_parent==$pageID) ) {
		return true;
	} else {
		return false;
	}
}

function getParentID($postID) {
	$post = get_post($postID);
	if($post->post_parent>0){
		return $post->post_parent;
	}
	else {
		return false;
	}
}

function getParentTitle($postID){
	$post = get_post($postID);
	if($post->post_parent>0){
		return get_the_title($post->post_parent);
	}
	else {
		return $post->post_title;;
	}
}

function getImage($size,$post){
	$startArray = wp_get_attachment_image_src( get_field("image",$post->ID), $size );
	switch ($size) {
		case "thumbnail":
			$biggerArray = wp_get_attachment_image_src( get_field("image",$post->ID), "medium" );
			break;
		case "medium":
			$biggerArray = wp_get_attachment_image_src( get_field("image",$post->ID), "large" );
			break;
		case "large":
			$biggerArray = wp_get_attachment_image_src( get_field("image",$post->ID), "full" );
			break;
		default:
			$biggerArray = wp_get_attachment_image_src( get_field("image",$post->ID), "full" );
			break;
	}

	return '<img width="'.$startArray[1].'" height="'.$startArray[2].'" src="'.$startArray[0].'" data-retina="'.$biggerArray[0].'" alt="'.$post->post_title.'" >';
}

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'room-thumb', 415, 267 );
	add_image_size( 'room-large', 830, 534 );
}

function searchAccommodation($from,$to){
	$results = simplexml_load_file("http://www.thebookingbutton.co.uk/api/v1/properties/idlerocksdirect/rates?start_date=".$from."&end_date=".$to);
	foreach ($results->property->{'room-types'}->{'room-type'} as $value) {
		$roomDetails[(int)$value->id]['name'] = (string)$value->name;
		$roomDetails[(int)$value->id]['available'] = 100;
		$roomDetails[(int)$value->id]['total'] = 0;
		foreach ($value->{'room-type-dates'}->{'room-type-date'} as $roomType) {
			if((string)$roomType->{'stop-sell'}=="false" && (int)($roomType->available)>0){
				$roomDetails[(int)$value->id]['total'] = $roomDetails[(int)$value->id]['total'] + (int)$roomType->rate;
				if((int)($roomType->available)< $roomDetails[(int)$value->id]['available']){
					$roomDetails[(int)$value->id]['available'] =(string) $roomType->available;
				}
			} else {

				unset($roomDetails[(int)$value->id]);
				break;
			}



		}
		if(isset($roomDetails[(int)$value->id])){
		$roomDetails[(int)$value->id]['total'] = $roomDetails[(int)$value->id]['total'] - (int)$roomType->rate;
		}
	}
	return $roomDetails;
}

function getTideTimes($url="http://www.tidetimes.org.uk/falmouth-tide-times.rss"){
	$content = @file_get_contents($url);
	$returnObj = new stdClass();
	if($content){
		$xml = simplexml_load_string($content);
		$timeData =explode("<br/>",$xml->channel->item->description);
		array_pop($timeData);
		array_shift($timeData);
		array_shift($timeData);
		array_shift($timeData);
		return $timeData;
	}

}

function getEvents($limit=3){
	global $wpdb;
	$querystr = "
			SELECT wposts.*
			FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
			WHERE wposts.ID = wpostmeta.post_id
			AND wpostmeta.meta_key = 'event_date'
			AND wpostmeta.meta_value >= '".date("Ymd")."'
			AND wposts.post_status = 'publish'
			AND wposts.post_type = 'event'
			ORDER BY wpostmeta.meta_value ASC
			LIMIT 0,$limit
			";

	$pageposts = $wpdb->get_results($querystr, OBJECT);

	return $pageposts;

}



function getPastEvents($page,$limit=10){
	global $wpdb;
	$offset = 10 * $page;
	$querystr = "
			SELECT wposts.*
			FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
			WHERE wposts.ID = wpostmeta.post_id
			AND wpostmeta.meta_key = 'event_date'
			AND wpostmeta.meta_value < '".date("Ymd")."'
			AND wposts.post_status = 'publish'
			AND wposts.post_type = 'event'
			ORDER BY wpostmeta.meta_value ASC
			LIMIT $offset,$limit
			";

	$pageposts = $wpdb->get_results($querystr, OBJECT);

	return $pageposts;

}


function getNews($limit=3){
	global $wpdb;
	$querystr = "
			SELECT wposts.*
			FROM $wpdb->posts wposts
			WHERE wposts.post_status = 'publish'
			AND wposts.post_type = 'post'
			ORDER BY post_date desc limit 0,".$limit;

	$pageposts = $wpdb->get_results($querystr, OBJECT);

	return $pageposts;

}

/**
 * Mobile Detect
 *
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @version    SVN: $Id: Mobile_Detect.php 3 2009-05-21 13:06:28Z vic.stanciu $
 * @version    SVN: $Id: Mobile_Detect.php 3 2011-04-19 18:44:28Z sjevsejev $
 */

class Mobile_Detect {

    protected $accept;
    protected $userAgent;

    protected $isMobile     = false;
    protected $isAndroid    = null;
    protected $isBlackberry = null;
    protected $isIphone     = null;
    protected $isIpad       = null;
    protected $isOpera      = null;
    protected $isPalm       = null;
    protected $isWindows    = null;
    protected $isGeneric    = null;

    protected $devices = array(
        "android"       => "android",
        "blackberry"    => "blackberry",
        "iphone"        => "(iphone|ipod)",
        "ipad"          => "ipad",
        "opera"         => "opera mini",
        "palm"          => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
        "windows"       => "windows ce; (iemobile|ppc|smartphone)",
        "generic"       => "(kindle|mobile|mmp|midp|o2|pda|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap)"
    );

    public function __construct() {
        $this->userAgent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $this->accept    = isset( $_SERVER['HTTP_ACCEPT'] ) ? $_SERVER['HTTP_ACCEPT'] : '';

        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])|| isset($_SERVER['HTTP_PROFILE'])) {
            $this->isMobile = true;
        } elseif (strpos($this->accept,'text/vnd.wap.wml') > 0 || strpos($this->accept,'application/vnd.wap.xhtml+xml') > 0) {
            $this->isMobile = true;
        } else {
            foreach ($this->devices as $device => $regexp) {
                if ($this->isDevice($device)) {
                    $this->isMobile = true;
                }
            }
        }
    }


    /**
     * Overloads isAndroid() | isBlackberry() | isOpera() | isPalm() | isWindows() | isGeneric() through isDevice()
     *
     * @param string $name
     * @param array $arguments
     * @return bool
     */
    public function __call($name, $arguments) {
        $device = strtolower(substr($name, 2));
        if ($name == "is" . ucfirst($device)) {
            return $this->isDevice($device);
        } else {
            trigger_error("Method $name not defined", E_USER_ERROR);
        }
    }


    /**
     * Returns true if any type of mobile device detected, including special ones
     * @return bool
     */
    public function isMobile() {
        return $this->isMobile;
    }

    protected function isDevice($device) {
        $var    = "is" . ucfirst($device);
        $return = $this->$var === null ? (bool) preg_match("/" . $this->devices[$device] . "/i", $this->userAgent) : $this->$var;

        if ($device != 'generic' && $return == true) {
            $this->isGeneric = false;
        }

        return $return;
    }
}