<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('logout', 'AuthController@logout')->name('logout');
});

Route::prefix('prefectures')->name('prefectures.')->group(function () {
    Route::get('/', 'PrefectureController@index')->name('index');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::post('/', 'PrefectureController@store')->name('store');
        Route::delete('/{prefecture}', 'PrefectureController@destroy')->name('destroy');
    });
});

Route::prefix('areas')->name('areas.')->group(function () {
    Route::get('/', 'AreaController@index')->name('index');
    Route::get('/{area}', 'AreaController@show')->name('show');
    Route::get('/{area}/routes', 'AreaController@getRoutesByArea')->name('getRoutesByArea');
    Route::get('/{area}/landmarks', 'AreaController@getLandmarksByArea')->name('getLandmarksByArea');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::post('/', 'AreaController@store')->name('store');
        Route::post('/{area}', 'AreaController@update')->name('update');
        Route::delete('/{area}', 'AreaController@destroy')->name('destroy');
    });
});

Route::prefix('members')->name('members.')->group(function () {
    Route::get('/', 'MemberController@index')->name('index');
    Route::middleware('auth.montbell')->group(function () {
        Route::get('/{member}', 'MemberController@show')->name('show');
        Route::get('/{member}/stamps', 'MemberController@stamps')->name('stamps');
        Route::get('/{member}/tracks', 'MemberController@tracks')->name('tracks');
        Route::get('/{member}/news', 'MemberController@news')->name('news');
        Route::get('/{member}/news/{news}', 'MemberController@getNews')->name('getNews');
        Route::put('/{member}/news/{news}', 'MemberController@updateNews')->name('updateNews');
    });
});

Route::prefix('admins')->name('admins.')->group(function () {
    Route::post('/login', 'AdminController@login')->name('login');
    Route::get('/refresh','AdminController@refreshToken')->name('refresh-token');
    Route::get('/logout', 'AdminController@logout')->name('logout');
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/{admin}', 'AdminController@show')->name('show');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::post('/', 'AdminController@store')->name('store');
        Route::put('/{admin}', 'AdminController@update')->name('update');
        Route::delete('/{admin}', 'AdminController@destroy')->name('destroy');
    });
});

Route::prefix('tracks')->name('tracks.')->group(function () {
    Route::get('/', 'TrackController@index')->name('index');
    Route::get('/{track}', 'TrackController@show')->name('show');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::post('/', 'TrackController@store')->name('store');
        Route::put('/{track}', 'TrackController@update')->name('update');
        Route::delete('/{track}', 'TrackController@destroy')->name('destroy');
    });
    Route::post('/multi', 'TrackController@storeMulti')->name('storeMulti');
});

Route::prefix('trackpoints')->name('trackpoints.')->group(function () {
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::post('/', 'TrackPointController@store')->name('store');
    });
});

Route::prefix('routes')->name('routes.')->group(function () {
    Route::post('/filterByActivity', 'RouteController@getRoutesByActivity')->name('getRoutesByActivity');
    Route::get('/', 'RouteController@index')->name('index');
    Route::get('/filters', 'RouteController@filters')->name('filters');
    Route::get('/{route}', 'RouteController@show')->name('show');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::post('/', 'RouteController@store')->name('store');
        Route::put('/{route}', 'RouteController@update')->name('update');
        Route::delete('/{route}', 'RouteController@destroy')->name('destroy');
        Route::delete('/{route}/badge', 'RouteController@destroyBadge')->name('destroyBadge');
    });
    Route::get('/{route}/tiles', 'RouteController@getTiles')->name('getTiles');
});

Route::prefix('activities')->name('activities.')->group(function () {
    Route::get('/', 'ActivityController@index')->name('index');
    Route::get('/{activity}', 'ActivityController@show')->name('show');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::put('/{activity}', 'ActivityController@update')->name('update');
        Route::post('/', 'ActivityController@store')->name('store');
        Route::delete('/{activity}', 'ActivityController@destroy')->name('destroy');
    });
});

Route::prefix('regions')->name('regions.')->group(function () {
    Route::get('/', 'RegionController@index')->name('index');
    Route::get('/{region}', 'RegionController@show')->name('show');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::put('/{region}', 'RegionController@update')->name('update');
        Route::post('/', 'RegionController@store')->name('store');
        Route::delete('/{region}', 'RegionController@destroy')->name('destroy');
    });
    Route::get('/{region}/areas', 'RegionController@getAreasByRegion')->name('getAreasByRegion');
});

Route::prefix('tags')->name('tags.')->group(function () {
    Route::get('/active', 'TagController@listTagsActive')->name('listTagsActive');
    Route::get('/', 'TagController@index')->name('index');
    Route::get('/{tag}', 'TagController@show')->name('show');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::put('/{tag}', 'TagController@update')->name('update');
        Route::post('/', 'TagController@store')->name('store');
        Route::delete('/{tag}', 'TagController@destroy')->name('destroy');
    });
});

Route::prefix('stamps')->name('stamps.')->group(function () {
    Route::get('/', 'StampController@index')->name('index');
    Route::get('/{stamp}', 'StampController@show')->name('show');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::put('/{stamp}', 'StampController@update')->name('update');
        Route::post('/', 'StampController@store')->name('store');
        Route::delete('/{stamp}', 'StampController@destroy')->name('destroy');
    });
});

Route::prefix('landmarks')->name('landmarks.')->group(function () {
    Route::get('/', 'LandmarkController@index')->name('index');
    Route::get('/{landmark}', 'LandmarkController@show')->name('show');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::post('/{landmark}', 'LandmarkController@update')->name('update');
        Route::post('/', 'LandmarkController@store')->name('store');
        Route::delete('/{landmark}', 'LandmarkController@destroy')->name('destroy');
    });
});

Route::prefix('points')->name('points.')->group(function () {
    Route::get('/', 'PointController@index')->name('index');
    Route::get('/{point}', 'PointController@show')->name('show');
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::post('/{point}', 'PointController@update')->name('update');
        Route::post('/', 'PointController@store')->name('store');
        Route::delete('/{point}', 'PointController@destroy')->name('destroy');
    });
});

Route::prefix('appinfo')->name('appinfo.')->group(function () {
    Route::put('/', 'AppInfoController@store')->name('store');
    Route::get('/', 'AppInfoController@show')->name('show');
});

Route::prefix('scenes')->name('scenes.')->group(function () {
    Route::get('/', 'SceneController@index')->name('index');
});

Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', 'NewsController@index')->name('index');
    Route::get('/{news}', 'NewsController@show')->where(['news' => '[0-9]+'])->name('show');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'NewsController@indexAdmin')->name('index');
        Route::get('{news}', 'NewsController@showAdmin')->name('show');
    });
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::post('/{news}', 'NewsController@update')->name('update');
        Route::post('/', 'NewsController@store')->name('store');
        Route::delete('/{news}', 'NewsController@destroy')->name('destroy');
    });
});

Route::prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', 'NotificationController@index')->name('index');
    Route::get('{id}', 'NotificationController@show')->name('show');
    Route::post('/', 'NotificationController@store')->name('store');
    Route::put('{id}', 'NotificationController@update')->name('update');
    Route::delete('{id}', 'NotificationController@destroy')->name('destroy');
    Route::post('fcm_token', 'NotificationController@storeFCMToken');
    Route::post('test', 'NotificationController@sendTestNotifications');
});

Route::prefix('icons')->name('icons.')->group(function () {
    Route::get('/{type}', 'IconController@index')->name('index');
});
Route::prefix('area-photos')->name('area-photos.')->group(function () {
    Route::group([
        'middleware' => 'auth.apiCUD'  // CUD ( Create/ Update / Delete)
    ], function () {
        Route::delete('/{id}', 'AreaPhotoController@destroy')->name('destroy');
    });
});
