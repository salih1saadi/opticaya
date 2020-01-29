<?php

ob_start();
session_start();
//session_destroy();

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", __DIR__ . DS . "uploads");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");
//DB

//mysql://b94dddc1b68e2c:6dcf8215@us-cdbr-iron-east-04.cleardb.net/heroku_8aa3f5994ede731?reconnect=true

defined("DB_HOST") ? null : define("DB_HOST", "us-cdbr-iron-east-04.cleardb.net");

defined("DB_USER") ? null : define("DB_USER", "b94dddc1b68e2c");

defined("DB_PASS") ? null : define("DB_PASS",  "6dcf8215");

defined("DB_NAME") ? null : define("DB_NAME", "heroku_8aa3f5994ede731");

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require_once("function.php");
require_once("cart.php");







?>