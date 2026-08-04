<?php

namespace Illuminate\Support\Facades;

class DB
{
    public static function table($table)
    {
        return new class {
            public function select(...$columns)
            {
                return $this;
            }

            public function selectRaw($expression)
            {
                return $this;
            }

            public function where($column, $operator = null, $value = null)
            {
                return $this;
            }

            public function leftJoin($table, $first, $operator = null, $second = null)
            {
                return $this;
            }

            public function get()
            {
                return new class {
                    public function isEmpty()
                    {
                        return true;
                    }

                    public function reduce($callback, $initial = null)
                    {
                        return $initial;
                    }

                    public function count()
                    {
                        return 0;
                    }
                };
            }

            public function first()
            {
                return null;
            }
        };
    }

    public static function raw($expression)
    {
        return new class {
            public function __toString()
            {
                return '';
            }
        };
    }
}
