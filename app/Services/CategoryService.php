<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function list($params = [])
    {
        $query = Category::paginate(10);

        if (!empty($params['search'])) {
            $query->where('title', 'like', '%' . $params['search'] . '%');
        }

        return $query;
    }
}
