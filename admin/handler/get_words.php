<?php
	
	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$sql = "SELECT content FROM articles";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			$words = explode(" ",$r['content']);
			foreach($words as $word)
			{
				if(strlen($word) > 2)
				{
					$my_word = strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $word));
					echo $my_word."<br/>";
				}
			}
		}
	}

?>