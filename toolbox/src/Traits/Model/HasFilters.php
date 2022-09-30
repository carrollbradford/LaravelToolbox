<?php

namespace Carrollbradford\Toolbox\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Carrollbradford\Toolbox\Utilities\Filters;

trait HasFilters
{
    //============================================
    //-----------------------------------
    //------ SCOPES
    //-------------------------------

    /**
     * Scope a query to only include specific criteria.
     *
     * @param Builder $builder
     * @param instace|array|object $filters
     * @return Builder The Filters class will return the builder instance
     */
    public function scopeFilter(Builder $builder, $filters = null): Builder
    {
        $filterClass = emptyOrValue($this->filterClass ?? null);
        $filters = new Filters($builder, $filters, $filterClass, $this);
        
        return $filters->apply();
    }
}
