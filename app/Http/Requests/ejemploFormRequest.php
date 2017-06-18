<?php

namespace SISCOR\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ejemploFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //activa form request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        
        'nameCampo1'  => 'required|max:500|min:6',
        'nameCampo2'  => 'required',
        //Determina validaciones
        //para ser utilizado en controller: ej ... function store(ejemploFormRequest Request)
        ];
    }
}
