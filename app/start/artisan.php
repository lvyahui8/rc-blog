<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

use Illuminate\Support\Facades\Artisan;

Artisan::add(new PullCommand());
Artisan::add(new TestCmd());
Artisan::add(new BlogSpider());