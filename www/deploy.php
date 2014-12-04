<?php #!/usr/bin/env /usr/bin/php

// Set Variables
$LOCAL_ROOT         = "/Users/mshaver/Sites/deploytest/";
$LOCAL_REPO_NAME    = "deploytest";
$LOCAL_REPO         = "{$LOCAL_ROOT}/{$LOCAL_REPO_NAME}";
$REMOTE_REPO        = "git@github.com:mshaver/deploytest.git";
$BRANCH             = "master";

if ( $_POST['payload'] ) {
  // Only respond to POST requests from Github
  
  if( file_exists($LOCAL_REPO) ) {
    
    // If there is already a repo, just run a git pull to grab the latest changes
    shell_exec("cd {$LOCAL_REPO} && git pull");

    die("done " . mktime());
  } else {
    
    // If the repo does not exist, then clone it into the parent directory
    shell_exec("cd {$LOCAL_ROOT} && git clone {$REMOTE_REPO}");
    
    die("done " . mktime());
  }
}
  

?>