<?php

use Illuminate\Http\Request;

/* ########################### CLIENTES ########################################## */

/* Listar Clientes */
Route::get('/customers', ['uses' => 'CustomerController@getCustomers']);

/* Retorna um cliente pelo id informado como parâmetro */
Route::get('/customers/{id}', ['uses' => 'CustomerController@getCustomer']);

/* Cadastra um cliente */
Route::post('/customers', ['uses' => 'CustomerController@createCustomer']);

/* Atualiza um cliente pelo id informado como parâmetro */
Route::put('/customers/{id}', ['uses' => 'CustomerController@updateCustomer']);

/* Deleta um cliente pelo id informado como parâmetro */
Route::delete('/customers/{id}', ['uses' => 'CustomerController@deleteCustomer']);

/* ########################### EVENTOS ########################################## */

/* Listar Eventos */
Route::get('/events', ['uses' => 'EventController@getEvents']);

/* Retorna um evento pelo id informado como parâmetro */
Route::get('/events/{id}', ['uses' => 'EventController@getEvent']);

/* Cadastra um evento */
Route::post('/events', ['uses' => 'EventController@createEvent']);

/* Atualiza um evento pelo id informado como parâmetro */
Route::put('/events/{id}', ['uses' => 'EventController@updateEvent']);

/* Deleta um evento pelo id informado como parâmetro */
Route::delete('/events/{id}', ['uses' => 'EventController@deleteEvent']);

/* Retorna apenas a coluna responsável por armazenar a quantidade de mesas */
Route::get('/events-quant-tables/{id}', ['uses' => 'EventController@getEventQuantTables']);

/* ########################### RELEASE TABLES ########################################## */

Route::get('/release-tables', ['uses' => 'ReleaseTableController@getEventsLocal']);

Route::get('/release-tables/{id}', ['uses' => 'ReleaseTableController@getEventsCustomer']);

Route::post('/release-tables', ['uses' => 'ReleaseTableController@postTable']);

/* ########################### REPORT TABLES ########################################## */

Route::get('/report-tables', ['uses' => 'ReportTableController@getReportTables']);

Route::put('/report-tables/{id}', ['uses' => 'ReportTableController@updateTable']);

Route::delete('/report-tables/{id}', ['uses' => 'ReportTableController@deleteTable']);

/* ########################### GOOGLE MAPS ########################################## */

Route::get('/google-maps/{id}', ['uses' => 'GoogleMapsController@maps']);
