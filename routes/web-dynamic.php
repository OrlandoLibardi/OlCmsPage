<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Estas rotas são administradas pelos eventos CreateRoutePage, UpdateRoutePage e DeleteRoutePage
| 
*/


Route::get("primeira-pagina/{extra?}", function(){ return view("website.primeira-pagina"); })->middleware("web");

Route::get("home/{extra?}", function(){ return view("website.home"); })->where("extra", "([A-Za-z0-9\-\/]+)")->middleware("web");