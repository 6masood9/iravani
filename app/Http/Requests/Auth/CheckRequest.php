<?php

namespace App\Http\Requests\Auth;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Post::query()->where('user_id',Auth::id())->find($this->input('id'));
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'email' => 'required|email',
                'password' => 'required|min:5|max:12'
        ];
    }
}
