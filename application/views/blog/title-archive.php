<!DOCTYPE html>
<html lang="vi">
<head>
	
    <title>
    	<?php 
	    	foreach($loop_post as $key => $row){ 
				$string = $row->cat_title;
				$newArray = (explode(',', $string));
				} 
				$result = array_unique($newArray);
					foreach($result as $value){ 
					echo $value;
					}
		?>
    </title>