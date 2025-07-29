<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'description'=>'required',
            'deadline'=>'required',
            'company_id'=>'required|exists:companies,id',
            'user_id'=>'required|exists:users,id',
            'status' => ['required', Rule::in(array_keys(Project::STATUS))],
        ];
    }
}
