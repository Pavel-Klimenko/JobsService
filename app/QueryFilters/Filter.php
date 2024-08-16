<?php

namespace App\QueryFilters;
use Illuminate\Support\Str;
use Illuminate\Pipeline\Pipeline;

use Closure;

abstract class Filter
{
    /**Accounting for all filters passed in the request
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!request()->has($this->filterName())) {
            return $next($request);
        }
        $builder = $next($request);
        return $this->applyFilter($builder);
    }

    protected abstract function applyFilter($builder);

    /**Getting the filter parameter for the $query->where() method from the filter class name
     *
     * @return string
     */
    protected function filterName() {
        return Str::snake(class_basename($this));
    }

    public static function getByFilter($model, array $filters) {
        return app(Pipeline::class)
            ->send($model::query())
            ->through($filters)
            ->thenReturn();
    }
}
