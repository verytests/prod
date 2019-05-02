<?php

$dirToDump = '/var/www/veryprod/sqlDump/dbDump'.(new DateTime())->format('Y_m_d__H_m_s').'.sql';

exec('mysqldump --user=phpmyadmin --password=root --host=127.0.0.1 verytests > '.$dirToDump);