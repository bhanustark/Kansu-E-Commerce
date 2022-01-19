<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define('URL', 'http://localhost');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mithu');
define('DB_USER', 'root');
define('DB_PASS', '');

define('AWS_S3_KEY', 'AKIAIEEHMGCTALY5YNJQ');
define('AWS_S3_SECRET', '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');
define('AWS_S3_REGION', 'us-east-1');
define('AWS_S3_BUCKET', 'cdn.kansu.in');
define('AWS_S3_URL', 'http://'.AWS_S3_BUCKET.'s3.amazonaws.com/');
