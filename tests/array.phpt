--TEST--
Testing array handler methods
--SKIPIF--
<?php if (!extension_loaded('scalar_objects')) echo 'skip'; ?>
--FILE--
<?php

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/../handlers/array.php';

register_primitive_type_handler('array', 'arr\\Handler');

$array = ['foo', 'b', 'quux'];

echo "Working on array: ";
var_dump($array);

p('length()',  $array->length());
p('isEmpty()', $array->isEmpty());

p('map()',    $array->map(function($value) { return strtoupper($value); }));
p('filter()', $array->filter(function($value) { return $value === 'b'; }));
p('reduce()', $array->reduce(function($result, $value) { return $result . $value; }));

p('values()', $array->values());
p('keys()',   $array->keys());

p('reverse()', $array->reverse());

p('merge(["xoo"])', $array->merge(["xoo"]));

p('contains("foo")', $array->contains("foo"));
p('contains("x")',   $array->contains("x"));

p('slice(0, 2)', $array->slice(0, 2));
p('slice(2)',    $array->slice(2));

p('indexOf("quux")', $array->indexOf("quux"));

p('join(" ")', $array->join(" "));

p('push("xoo")',    $array->push("xoo"));
p('pop()',          $array->pop());
p('unshift("boo")', $array->unshift("boo"));
p('shift()',        $array->shift());

p('diff(["foo", "xoo"])',    $array->diff(["foo", "xoo"]));
p('intersect(["b", "xoo"])', $array->intersect(["b", "xoo"]));

p('sort()',             $array->sort());
p('sort(SORT_NUMERIC)', $array->sort(SORT_NUMERIC));

p(
    'sortBy(function($a, $b) { return strlen($a) < strlen($b) ? 1 : -1; })',
    $array->sortBy(function ($a, $b) {
        return strlen($a) < strlen($b) ? 1 : -1;
    })
);


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
  string(1) "b"
  [2]=>
  string(4) "quux"
}
length(): int(3)
isEmpty(): bool(false)
map(): array(3) {
  [0]=>
  string(3) "FOO"
  [1]=>
  string(1) "B"
  [2]=>
  string(4) "QUUX"
}
filter(): array(1) {
  [1]=>
  string(1) "b"
}
reduce(): string(8) "foobquux"
values(): array(3) {
  [0]=>
  string(3) "foo"
  [1]=>
  string(1) "b"
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
  string(1) "b"
  [2]=>
  string(3) "foo"
}
merge(["xoo"]): array(4) {
  [0]=>
  string(3) "foo"
  [1]=>
  string(1) "b"
  [2]=>
  string(4) "quux"
  [3]=>
  string(3) "xoo"
}
contains("foo"): bool(true)
contains("x"): bool(false)
slice(0, 2): array(2) {
  [0]=>
  string(3) "foo"
  [1]=>
  string(1) "b"
}
slice(2): array(1) {
  [0]=>
  string(4) "quux"
}
indexOf("quux"): int(2)
join(" "): string(10) "foo b quux"
push("xoo"): array(4) {
  [0]=>
  string(3) "foo"
  [1]=>
  string(1) "b"
  [2]=>
  string(4) "quux"
  [3]=>
  string(3) "xoo"
}
pop(): string(3) "xoo"
unshift("boo"): array(4) {
  [0]=>
  string(3) "boo"
  [1]=>
  string(3) "foo"
  [2]=>
  string(1) "b"
  [3]=>
  string(4) "quux"
}
shift(): string(3) "boo"
diff(["foo", "xoo"]): array(2) {
  [1]=>
  string(1) "b"
  [2]=>
  string(4) "quux"
}
intersect(["b", "xoo"]): array(1) {
  [1]=>
  string(1) "b"
}
sort(): array(3) {
  [0]=>
  string(1) "b"
  [1]=>
  string(3) "foo"
  [2]=>
  string(4) "quux"
}
sort(SORT_NUMERIC): array(3) {
  [0]=>
  string(4) "quux"
  [1]=>
  string(1) "b"
  [2]=>
  string(3) "foo"
}
sortBy(function($a, $b) { return strlen($a) < strlen($b) ? 1 : -1; }):
array(3) {
  [0]=>
  string(4) "quux"
  [1]=>
  string(3) "foo"
  [2]=>
  string(1) "b"
}

Reduce with initial value
reduce(): string(9) "zfoobquux"

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
