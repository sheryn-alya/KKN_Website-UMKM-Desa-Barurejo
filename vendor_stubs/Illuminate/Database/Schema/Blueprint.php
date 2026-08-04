<?php

namespace Illuminate\Database\Schema;

class Blueprint
{
    public function id()
    {
        return $this;
    }

    public function string($column, $length = null)
    {
        return $this;
    }

    public function text($column)
    {
        return $this;
    }

    public function json($column)
    {
        return $this;
    }

    public function double($column, $total = null, $places = null)
    {
        return $this;
    }

    public function timestamps()
    {
        return $this;
    }
}
