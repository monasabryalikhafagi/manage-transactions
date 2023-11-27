<?php

namespace App\Http\Traits;

trait Response
{

	public function fullDataResponse($token, $data, $message, $code)
	{
		$array = [
			'token'    => $token,
			'data'     => $data,
			'message'  => $message,
			'status'   => in_array($code, $this->successCode()) ? true : false,
		];
		return response($array, $code);
	}

	public function dataResponse($data, $message = null, $code = 200)
	{
		$array = [
			'data'     => $data,
			'message'  => $message,
			'status'   => in_array($code, $this->successCode()) ? true : false,
		];
		return response($array, $code);
	}

	public function errorResponse($message, $errors, $code)
	{
		$array = [
			'message' => $message,
			'errors'  => $errors,
			'status' => in_array($code, $this->successCode()) ? true : false
		];
		return response($array, $code);
	}

	public function successCode()
	{
		return [200, 201, 202];
	}

	//by taha
	//message is string 
	//dataOrErrors is data if (200,201,202) else errors
	//code 200,404 ......... 
	//meta is array as ['token'=>$token , 'count'=>20]
	public  function ResponseApi($message = '', $dataOrErrors = null, $code = 200, $meta = [])
	{
		$array = [
			'status' => in_array($code, $this->successCode()) ? true : false,
			'message' => ($message == null )? '':$message,
			in_array($code, $this->successCode()) ? 'data' : 'errors'  => $dataOrErrors,
		];
		if (!empty($meta))
			foreach ($meta as $key => $value) {
				$array[$key] = $value;
			}

		return response($array, $code);
	}
}
