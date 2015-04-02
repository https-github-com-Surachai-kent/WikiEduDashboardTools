<?php

$language = empty($_GET["lang"])? "en" : $_GET["lang"];

$settings = parse_ini_file("/data/project/wikiedudashboard/replica.my.cnf", true);

$hostname = $language . "wiki.labsdb";
$username = $settings['client']['user'];
$password = $settings['client']['password'];
$db_name = $language . "wiki_p";

$con=mysql_connect($hostname,$username,$password);
mysql_select_db($db_name,$con) or die ("Cannot connect to database");
mysql_query("SET NAMES 'utf8'", $con);

// // Confirmed working, should test with other endpoints
// $con=new mysqli($hostname,$username,$password,$db_name);
// if ($con->connect_errno) { echo "Cannot connect the Database"; }
// $con->query("SET NAMES 'utf8'", $con);
// $sqlcode = $con->query($query);
// $jsonObj= array();
// while($result=$sqlcode->fetch_assoc())
// {
//   $jsonObj[] = $result;
// }

if(isset($_GET["start"])) {
  $start = $_GET["start"];
}
if(isset($_GET["end"])) {
  $end = $_GET["end"];
}

if(isset($_GET["user_ids"])) {
  $user_ids = $_GET["user_ids"];
  $sql_user_ids = implode(',', $user_ids);
}

if(isset($_GET["article_titles"])) {
  $article_titles = $_GET["article_titles"];
  array_walk($article_titles, 'clean_title');
  $sql_article_titles = implode(',', $article_titles);
}

?>
