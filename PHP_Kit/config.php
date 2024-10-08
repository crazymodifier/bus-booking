<?php

require_once 'vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '1347591572110034',
  'app_secret'     => '73bbcc93792e38ce6624b844b7194f5a',
  'default_graph_version'  => 'v5.7'
]);

?>