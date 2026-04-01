<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CompanyFilter
{
    public function apply(Builder $query)
    {
        $this->search($query);
        $this->jurusan($query);
        $this->rating($query);
        $this->sort($query);
    }

    protected function search($query)
    {
        if ($search = request('search')) {
            $query->where('nama', 'like', "%{$search}%");
        }
    }

    protected function jurusan($query)
    {
        if ($jurusan = request('jurusan')) {
            $query->where('jurusan_id', $jurusan);
        }
    }

    protected function rating($query)
    {
        if ($minRating = request('min_rating')) {
            $query->havingRaw('reviews_avg_rating >= ?', [$minRating]);
        }
    }

    protected function sort($query)
    {
        if (request('sort') === 'rating') {
            $query->orderByDesc('reviews_avg_rating');
        }
    }
}
