<?php
function define_env($name, $def) {
  define($name, getenv($name) ? getenv($name) : $def);
}

define_env("DBHOST", "localhost");
define_env("DBPORT", 5432);
define_env("DBUSER", "postgres");
define_env("DBPASS", "mysecretpassword");
define_env("DBNAME", "postgres");

define_env("MQHOST", "localhost");
define_env("MQPORT", 22201);


/* PostgreSQL connectivity demo */
$pdo = new PDO('pgsql:host=' . DBHOST . ';port=' . DBPORT . ';dbname=' . DBNAME, DBUSER, DBPASS);
var_dump($pdo);
$pdo = null;


/* MemcacheQ connectivity demo */
$memcache_obj = memcache_connect(MQHOST, MQPORT);
var_dump($memcache_obj);

/* append a message to queue */
memcache_set($memcache_obj, 'demoqueue1', 'message body here', 0, 0);

/* consume a message from 'demoqueue1' */
$obj = memcache_get($memcache_obj, 'demoqueue1');
echo $obj;

memcache_close($memcache_obj);
?>
