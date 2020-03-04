<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
//
Route::get('index', 'frontend/index/index');
Route::get('articeinfo', 'frontend/index/detalis');
Route::post('click', 'frontend/index/click');
Route::post('articeaddcomment', 'frontend/index/addcomment');


Route::get('message', 'frontend/message/index');
Route::post('addmessage', 'frontend/message/add');

Route::get('diary', 'frontend/diary/index');
Route::get('diarydetalis', 'frontend/diary/detalis');
