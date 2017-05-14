<?php
function mysql_fix_string($string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return mysql_real_escape_string($string);
}
?>

Example 10-19. How to safely access MySQL with user input
<?php
$user = mysql_fix_string($_POST['user']);
$pass = mysql_fix_string($_POST['pass']);
$query = "SELECT * FROM users WHERE user='$user' AND pass='$pass'";

function mysql_fix_string($string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return mysql_real_escape_string($string);
}
?>

<?php
require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
?>

function mysql_fatal_error($msg)
{
$msg2 = mysql_error();
echo <<< _END
We are sorry, but it was not possible to complete
the requested task. The error message we got was:
<p>$msg: $msg2</p>
Please click the back button on your browser
and try again. If you are still having problems,
please <a href="mailto:admin@server.com">email
our administrator</a>. Thank you.
_END;
}

Example 10-3. Selecting a database
<?php
mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());
?>

Example 10-3. Selecting a database
<?php
mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());
?>

Example 10-5. Fetching results one cell at a time
<?php // query.php
require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());
$query = "SELECT * FROM classics";
$result = mysql_query($query);
if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);
<?php
for ($j = 0 ; $j < $rows ; ++$j)
{
$row = mysql_fetch_row($result);
echo 'Author: ' . $row[0] . '<br>';
echo 'Title: ' . $row[1] . '<br>';
echo 'Category: ' . $row[2] . '<br>';
echo 'Year: ' . $row[3] . '<br>';
echo 'ISBN: ' . $row[4] . '<br><br>';
}

?>

Example 10-7. Closing a MySQL server connection
<?php
mysql_close($db_server);
?>

Example 12-9. The sanitizeString and sanitizeMySQL functions
<?php
function sanitizeString($var)
{
$var = stripslashes($var);
$var = htmlentities($var);
$var = strip_tags($var);
return $var;
}
function sanitizeMySQL($connection, $var)
{ // Using the mysqli extension
$var = $connection->real_escape_string($var);
$var = sanitizeString($var);
return $var;
}
?>

Example generating user and pass combo
$token = hash('ripemd128', 'mypassword');

Example 13-3. Creating a users table and adding two accounts
<?php // setupusers.php
require_once 'login.php';
$connection =
new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) die($connection->connect_error);
$query = "CREATE TABLE users (
forename VARCHAR(32) NOT NULL,
surname VARCHAR(32) NOT NULL,
username VARCHAR(32) NOT NULL UNIQUE,
password VARCHAR(32) NOT NULL
)";
$result = $connection->query($query);
if (!$result) die($connection->error);
$salt1 = "qm&h*";
$salt2 = "pg!@";
$forename = 'Bill';
$surname = 'Smith';
$username = 'bsmith';
$password = 'mysecret';
$token = hash('ripemd128', "$salt1$password$salt2");
add_user($connection, $forename, $surname, $username, $token);
$forename = 'Pauline';
$surname = 'Jones';
$username = 'pjones';
$password = 'acrobat';
$token = hash('ripemd128', "$salt1$password$salt2");
add_user($connection, $forename, $surname, $username, $token);
function add_user($connection, $fn, $sn, $un, $pw)
{
$query = "INSERT INTO users VALUES('$fn', '$sn', '$un', '$pw')";
$result = $connection->query($query);
if (!$result) die($connection->error);
}
?>

Example 13-5. Setting a session after successful authentication
<?php //authenticate2.php
require_once 'login.php';
$connection =
new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) die($connection->connect_error);
if (isset($_SERVER['PHP_AUTH_USER']) &&
isset($_SERVER['PHP_AUTH_PW']))
{
$un_temp = mysql_entities_fix_string($connection, $_SERVER['PHP_AUTH_USER']);
$pw_temp = mysql_entities_fix_string($connection, $_SERVER['PHP_AUTH_PW']);
$query = "SELECT * FROM users WHERE username='$un_temp'";
$result = $connection->query($query);
if (!$result) die($connection->error);
elseif ($result->num_rows)
{
$row = $result->fetch_array(MYSQLI_NUM);
$result->close();
$salt1 = "qm&h*";
$salt2 = "pg!@";
$token = hash('ripemd128', "$salt1$pw_temp$salt2");
if ($token == $row[3])
{
session_start();
$_SESSION['username'] = $un_temp;
$_SESSION['password'] = $pw_temp;
$_SESSION['forename'] = $row[0];
$_SESSION['surname'] = $row[1];
echo "$row[0] $row[1] : Hi $row[0],
you are now logged in as '$row[2]'";
die ("<p><a href=continue.php>Click here to continue</a></p>");
}
else die("Invalid username/password combination");
}
else die("Invalid username/password combination");
}
else
{
header('WWW-Authenticate: Basic realm="Restricted Section"');
header('HTTP/1.0 401 Unauthorized');
die ("Please enter your username and password");
}
$connection->close();
function mysql_entities_fix_string($connection, $string)
{
return htmlentities(mysql_fix_string($connection, $string));
}
function mysql_fix_string($connection, $string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return $connection->real_escape_string($string);
}
?>

Example 13-6. Retrieving session variables
<?php // continue.php
session_start();
if (isset($_SESSION['username']))
{
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$forename = $_SESSION['forename'];
$surname = $_SESSION['surname'];
echo "Welcome back $forename.<br>
Your full name is $forename $surname.<br>
Your username is '$username'
and your password is '$password'.";
}
else echo "Please <a href='authenticate2.php'>click here</a> to log in.";
?>
Example 13-8. Retrieving session variables and then destroying the session
<?php
session_start();
if (isset($_SESSION['username']))
{
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$forename = $_SESSION['forename'];
$surname = $_SESSION['surname'];
destroy_session_and_data();
echo "Welcome back $forename.<br>
Your full name is $forename $surname.<br>
Your username is '$username'
and your password is '$password'.";
}
else echo "Please <a href='authenticate2.php'>click here</a> to log in.";
function destroy_session_and_data()
{
$_SESSION = array();
setcookie(session_name(), '', time() - 2592000, '/');
session_destroy();
}
?>

Timeout:
To do this, use the ini_set function as follows. This example sets the timeout to exactly
one day:
ini_set('session.gc_maxlifetime', 60 * 60 * 24);
If you wish to know what the current timeout period is, you can display it using the
following:
echo ini_get('session.gc_maxlifetime');

<table border="1">
<?php while (mysqli_stmt_fetch($stmt)): ?>
 <tr>
 <?php foreach($r as $field):?>
 <td>
 <?php echo $field; ?>
 </td>
 <?php endforeach; ?>
 </tr>
<?php endwhile; ?>
</table>