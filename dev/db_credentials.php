<?php

if ($_SERVER['SERVER_NAME'] == 'recruiting.lastingchangeinc.org'){
    define("DB_SERVER", "db5001436911.hosting-data.io");
    define("DB_USER", "dbu244675");
    define("DB_PASS", "Lastingchange.1968");
    define("DB_NAME", "dbs1211287");
}elseif ($_SERVER['SERVER_NAME'] == 'apps.mylifelineyouth.org'){
    define("DB_SERVER", "db5000839811.hosting-data.io");
    define("DB_USER", "dbu1131488");
    define("DB_PASS", "nta1tD8taBa53PW!");
    define("DB_NAME", "dbs741386");
}else {
    define("DB_SERVER", "localhost");
    define("DB_USER", "aspen");
    define("DB_PASS", "Cameo736!");
    define("DB_NAME", "recruiting");
}


?>