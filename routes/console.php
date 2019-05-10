<?php

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('excel:importUserFileWithMemoryLeak', function () {
    $this->info('truncate users table...');
    \App\User::query()->truncate();

    /**@var \Maatwebsite\Excel\Excel $excel*/
    $excel = \Maatwebsite\Excel\Facades\Excel::getFacadeRoot();

    $file = storage_path('app'. DIRECTORY_SEPARATOR .'public'. DIRECTORY_SEPARATOR .'MOCK_DATA.csv');

    $excel->import(
        new \App\Imports\UsersImport,
        $file
    );
});

Artisan::command('excel:importUserFileWithoutMemoryLeak', function () {
    $this->info('truncate users table...');
    \App\User::query()->truncate();

    /**@var \Maatwebsite\Excel\Excel $excel*/
    $excel = \Maatwebsite\Excel\Facades\Excel::getFacadeRoot();

    $file = storage_path('app'. DIRECTORY_SEPARATOR .'public'. DIRECTORY_SEPARATOR .'MOCK_DATA.csv');

    $excel->import(
        new \App\Imports\UsersImportWithoutMemoryLeak,
        $file
    );
});
