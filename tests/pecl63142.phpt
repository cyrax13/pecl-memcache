--TEST--
PECL bug #63142 (memcache 3.0.7 segfaults with object (un)serialization)
--SKIPIF--
<?php
if (PHP_VERSION_ID >= 80500)
    die('skip php prior to 8 only');
include 'connect.inc';
?>
--INI--
;fix me later
report_memleaks=0
--FILE--
<?php

include 'connect.inc';

$obj = new StdClass;
$obj->obj = $obj;
$memcache = new Memcache;
$memcache->connect('127.0.0.1', 11211);
$memcache->set('x', $obj, false, 300);
$x = $memcache->get('x'); echo ".";
$x = $memcache->get('x'); echo ".";
$x = $memcache->get('x'); echo ".";
$x = $memcache->get('x'); echo ".";
$x = $memcache->get('x'); echo ".";
$x = $memcache->get('x'); echo ".";
$x = $memcache->get('x'); echo ".";
$x = $memcache->get('x'); echo ".";
$x = $memcache->get('x'); echo ".\n";

echo "Done\n";

?>
--EXPECTF--
.........
Done
