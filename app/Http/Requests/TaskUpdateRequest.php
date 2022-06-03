<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'priority' => 'required|string|in:' . Task::PRIORITY_HIGH . ',' . Task::PRIORITY_LOW . ',' . Task::PRIORITY_MEDIUM,
            'state' => 'required|string|in:' . Task::STATE_OPEN . ',' . Task::STATE_CLOSE . ',' . Task::STATE_REJECTED . ',' . Task::STATE_TO_DO . ',' . Task::STATE_IN_PROGRESS . ',' . Task::STATE_TESTING . ',' . Task::STATE_DONE,
            'due_date' => 'nullable|date|date_format:Y-m-d H:i',
        ];
    }
}
