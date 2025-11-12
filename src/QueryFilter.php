<?php

namespace RbdevSys\Filterable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected Request $request;
    protected Builder $builder;

    /**
     * QueryFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     *
     */
    public function filters(): array
    {
        return $this->request->all();
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if ($this->invalid($name, $value)) {
                continue;
            }

            if (!is_null($value) ) {
                $this->$name($value);
                continue;
            }
            $this->$name();
        }

        return $this->builder;
    }

    /**
     * @param $name
     * @param $value
     * @return bool
     */
    private function invalid($name, $value): bool
    {
        return
            !method_exists($this, $name)
            || is_null($value)
            || $value === ''
            || $this->isValidArray($value);
    }

    /**
     * @param $array
     * @return bool
     */
    private function isValidArray($array): bool
    {
        if (is_array($array)) {
            return implode($array) === '';
        }
        return false;
    }
}
