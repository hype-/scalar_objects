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

    /**
     * TODO: Should an exception be thrown on an empty array?
     */
    public function min() {
        return min($this);
    }

    /**
     * TODO: Should an exception be thrown on an empty array?
     */
    public function max() {
        return max($this);
    }

    /**
     * TODO: Strict?
     */
    public function contains($value) {
        return in_array($value, $this);
    }

    public function slice($offset, $length = null) {
        return array_slice($this, $offset, $length);
    }

    /**
     * TODO: Strict?
     */
    public function indexOf($value) {
        return array_search($value, $this);
    }

    public function join($glue) {
        return join($glue, $this);
    }

    // Array mutating operations

    public function push($value) {
        array_push($this, $value);

        return $this;
    }

    public function pop() {
        return array_pop($this);
    }
}
