<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
 return Response::json(Authorizer::issueAccessToken());
});

Route::get('/register ',function(){
 $user = new App\User();
 $user->name="test user";
 $user->email="test@test.com";
 $user->password = \Illuminate\Support\Facades\Hash::make("password");
 $user->save();
 
});

Route::get('api', ['before' => 'oauth', function() {
 	// return the protected resource
 	//echo “success authentication”;
 	$user_id=Authorizer::getResourceOwnerId(); // the token user_id
 	$user=\App\User::find($user_id);// get the user data from database
	return Response::json($user);
}]);

Route::group(['prefix'=>'api','before' => 'oauth'], function(){
    Route::get('/posts',  'PostController@index');
    Route::get("/videos", "VideoController@index");
    Route::post("/videos", "VideoController@store");
	Route::get("/videos/{id}", "VideoController@show");
	Route::put("/videos/{id}", "VideoController@update");
	Route::delete("/videos/{id}", "VideoController@destroy");
});





