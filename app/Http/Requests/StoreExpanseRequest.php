<?php

namespace App\Http\Requests;

use App\Models\Expanse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreExpanseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('expanse_create');
    }

    public function rules()
    {
        return [
            'amount'  => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'stage_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'ادخل  المبلغ من فضلك',
            'name.required' => 'لا تترك هذا الحقل فارغا لو سمحت ',
            'name.string' => ' الاسم يجب عن يكون نصا ',
        ];
    }
}
