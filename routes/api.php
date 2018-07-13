<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin:  *');
header ('Access-Control-Expose-Headers: Content-Length, X-JSON');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Accept, Content-Type, X-Auth-Token, Origin, responseType, Authorization');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

require __DIR__ . '/auth/auth.php';
require __DIR__ . '/auth/passwordReset.php';
