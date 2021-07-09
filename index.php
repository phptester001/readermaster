<?php
if(isset($_GET["db"]))
{

// Host ec2-54-78-36-245.eu-west-1.compute.amazonaws.com
// Database dfbkf2or7shhms
// User qxkbflkrfhoiqk
// Port 5432
// Password 0299ca21f2ff0a7fd55efa557bbdcd9e25e4f84dd94867a67eded102a230b181
// URI postgres://qxkbflkrfhoiqk:0299ca21f2ff0a7fd55efa557bbdcd9e25e4f84dd94867a67eded102a230b181@ec2-54-78-36-245.eu-west-1.compute.amazonaws.com:5432/dfbkf2or7shhms
// Heroku CLI heroku pg:psql postgresql-clean-63358 --app readermaster

	define("DB_HOST", 'ec2-54-78-36-245.eu-west-1.compute.amazonaws.com');
	define("DB_PORT", 5432);
	define("DB_DATABASE", 'dfbkf2or7shhms');
	define("DB_USER", 'qxkbflkrfhoiqk');
	define("DB_PASSWORD", '0299ca21f2ff0a7fd55efa557bbdcd9e25e4f84dd94867a67eded102a230b181');
	
	echo "connecting...." . PHP_EOL;
	
	// Connecting, selecting database
	$dbconn = pg_connect("host=" . DB_HOST . " dbname=" . DB_DATABASE . " user=" . DB_USER . " password=" . DB_PASSWORD)
		or die('Could not connect: ' . pg_last_error());
	
	echo "connected!" . PHP_EOL;
	
	echo $dbconn;
	
	// $query = 'DROP TABLE test';	
	// $result = pg_query($query);// or die('Query failed: ' . pg_last_error());
	
	// $query = 'CREATE TABLE test (key text UNIQUE NOT NULL, value text)';
	// $result = pg_query($query);// or die('Query failed: ' . pg_last_error());
	
	// die("");
	$arr = array(
		"title" 	=> 	"php.remote.database",
		"version" 	=>	1.2,
		"args"		=>  array("--test", "lastUpdate", 13, "init")
	);
	
	$key = "test" . time();
	$value = json_encode($arr);
	
	echo "ekleniyor..." . PHP_EOL;
	
	// Performing SQL query
	$query = "INSERT INTO test (key,value) VALUES($1, $2);";
	$result = pg_query_params($dbconn, $query, array($key, $value)) or die('Query failed: ' . pg_last_error());
	
	echo "eklendi..." . PHP_EOL;
	
	// Free resultset
	// pg_free_result($result);

	// Closing connection
	// pg_close($dbconn);


	// die("");
	// sleep(1);
	
	$query = 'SELECT * FROM test';
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	// Printing results in HTML
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		print_r($line);
		echo "\t<tr>\n";
		foreach ($line as $col_value) {
			echo "\t\t<td>$col_value</td>\n";
		}
		echo "\t</tr>\n";
	}
	echo "</table>\n";

	// Free resultset
	pg_free_result($result);

	// Closing connection
	pg_close($dbconn);
  
  die("");
}
$a = exec("ls -al");
echo $a;

phpinfo();
?>
