<?php #!/usr/bin/env /usr/bin/php
/**
 * Github WebHook processor
 * POST to: postreceive.php?key=REPLACE_ME_WITH_A_UNIQUE_KEY
 *
 * @author Luis Abreu
 * @version 0.1
 * @copyright Quodis, 24 February, 2011
 * @package default
 **/

/**
 * path to projects in server
 **/
define('PROJECTS_PATH', '/Users/mshaver/Sites/');
/**
 * server key for authentication
 **/
define('SERVER_KEY', 'a6h242t4M8gf');

$headers = getallheaders();
$hubSignature = $headers['X-Hub-Signature'];
 
list($algo, $hash) = explode('=', $hubSignature, 2);
 
$payload = file_get_contents('php://input');
$data    = json_decode($payload);
 
$payloadHash = hash_hmac($algo, $payload, SERVER_KEY);
 
if ($hash !== $payloadHash) {
    die('Bad secret');
}

// parse the json payload
$payload = json_decode($_REQUEST['payload']);

if (!$payload) exit();

// check for payload and server key
if ( $payload->ref === 'refs/heads/master' && $_REQUEST['key'] == SERVER_KEY ) {
        // parse the payload for the project name
        $project_name = strtolower($payload->{'repository'}->{'name'});
        // define the cd directory based on config and project name
        $project_directory = PROJECTS_PATH . $project_name;

        // cd into the project dir, git reset and pull changes
        shell_exec( 'cd ' . $project_directory . '/ && git reset --hard HEAD && git pull' );
}

?>