<form action="index.php" method="get">
<input type="text" name="url"/><input type="submit"/>
</form>
<hr>
<?php

set_time_limit(0);

function check($param){

if (!isset($_GET[$param])) {


	echo "Missing '$param' parameter<br>";

	exit;
}

}


#check("name");
check("url");

$url = $_GET["url"];

#$name = $_GET["name"];

$html = file_get_contents($url);

#file_put_contents("./html", $html);

preg_match_all('/part \d+/i', $html, $matches);

$total = explode(" ", $matches[0][count($matches[0])-1])[1];

#echo "Total parts $total\n";


preg_match('/"(http:\/\/videozoo.*?)"/i', $html, $matches);


$url1 = $matches[1];

echo "<textarea style='width:500px; height:200px;'>";

#exec("mkdir $name");
$links = array();
for ($i = 1; $i <= $total; $i++){
	
	$url = str_replace("part1", "part".$i, $url1);	

	$html2 = file_get_contents($url);

	preg_match_all('/url: \'([^\']+)\'/', $html2, $matches);

	$link = $matches[1][count($matches[1])-1];
	$links[] = $link;
	echo $link."\n";
	
#	exec("cd $name; wget $link -O $name-$i.mp4");

}

echo "</textarea>";

$links = implode("\n", $links);

file_put_contents("./links.txt", $links);

?>
</pre>
