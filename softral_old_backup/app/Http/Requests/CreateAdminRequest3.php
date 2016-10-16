<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAdminRequest3 extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */

		public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
		

			'deptname'=>'required'
		];
	}

	public function messages()
	{
    return [
     

                'deptname.required' => 'Department name can not be empty.'
    ];
	}

}
