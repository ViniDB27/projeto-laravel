<?php

use Illuminate\Support\Facades\Route;

//$this->view('/404-tenant','errors.404-tenant')->name('404.tenant');

Route::get('/404-tenant', function(){
    return view('404');
})->name('404-tenant');

Route::get('/', function () {
    return view('welcome');
});
