--TEST--
MongoDB\BSON\toExtendedJSON(): BSON decoding exceptions
--FILE--
<?php
include 'utils.inc';

/* We can't really test for bson_iter_init() failure within bson_as_json(),
 * since bson_reader_read() already checks that the buffer is at least 5 bytes.
 */
$invalidBson = array(
    '',
    str_repeat(MongoDB\BSON\fromJSON('{"x": "y"}'), 2),
);

foreach ($invalidBson as $bson) {
    echo throws(function() use ($bson) {
        MongoDB\BSON\toExtendedJSON($bson);
    }, 'MongoDB\Driver\Exception\UnexpectedValueException'), "\n";
}

?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
OK: Got MongoDB\Driver\Exception\UnexpectedValueException
Could not read document from BSON reader
OK: Got MongoDB\Driver\Exception\UnexpectedValueException
Reading document did not exhaust input buffer
===DONE===
