<?php
// Start counting time for the page load
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];
$feed_empty = "";
$category_empty = "";

// Include SimplePie
// Located in the parent directory
require_once('../../includes/db.inc');
require_once('../../includes/functions.php');
include_once('../../autoloader.php');

// Create a new instance of the SimplePie object
$feed = new SimplePie();

//$feed->force_fsockopen(true);

if (isset($_GET['js']))
{
	SimplePie_Misc::output_javascript();
	die();
}

$sql = "SELECT * FROM source";
$query = $connection->query($sql);
if($query->rowCount() > 0)
{
	$query->setFetchMode(PDO::FETCH_ASSOC);
	foreach($query as $r)
	{
		echo $r['url']."<br/>";
		$feed->set_feed_url($r['url']);


		$feed->force_feed(true);
		


		$success = $feed->init();


		$feed->handle_content_type();


						if ($success): 
							 foreach($feed->get_items() as $item):
									$created_time = sanitize($item->get_date('j M Y, g:i a'));
									$link = $item->get_permalink();
									$title = sanitize($item->get_title());
									//$content = sanitize_content($item->get_content());
									$slug = sanitize(str_replace(" ","-",$item->get_title()));
									$ma_date = $item->get_date('Y-m-d h:i');
								
									$str = $item->get_content(); 
								
									preg_match('/(<img[^>]+>)/i', $str, $matches);
									preg_match('@src="([^"]+)"@', $str, $matches1);
									if(isset($matches1[0]))
									{
										$image_link = $matches1[0];
									}
									//$image = $matches[0];
										
									if(isset($matches[0]))
									{
										echo "<p><img {$matches1[0]} width='100' height='100'/></P><br/>";
										$my_content = str_replace($matches[0],"",$str);
									}
									else
									{
										echo "No image <br/>";
										$my_content = $str;
									}
									echo $content = sanitize_content($my_content);

									/*$sql = "INSERT INTO articles (slug,title,content,created_time,link,image_link,ma_date) VALUES 
									('{$slug}','{$title}','{$content}','{$created_time}','{$item->get_permalink()}','{$image_link}','{$ma_date}')";
									$query = $connection->query($sql);
									if($query)
									{
										//echo "Feeds was fetched and inserted successfully";
									}*/

					
							endforeach;
					endif;

	}
}


