<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Front page
Route::get('/', function()
{
  return View::make('default')
    ->with('title', 'Front Page');
});

// Displaying information
Route::get('u/{name}', 'UserController@show');
Route::get('r/{name}', 'SubController@show');
Route::get('p/{id}', 'PostController@show');

// Signing in
Route::get('signin', function()
{
  return View::make('forms.signin')
    ->with('title', 'Sign In');
});
Route::post('signin', 'UserController@signIn');

// Signing up
Route::get('signup', function()
{
  return View::make('forms.signup')
    ->with('title', 'Sign Up');
});
Route::post('signup', 'UserController@signUp');

// Signing out
Route::get('signout', 'UserController@signOut');

// Submitting a new post
Route::get('submit', array('before' => 'auth', function()
{
  return View::make('forms.submit')
    ->with('title', 'New Post');
}));
Route::post('submit', array(
  'before' => 'auth',
  'uses' => 'PostController@create'
));
