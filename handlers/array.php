<?php

namespace arr;

class Handler {
    public function length() {
        return count($this);
    }

    public function isEmpty() {
        return empty($this);
    }

    public function map(callable $callback) {
        return array_map($callback, $this);
    }

    public function filter(callable $callback) {
        return array_filter($this, $callback);
    }

    public function reduce(callable $callback, $initial = null) {
        return array_reduce($this, $callback, $initial);
    }

    public function values() {
        return array_values($this);
    }

    public function keys() {
        return array_keys($this);
    }

    public function reverse() {
        return array_reverse($this);
    }

    public function merge(array $other) {
        return array_merge($this, $other);
    }

    public function sum() {
        return array_sum($this);
    }

    public function product() {
        return array_product($this);
    }

    public function min() {
        return min($this);
    }

    public function max() {
        return max($this);
    }
}
