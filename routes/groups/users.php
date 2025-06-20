<?php 

use App\Controllers\Authenticate\UserLogin;
use App\Controllers\Authenticate\UserRegister;
use App\Controllers\ProfileController;
use App\Helpers\Auth;
use App\Middlewares\HasGuest;

Flight::route('GET /register', [new UserRegister(), 'page'])->addMiddleware([new HasGuest()]);;
Flight::route('POST /register', [new UserRegister(), 'action'])->addMiddleware([new HasGuest()]);;

Flight::route('GET /login', [new UserLogin(), 'page'])->addMiddleware([new HasGuest()]);
Flight::route('POST /login', [new UserLogin(), 'action'])->addMiddleware([new HasGuest()]);;

Flight::route('GET /profile', [new ProfileController(), 'page'])
    ->addMiddleware([new hasAuthenticate()]);

Flight::route('GET /logout', function () {
    Auth::logout();
    Flight::redirect("/login");
    return;
})->addMiddleware([new hasAuthenticate()]);