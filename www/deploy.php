<?php #!/usr/bin/env /usr/bin/php
  error_reporting(0);
 
  try {
    // Decode the payload json string
    $payload = json_decode($_REQUEST['payload']);
  }
  
  catch(Exception $e) {
      exit(0);
  }
 
  if ($payload->ref === 'refs/heads/master') {
 
    // Log the payload object
    file_put_contents('logs/github.txt', print_r($payload, TRUE), FILE_APPEND);
 
    // Run the build script 
    shell_exec("./bin/build.sh");
}
?>