<?php

require_once '../vendor/autoload.php';

use Application\Controllers\ApplicationController;
echo "Index";
$app = new ApplicationController();
$app->Start();