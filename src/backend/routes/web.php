<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
   $users = User::all(); // You can also use other query methods like where(), find(), etc.

    return response()->json($users); // Return the result as a JSON response
    //return view('welcome');
});
