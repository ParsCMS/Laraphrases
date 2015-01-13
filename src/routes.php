<?php

Route::group(['prefix' => 'laraphrases'], function()
{
    $canEdit = Config::get('laraphrases::phrase.can_edit');
    Route::post('remote-update', [ 'uses' => 'LaraphraseController@postRemoteUpdate']);
    Route::post('approve', [ 'uses' => 'LaraphraseController@approve']);
});