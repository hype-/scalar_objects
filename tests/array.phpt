--TEST--
Testing array handler methods
--SKIPIF--
<?php if (!extension_loaded('scalar_objects')) echo 'skip'; ?>
--FILE--
<?php

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/../handlers/array.php';

register_primitive_type_handler('array', 'arr\\Handler');

$array = ['foo', 'bar', 'quux'];

echo "Working on array: ";
var_dump($array);

p('length()',  $array->length());
p('isEmpty()', $array->isEmpty());

p('map()',    $array->map(function($value) { return strtoupper($value); }));
p('filter()', $array->filter(function($value) { return $value === 'bar'; }));
p('reduce()', $array->reduce(function($result, $value) { return $result . $value; }));

p('values()', $array->values());
p('keys()',   $array->keys());

p('reverse()', $array->reverse());

p('merge()', $array->merge(['xoo']));

echo "\nReduce with initial value\n";

p('reduce()', $array->reduce(function($result, $value) { return $result . $value; }, 'z'));

$array = [];

echo "\nWorking on empty array\n";

p('isEmpty()', $array->isEmpty());

$array = [1, 2, 4];

echo "\nWorking on array: ";
var_dump($array);

p('sum()',     $array->sum());
p('product()', $array->product());
p('min()',     $array->min());
p('max()',     $array->max());

?>
--EXPECTF--
Working on array: array(3) {
  [0]=>
  string(3) "foo"
  [1]=>
  string(3) "bar"
  [2]=>
  string(4) "quux"
}
length(): int(3)
isEmpty(): bool(false)
map(): array(3) {
  [0]=>
  string(3) "FOO"
  [1]=>
  string(3) "BAR"
  [2]=>
  string(4) "QUUX"
}
filter(): array(1) {
  [1]=>
  string(3) "bar"
}
reduce(): string(10) "foobarquux"
values(): array(3) {
  [0]=>
  string(3) "foo"
  [1]=>
  string(3) "bar"
  [2]=>
  string(4) "quux"
}
keys(): array(3) {
  [0]=>
  int(0)
  [1]=>
  int(1)
  [2]=>
  int(2)
}
reverse(): array(3) {
  [0]=>
  string(4) "quux"
  [1]=>
  string(3) "bar"
  [2]=>
  string(3) "foo"
}
merge(): array(4) {
  [0]=>
  string(3) "foo"
  [1]=>
  string(3) "bar"
  [2]=>
  string(4) "quux"
  [3]=>
  string(3) "xoo"
}

Reduce with initial value
reduce(): string(11) "zfoobarquux"

Working on empty array
isEmpty(): bool(true)

Working on array: array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  int(4)
}
sum(): int(7)
product(): int(8)
min(): int(1)
max(): int(4)
