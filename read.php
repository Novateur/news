<?php
	require_once("includes/db.inc");
	require("includes/functions.php");
	
	include_once("includes/header.php");
?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php
					require 'Readability.inc.php';
					
					
					/*function getUrls($url) 
					{
						// Parse URL
						$urlArr = parse_url($url);

						// Determine Base URL, with scheme, host, and port
						$base = $urlArr['scheme']."://".$urlArr['host'];
						if(array_key_exists("port",$urlArr) && $urlArr['port'] != 80) {
							$base .= ":".$urlArr['port'];
						}

						// Truncate the Path using the position of the last forward slash
						$relative = $base.substr($urlArr['path'], 0, strrpos($urlArr['path'],"/")+1);

						// Return our two URLs
						return array($base, $relative);
					}*/
					 

				function sampleDomMedia($html) {
					// Supress validator errors
					libxml_use_internal_errors(true);

					// New document
					$dom = new DOMDocument();
					// Populate document
					$dom->loadHTML($html);

					//[...]
					// Get image elements
					$nodeList = $dom->getElementsByTagName('img');

					// Get length
					$length = $nodeList->length;

					// Initialize array
					$images = array();

					// Iterate over our nodes
					for($i=0;$i<$length;$i++) {
						// Get the current node
						$node = $nodeList->item($i);
						// Retrieve the src attribute
						$image = $node->getAttribute('src');

						// Push image src into $images array
						array_push($images,$image);
					}

					return $images;
				}
				if(isset($_GET['readUrl']) && !empty($_GET['readUrl']))
				{
					$url = $_GET['readUrl'];
				}
				else
				{
					die("We do not understand this link address");
				}

					$html = file_get_contents($url);
					
					$Readability     = new Readability($html,'utf-8'); // default charset is utf-8
					$ReadabilityData = $Readability->getContent();
					
					//$image = $ReadabilityData['lead_image_url'];
					
					$images = sampleDomMedia($html);
					//if(isset($images[1]) && !empty($images[1]))
					//{
						//echo "<img src='{$images[1]}' width='400' height='300'/>";
					//}

					echo "<h1>".$ReadabilityData['title']."</h1>";
					//echo "<h1>".$ReadabilityData['lead_image_url']."</h1>";
					$content = $ReadabilityData['content'];
					preg_match('/(<img[^>]+>)/i', $content, $matches);
					preg_match('@src="([^"]+)"@', $content, $matches1);
					if(isset($matches1[0]))
					{
						$image_link = $matches1[0];
					}
					//$image = $matches[0];
								
					if(isset($matches[0]))
					{
						echo "<p><img {$matches1[0]} width='200' height='200'/></P><br/>";
						$my_content = str_replace($matches[0],"",$content);
					}
					else
					{
						//echo "No image <br/>";
						$my_content = $content;
					}
					echo $my_content;
				?>
			</div>
			<div class="col-md-4">
				<?php
					include_once("includes/sidebar.php");
				?>
			</div>
		</div>
	</div>
	<?php
		include_once("includes/footer.php");
	?>
</body>
</html>