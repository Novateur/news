<?php


$news = simplexml_load_file('http://news.google.com/news?pz=1&cf=all&ned=en_ng&hl=en&output=rss');
//$news = simplexml_load_file('http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml');
//$news = simplexml_load_file('https://news.google.com/news/section?output=rss&q=nigeria');
//$news = simplexml_load_file('https://news.google.com/news/feeds?geo=usa&output=rss');
//$news = simplexml_load_file('http://news.google.com/news?ned=us&geo=Nigeria&output=rss');

$feeds = array();

$i = 0;

foreach ($news->channel->item as $item) 
{
    preg_match('@src="([^"]+)"@', $item->description, $match);
    $parts = explode('<font size="-1">', $item->description);
	
	//Spliting out the fetched xml response
    $feeds[$i]['title'] = (string) $item->title;
    $feeds[$i]['link'] = (string) $item->link;
    $feeds[$i]['date'] = (string) $item->pubDate;
    //$feeds[$i]['guid'] = (string) $item->guid;
	if(isset($match[1])){
    $feeds[$i]['image'] = $match[1];
	}
    $feeds[$i]['site_title'] = strip_tags($parts[1]);
    $feeds[$i]['story'] = strip_tags($parts[2]);
	
	// Arrange the fetched contents
	echo "<h4>".$feeds[$i]['title']."</h4>";
	echo "Gotten from: <b>".$feeds[$i]['site_title']."</b><br/>";
	
	if(!isset($match[1]))
	{
		//Display a default image,if the news feed has no image
		echo "No Image";
	}
	else
	{
		//Display news feed image
		echo "<img src='".$feeds[$i]['image']."' height='80' width='80'/><br/>";
	}
	echo "<p>".$feeds[$i]['story']."</p>";
	echo "Published on: ".$feeds[$i]['date']."<br/>";
	echo "<a href='".$feeds[$i]['link']."'>Read More</a><hr/>";

    $i++;
}

//echo '<pre>';
//print_r($feeds);
//echo '</pre>';

?>