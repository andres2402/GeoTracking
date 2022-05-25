<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


trait RestActions
{
	public function respond($status, $data = [], $error = null, $message = null)
    {
        return ['data' => $data, 'status' => $this->$status,'message'=>$message, 'error' => $error];
    }
}
