<?php

$database = "sqlite3";
$database_sqlite3_filename = "blurtsql.sqlite3";
//$node = 'https://rpc.blurt.world';
$node = 'https://blurtrpc.actifit.io';
error_reporting(E_ALL);
$body_truncate = true;
$dont_claim_account = true; // This feature is disabled in Blurt and is no longer used

require("database/$database.php");