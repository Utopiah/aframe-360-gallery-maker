<?php
$cookie_name = "GalleryMaker";
$filepath = "galleries";
$cookie_value = time();
$filename = $cookie_value . ".js";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

echo '<pre>';
$img = $_FILES['img'];

if(!empty($img))
{
	$img_desc = reArrayFiles($img);
	print_r($img_desc);

	$files = array();
	foreach($img_desc as $val)
	{
		$newname = date('YmdHis',time()).mt_rand().'.jpg';
		move_uploaded_file($val['tmp_name'],'./uploads/'.$newname);
		$files[] = $newname;
	}
	writeMyFile($filepath."/".$filename, json_encode($files));
}

function reArrayFiles($file)
{
	$file_ary = array();
	$file_count = count($file['name']);
	$file_key = array_keys($file);

	for($i=0;$i<$file_count;$i++)
	{
		foreach($file_key as $val)
		{
			$file_ary[$i][$val] = $file[$val][$i];
		}
	}
	return $file_ary;
}

if(!isset($_COOKIE[$cookie_name])) {
	echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
	echo "Cookie '" . $cookie_name . "' is set!<br>";
	echo "Value is: " . $_COOKIE[$cookie_name];
	setcookie($cookie_name, $_COOKIE[$cookie_name].",".$cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}

function writeMyFile($myfile, $data)
{
	$myfile = fopen($myfile, "w") or die("Unable to open file!");
	fwrite($myfile, $data);
	fclose($myfile);
}
shell_exec("/home/web/benetou.fr/fabien/pub/360/GalleryMaker/tooling/thumbnailer360");

print("<script>window.location = './viewer/?data=$cookie_value';</script>");
