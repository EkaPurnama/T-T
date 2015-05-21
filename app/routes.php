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
Route::post('login', 'HomeController@doLogin');
Route::get('logout', 'HomeController@doLogout');
Route::get('/', function()
{
	return View::make('contents.content_main')->with('idbaru', App::make('DataController')->getNewId());
});
Route::group(array('before' => 'auth'),function(){
	Route::post('',function(){
		$input = Input::all();
		return Redirect::to('')->with('bulan',$input['bulan']);
	});
	Route::get('new/spd', array(
		'as'=>'getNewIdSpd',
		'uses'=>'DataController@getNewId'
	));
	Route::get('new/kode_spd', array(
		'as'=>'getNewKode',
		'uses'=>'DataController@getNewKode'
	));
	Route::get('new/rincian', array(
		'as'=>'getNewIdRincian',
		'uses'=>'DataController@getNewIdRincian'
	));
	Route::get('new/pengikut', array(
		'as'=>'getNewIdPengikut',
		'uses'=>'DataController@getNewIdPengikut'
	));
	Route::get('data/nip', array(
		'as' => 'getNip',
		'uses' => 'DataController@nip_list' 
	));
	Route::get('data/spd/json', array(
		'as' => 'getDots',
		'uses' => 'DataController@ajaxTableDot' 
	));
	Route::get('data/ajax/monitor', function(){
		return View::make('contents.content_dotTable');
	});
	Route::get('data/ajax/monitor/{bln}', function($bln){
		return View::make('contents.content_dotTable')->with('bulan',$bln);
	});
	App::missing(function($exception)
	{
	    return Response::view('error.404', array(), 404);
	});

	Route::get('ajax/jumlah/nip_spd/{id}', array(
		'as' => 'ajaxJmlhNipSpd',
		'uses' => 'DataController@ajaxJmlhNipSpd'
	));

	Route::get('ajax/get/nama/{id}', array(
		'as' => 'ajaxGetNamaNip',
		'uses' => 'DataController@ajaxGetNamaNip'
	));
	Route::get('ajax/rincian/{id}', array(
		'as' => 'ajaxRincian_biaya',
		'uses' => 'DataController@ajaxRincian_biaya'
	));
	Route::get('ajax/detail/{kode}/{id}', array(
		'as' => 'ajaxDetailRincian',
		'uses' => 'DataController@ajaxDetailRincian'
	));
	Route::get('ajax/nip_rincian/{id}', array(
		'as' => 'ajaxNip_rincian',
		'uses' => 'DataController@ajaxNip_rincian'
	));
	Route::get('ajax/nama_pemangku/{id}', array(
		'as' => 'ajaxPemangku',
		'uses' => 'DataController@ajaxPemangku'
	));
	Route::get('data/ajax/spd/{id}', array(
		'as' => 'ajaxSpd',
		'uses' => 'DataController@ajaxSpd'
	));
	Route::get('data/ajax/pengikut/{id}', array(
		'as' => 'ajaxPengikut',
		'uses' => 'DataController@ajaxPengikut'
	));

	Route::post('post/spd/edit/{id}', array(
		'as' => 'postEditSpd',
		'uses' => 'DataController@postEditSpd'
	));
	Route::post('post/batal/{id}', array(
		'as' => 'postUbahJadwal',
		'uses' => 'DataController@postUbahJadwal'
	));
	Route::post('post/pembatal/{id}', array(
		'as' => 'postBatalkan',
		'uses' => 'DataController@postBatalkan'
	));
	Route::post('post/spd/create', array(
		'as' => 'postCreateSpd',
		'uses' => 'DataController@postCreateSpd'
	));
	Route::post('rincian/post/create', array(
		'as' => 'postCreateRincian',
		'uses' => 'DataController@postCreateRincian'
	));
	Route::post('post/delete', array(
		'as' => 'postDeleteTable',
		'uses' => 'DataController@postDeleteTable'
	));
	Route::get('/setting', function(){
		return View::make('contents.trial');
	});
	Route::get('ekspor/surat_tugas/{id}/{sumber}', array(
		'as' => 'eksporSurat_tugas',
		'uses' => 'DataController@eksporSurat_tugas'
	));
	Route::post('ekspor/kwitansi/{id}/{sumber}/{total}', array(
		'as' => 'eksporKwitansi',
		'uses' => 'TempController@eksporKwitansi'
	));
	Route::Post('ekspor/kwitansi/{id}/{sumber}', array(
		'as' => 'eksporKwitansi',
		'uses' => 'TempController@waw'
	));
	Route::Post('ekspor/rincian/{id}/{sumber}', array(
		'as' => 'eksporRincian',
		'uses' => 'TempController@wow'
	));
	Route::get('ekspor/sppd/{id}/{sumber}', array(
		'as' => 'eksporSppd',
		'uses' => 'DataController@eksporSppd'
	));
	Route::post('ekspor/rincian_biaya/{id}/{sumber}/{total}', array(
		'as' => 'eksporRincian_biaya',
		'uses' => 'DataController@eksporRincian_biaya'
	));
	Route::get('ekspor/monitor/bulan/{bln}', array(
		'as' => 'eksporMonitor',
		'uses' => 'TempController@wiw'
	));
	Route::post('ekspor/lampiran/{id}/{sumber}', array(
		'as' => 'lampiranSppd',
		'uses' => 'TempController@lampiranSppd'
	));
});