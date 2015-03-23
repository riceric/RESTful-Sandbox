<?php
if(!empty($_GET['location']))
{
    $maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($_GET['location']);
    $maps_json = file_get_contents($maps_url);

    $maps_array = json_decode($maps_json, true);
    $lat = $maps_array['results'][0]['geometry']['location']['lat'];
    $lng = $maps_array['results'][0]['geometry']['location']['lng'];

    $instg_url = 'https://api.instagram.com/v1/media/search?lat='.$lat.'&lng='.$lng.'&client_id=19e30f768da046b18a94fe911a287471';
    $instg_json = file_get_contents($instg_url);
    $instg_array = json_decode($instg_json, true);

}




?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Geogram PHP</title>
</head>
<body>
<form action="">
    <input type="text" name="location">
    <button type="submit">Submit</button>
    <br />
    <?php
    	if (!empty($instg_array))
    	{
	    	foreach($instg_array['data'] as $image) {
	    			echo '<img src="'.$image['images']['low_resolution']['url'].'" alt="" />';
	    	}
	    }
    ?>
</form>
</body>
</html>