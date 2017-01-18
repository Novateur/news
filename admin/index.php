<?php
// Start counting time for the page load
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];
$feed_empty = "";
$category_empty = "";

// Include SimplePie
// Located in the parent directory
require_once('../includes/db.inc');
require_once('../includes/functions.php');
include_once('../autoloader.php');

// Create a new instance of the SimplePie object
$feed = new SimplePie();

//$feed->force_fsockopen(true);

if (isset($_GET['js']))
{
	SimplePie_Misc::output_javascript();
	die();
}

// Make sure that page is getting passed a URL
if (isset($_GET['feed']) && $_GET['feed'] !== '' && isset($_GET['category']) && $_GET['category'] !== '')
{
	// Strip slashes if magic quotes is enabled (which automatically escapes certain characters)
	if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
	{
		$_GET['feed'] = stripslashes($_GET['feed']);
	}

	// Use the URL that was passed to the page in SimplePie
	$feed->set_feed_url($_GET['feed']);
	$category = sanitize($_GET['category']);
}
else
{
	if(isset($_GET['feed']) && $_GET['feed'] == '')
	{
		$feed_empty = "The feed link must not be empty";
	}
	if(isset($_GET['category']) && $_GET['category'] == '')
	{
		$category_empty = "Kindly select a category";
	}
}

// Allow us to change the input encoding from the URL string if we want to. (optional)
if (!empty($_GET['input']))
{
	$feed->set_input_encoding($_GET['input']);
}

// Allow us to choose to not re-order the items by date. (optional)
if (!empty($_GET['orderbydate']) && $_GET['orderbydate'] == 'false')
{
	$feed->enable_order_by_date(false);
}

// Trigger force-feed
if (!empty($_GET['force']) && $_GET['force'] == 'true')
{
	$feed->force_feed(true);
}

// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and
// all that other good stuff.  The feed's information will not be available to SimplePie before
// this is called.
$success = $feed->init();

// We'll make sure that the right content type and character encoding gets set automatically.
// This function will grab the proper character encoding, as well as set the content type to text/html.
$feed->handle_content_type();

// When we end our PHP block, we want to make sure our DOCTYPE is on the top line to make
// sure that the browser snaps into Standards Mode.
?>
	<?php
		include_once("includes/header_menu.php");
	?>

<div class="container">
		<div class="row">
			<button class="btn btn-warning btn-sm pull-right" onclick="show_sidebar()" id="show_menu" style="display:block;z-index:30000">Show menu</button>
		</div>
		<div class="row">
			<form action="" method="get" name="sp_form" id="sp_form">
				<div id="sp_input">
					<div class="row">
					<div class="col-md-12">
						<h2><a href="#" onclick="window.history.back()" style="color:#000"><i class="fa fa-arrow-left"></i></a> Crawl now</h2>
					</div>
					</div>
					<?php
						if($feed_empty != "" || $category_empty!="")
						{
							echo "<div class='row'>
							<div class='col-md-4 alert alert-danger'>
							
								{$category_empty}
							</div>";							
							echo "<div class='col-md-4 alert alert-danger'>
							
								{$feed_empty}
							</div>";							
							echo "<div class='col-md-4'>
							</div>
							</div>";
						}
					?>
					<div class="row">
					<div class="col-md-4">
					<!--Start of drop down for category-->
						<select class="form-control" onchange="fetch_source(this.value)" name="category">
							<?php
								get_categories();
							?>
						</select>
					</div>
					<!--End of drop down for category-->					
					
					<!--Start of drop down for source link/url-->
					<div class="col-md-4">
						<select name="feed" class="form-control" id="sources">
							<option value="">Choose a source</option>
						</select>
					</div>
					<!--End of drop down for source link/url-->
					
					<!-- If a feed has already been passed through the form, then make sure that the URL remains in the form field. -->
					<!--<input type="text" name="feed" value="<?php //if ($feed->subscribe_url()) echo $feed->subscribe_url(); ?>" class="text" id="feed_input" />-->
					<div class="col-md-4">
						<input type="submit" value="Crawl now" class="btn btn-default" />
					</div>
					</div>


				</div>
			</form>
		

		<div class="row"><br/>
			<div class="col-md-12">
				<?php
				// Check to see if there are more than zero errors (i.e. if there are any errors at all)
				if ($feed->error())
				{
					// If so, start a <div> element with a classname so we can style it.
					echo '<div class="alert alert-danger">' . "\r\n";

						// ... and display it.
						echo '<p>' . htmlspecialchars($feed->error()) . "</p>\r\n";

					// Close the <div> element we opened.
					echo '</div>' . "\r\n";
				}
				?>
			</div>
		</div>	
		<div id="sp_results">

			<!-- As long as the feed has data to work with... -->
			<?php if ($success): ?>
				<div class="chunk focus" align="center">

					<!-- If the feed has a link back to the site that publishes it (which 99% of them do), link the feed's title to it. -->
					<!--<h3 class="header"><?php //if ($feed->get_link()) echo '<a href="' . $feed->get_link() . '">'; echo $feed->get_title(); if ($feed->get_link()) echo '</a>'; ?></h3>-->

					<!-- If the feed has a description, display it. -->
					<?php //echo $feed->get_description().; ?>

				</div>

				<!-- Let's begin looping through each individual news item in the feed. -->
				<?php foreach($feed->get_items() as $item): ?>
					<div class="chunk">
						<!-- If the item has a permalink back to the original post (which 99% of them do), link the item's title to it. -->
						<h4><?php if ($item->get_permalink()) echo "<a href='read.php?readUrl={$item->get_permalink()}'>"; echo $item->get_title(); if ($item->get_permalink()) echo '</a>'; ?>&nbsp;<span class="footnote"><?php echo $item->get_date('j M Y, g:i a'); ?></span></h4>
						<?php
							$created_time = sanitize($item->get_date('j M Y, g:i a'));
							$title = sanitize($item->get_title());
							//$content = sanitize_content($item->get_content());
							$slug = sanitize(str_replace(" ","-",$item->get_title()));
							$ma_date = $item->get_date('Y-m-d');
						?>
						<!-- Display the item's primary content. -->
						<?php 
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
								$content = sanitize_content($my_content);
								if(strlen($my_content) > 500)
								{
									$p = substr($my_content,0,500);
								}
								if(strlen($content) > 500)
								{
									echo "<p>".$p."...</p><hr/>";
								}
								else
								{
									echo "<p>".$my_content."</p><hr/>";
								}
							/*preg_match('/<img[^>]+\>/i', $str , $matches);
							echo $matches[0]." image <br/>";
							
							$text = preg_split('/<img[^>]+\>/i', $str);
							echo $text[1]."text <br/>";*/
							$sql = "INSERT INTO articles (slug,title,content,created_time,link,image_link,ma_date,category) VALUES 
							('{$slug}','{$title}','{$content}','{$created_time}','{$item->get_permalink()}','{$image_link}','{$ma_date}','{$category}')";
							$query = $connection->query($sql);
							if($query)
							{
								//echo "Feeds was fetched and inserted successfully";
							}
						?>

						<?php
						// Check for enclosures.  If an item has any, set the first one to the $enclosure variable.
						if ($enclosure = $item->get_enclosure(1))
						{
							// Use the embed() method to embed the enclosure into the page inline.
							echo '<div align="center">';
							/*echo '<p>' . $enclosure->embed(array(
								'audio' => './for_the_demo/place_audio.png',
								'video' => './for_the_demo/place_video.png',
								'mediaplayer' => './for_the_demo/mediaplayer.swf',
								'altclass' => 'download'
							)) . '</p>';

							if ($enclosure->get_link() && $enclosure->get_type())
							{
								echo '<p class="footnote" align="center">(' . $enclosure->get_type();
								if ($enclosure->get_size())
								{
									echo '; ' . $enclosure->get_size() . ' MB';
								}
								echo ')</p>';
							}*/
							if ($enclosure->get_thumbnail())
							{
								echo '<div><img src="' . $enclosure->get_thumbnail() . '" alt="" /></div>';
							}
							echo '</div>';
						}
						?>

					</div>

				<!-- Stop looping through each item once we've gone through all of them. -->
				<?php endforeach; ?>

			<!-- From here on, we're no longer using data from the feed. -->

			<?php endif; ?>

		</div>

		<div>
			<!-- Display how fast the page was rendered. -->
			<p class="footnote">Page processed in <?php $mtime = explode(' ', microtime()); echo round($mtime[0] + $mtime[1] - $starttime, 3); ?> seconds.</p>

		</div>

	

</div>
	<script src="../js/jquery-2.1.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script>
		function fetch_source(val)
		{
			$.post("handler/get_source_by_cat.php",{category:val},function(response){
				$('#sources').html(response);
			})
		}
		function hide_sidebar()
		{
			$('#sidebar').hide('fast');
			$('#show_menu').show('fast');
			$('#logout').show('fast');
		}		
		function show_sidebar()
		{
			$('#sidebar').show('fast');
			$('#show_menu').hide('fast');
			$('#logout').hide('fast');
		}
	</script>
</body>
</html>
