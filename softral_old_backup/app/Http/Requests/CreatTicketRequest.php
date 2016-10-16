<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatTicketRequest extends Request {

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
	 * @return array
	 */
	public function rules()
	{
		return [
			'tusername'=>'required',
			'tuseremail'=>'required | email',
			'tdept'=>'required',
			'tpri'=>'required',
			'tmsg'=>'required'
		];
	}

	public function messages()
	{
    return [
        'tusername.required' => 'Name can not be empty.',
        'tuseremail.required' => 'Email ID can not be empty.',
        'tuseremail.email' => 'Email ID is not vaild.',
          'tpri.required' => 'Priority can not be empty.',
            'tdept.required' => 'Department can not be empty.',
              'tmsg.required' => 'Message can not be empty.'
    ];
	}

}
