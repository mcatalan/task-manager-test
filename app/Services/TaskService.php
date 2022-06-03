<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function list($params = [])
    {
        $query = Task::where('1', '1'); // @TODO

        if (!empty($params['search'])) {
            $query->where('title', 'like', '%' . $params['search'] . '%');
        }

        if (!empty($params['priority'])) {
            $query->where('priority', $params['priority']);
        }

        if (!empty($params['state'])) {
            $query->where('state', $params['state']);
        }

        return $query->get();
    }
}
