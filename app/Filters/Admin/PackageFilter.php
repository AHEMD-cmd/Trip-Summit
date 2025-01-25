<?php

namespace App\Filters\Admin;

use App\Helpers\QueryFilter;

class PackageFilter extends QueryFilter
{
    public function name($name = null)
    {
        // Only apply the filter if $name is not null and not an empty string
        if (!empty($name)) {
            return $this->builder->where('name', 'like', "%$name%");
        }

        return $this->builder;
    }

    public function min_price($min_price = null)
    {
        // Only apply the filter if $min_price is not null and not an empty string
        if (!empty($min_price)) {
            return $this->builder->where('price', '>=', $min_price);
        }

        return $this->builder;
    }

    public function max_price($max_price = null)
    {
        // Only apply the filter if $max_price is not null and not an empty string
        if (!empty($max_price)) {
            return $this->builder->where('price', '<=', $max_price);
        }

        return $this->builder;
    }

    public function destination_id($destination_id = null)
    {
        // Only apply the filter if $destination_id is not null and not an empty string
        if (!empty($destination_id)) {
            return $this->builder->where('destination_id', $destination_id);
        }

        return $this->builder;
    }

    public function review($review = null)
    {
        // Only apply the filter if $review is not null and not an empty string
        if (!empty($review)) {
            return $this->builder->whereRaw('total_score/total_rating = ?', [$review]);
        }

        return $this->builder;
    }
}