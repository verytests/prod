<?php

$prod = '../var/logs/prod.log';
$dev = '../var/logs/dev.log';

unlink($dev);
unlink($prod);