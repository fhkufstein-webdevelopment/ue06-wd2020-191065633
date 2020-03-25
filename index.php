<?php

//@TODO insert your code here

require_once('includes/classes/Database.php');
define('DB_HOST', 'test');
define('DB_NAME', 'testen');
define('DB_USER', 'teter');
define('DB_PASS', 'testen');
$db = new Database();

$cryptedPassword = password_hash('testpassword', PASSWORD_BCRYPT);
$username = "test";
$cryptedPassword = $db->escapeString($cryptedPassword);
$username = $db->escapeString($username);
$sql = "INSERT INTO user(name,`password`) VALUES('" . $username . "','" . $cryptedPassword . "')";
//$db->query($sql);

$sql = "SELECT * FROM user WHERE name='" . $username . "'";
$result = $db->query($sql);

if ($db->numRows($result) > 0) {
    $row = $db->fetchAssoc($result);

    if (password_verify("testpassword", $row['password'])) {
        echo "Der Nutzer " . $username . " mit der ID " . $row['id'] . " hat";
        echo " das Passwort testpassword";
    } else {
        echo "Nutzer gefunden aber falsches Passwort!";
    }
} else {
    echo "Keinen Nutzer gefunden";
}
