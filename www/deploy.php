<?php #!/usr/bin/env /usr/bin/php
error_reporting(E_ALL);
ini_set('display_errors', '1');
set_time_limit(0);
 
try {
 
  $payload = json_decode($_REQUEST['payload']);
 
}
catch(Exception $e) {
 
    //log the error
    file_put_contents('/Users/mshaver/Sites/deploytest/logs/github.txt', $e . ' ' . $payload, FILE_APPEND);
 
      exit(0);
}
 
if ($payload->ref === 'refs/heads/master') {
 
    $project_directory = '/Users/mshaver/Sites/deploytest/www/';
 
    $output = shell_exec("/Users/mshaver/Sites/deploytest/bin/build.sh");
 
    //log the request
    file_put_contents('/Users/mshaver/Sites/deploytest/logs/github.txt', $output, FILE_APPEND);
 
}
?>