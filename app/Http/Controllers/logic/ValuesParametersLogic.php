<?php

namespace App\Http\Controllers\logic;

use App\ParameterValue;
use Illuminate\Http\Request;


trait ValuesParametersLogic
{

	protected $statusCodes = [
		'done' => 200,
		'created' => 201,
		'removed' => 204,
		'not_valid' => 400,
		'not_found' => 404,
		'conflict' => 409,
		'permissions' => 401,
		'server error' => 500
	];

	public function all()
	{
		try {
			$m = self::MODEL;
			return $this->respond('done', $m::all());
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
	}

	public function get($model)
	{
		try {
			if (is_null($model)) {
				return $this->respond('not_found');
			}
			return $this->respond('done', $model);
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
    }
    public function addValues($request){
        try {
			$m = ParameterValue::class;
			return $this->respond('created', $m::create($request->all()));
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
    }

	public function add($request)
	{
		try {
			$m = self::MODEL;
			return $this->respond('created', $m::create($request->all()));
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
	}

	public function put($request, $model)
	{
		try {
			if (is_null($model)) {
				return $this->respond('not_found');
			}
			$model->update($request->all());
			return $this->respond('done', $model);
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
	}

	public function remove($model)
	{
		try {

			if (is_null($model)) {
				return $this->respond('not_found');
			}
			$model->delete();
			return $this->respond('removed');
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
	}

	public function respond($status, $data = [], $error = null)
	{
		return ['data' => $data, 'status' => $this->statusCodes[$status],'message'=>$status, 'error' => $error];
	}
}