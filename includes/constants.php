<?php
// Check and define constants only if they are not already defined
if (!defined('DBTYPE')) {
    define('DBTYPE', 'mysql');
}
if (!defined('HOSTNAME')) {
    define('HOSTNAME', '127.0.0.1');
}
if (!defined('DBPORT')) {
    define('DBPORT', '3307');
}
if (!defined('HOSTUSER')) {
    define('HOSTUSER', 'root');
}
if (!defined('HOSTPASS')) {
    define('HOSTPASS', 'evoke@123');
}
if (!defined('DBNAME')) {
    define('DBNAME', 'ics_e');
}
