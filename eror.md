# Intervention\Image\Exceptions\NotWritableException - Internal Server Error

Can't write image to path. Directory does not exist.

PHP 8.3.26
Laravel 12.40.2
127.0.0.1:8000

## Stack Trace

0 - vendor\intervention\image\src\File.php:53
1 - vendor\intervention\image\src\Image.php:311
2 - app\Http\Controllers\KegiatanController.php:62
3 - vendor\laravel\framework\src\Illuminate\Routing\Controller.php:54
4 - vendor\laravel\framework\src\Illuminate\Routing\ControllerDispatcher.php:43
5 - vendor\laravel\framework\src\Illuminate\Routing\Route.php:265
6 - vendor\laravel\framework\src\Illuminate\Routing\Route.php:211
7 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:822
8 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:180
9 - vendor\laravel\framework\src\Illuminate\Routing\Middleware\SubstituteBindings.php:50
10 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
11 - vendor\laravel\framework\src\Illuminate\Auth\Middleware\Authenticate.php:63
12 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
13 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken.php:87
14 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
15 - vendor\laravel\framework\src\Illuminate\View\Middleware\ShareErrorsFromSession.php:48
16 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
17 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:120
18 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:63
19 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
20 - vendor\laravel\framework\src\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse.php:36
21 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
22 - vendor\laravel\framework\src\Illuminate\Cookie\Middleware\EncryptCookies.php:74
23 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
24 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:137
25 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:821
26 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:800
27 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:764
28 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:753
29 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:200
30 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:180
31 - vendor\livewire\livewire\src\Features\SupportDisablingBackButtonCache\DisableBackButtonCacheMiddleware.php:19
32 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
33 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TransformsRequest.php:21
34 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull.php:31
35 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
36 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TransformsRequest.php:21
37 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TrimStrings.php:51
38 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
39 - vendor\laravel\framework\src\Illuminate\Http\Middleware\ValidatePostSize.php:27
40 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
41 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance.php:109
42 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
43 - vendor\laravel\framework\src\Illuminate\Http\Middleware\HandleCors.php:48
44 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
45 - vendor\laravel\framework\src\Illuminate\Http\Middleware\TrustProxies.php:58
46 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
47 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks.php:22
48 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
49 - vendor\laravel\framework\src\Illuminate\Http\Middleware\ValidatePathEncoding.php:26
50 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
51 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:137
52 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:175
53 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:144
54 - vendor\laravel\framework\src\Illuminate\Foundation\Application.php:1220
55 - public\index.php:20
56 - vendor\laravel\framework\src\Illuminate\Foundation\resources\server.php:23

## Request

POST /kegiatan

## Headers

* **host**: 127.0.0.1:8000
* **connection**: keep-alive
* **content-length**: 692457
* **cache-control**: max-age=0
* **sec-ch-ua**: "Google Chrome";v="143", "Chromium";v="143", "Not A(Brand";v="24"
* **sec-ch-ua-mobile**: ?0
* **sec-ch-ua-platform**: "Windows"
* **upgrade-insecure-requests**: 1
* **user-agent**: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36
* **origin**: http://127.0.0.1:8000
* **content-type**: multipart/form-data; boundary=----WebKitFormBoundary44pme9EZjbIqxCCv
* **accept**: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
* **sec-fetch-site**: same-origin
* **sec-fetch-mode**: navigate
* **sec-fetch-user**: ?1
* **sec-fetch-dest**: document
* **referer**: http://127.0.0.1:8000/kegiatan/create
* **accept-encoding**: gzip, deflate, br, zstd
* **accept-language**: id,en-US;q=0.9,en;q=0.8
* **cookie**: XSRF-TOKEN=eyJpdiI6Im5yVS80aUpXVzFLdGxmZlE4NitTNVE9PSIsInZhbHVlIjoiRi93d3Jyb0FlM2t0d3ovU2YyR0lreW05aUNLQnV3V2lCVFpkQkFqd1ZWVTNQZGlVR0kwQlJXenZnUlN1TEN5Q1ZnZzM5VFg5S1V5R2ZrODlIakZ1TWxoUW55cXVXYU45b1FMdk5HbXRNcjlrZkljTFordXB5Wlo1dThlaTQvU0wiLCJtYWMiOiJlZTExNmJmNGE3MWRlMTg4OTlhZmViZTUyODI2ZGRmYzA1YjBiM2NjYzI5ZDA0OWZiNGY0YzM1OTQ1NGE5OWViIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Ink3cWYwcXVYblUySlMvMFZpNldZaWc9PSIsInZhbHVlIjoiQ0JNa2VDODNNYW9EdVpHa1F3dTZGZk1pV0tEUkZqTjJYclA1dzhlemVGTWpEK1dYaGppNzNPWFR2MXA3OTBrU3l1b0duSUw1M25DM0l5OHRlTFRmMjdDSFkvdWNFdDZGK2ZjcXZtTHNJSTRGbnJpUDVDcjNaL2xMSnZqWGdEK3QiLCJtYWMiOiIxNjI2ZTA4ZWI0NzllNjk1YjNiMWUyZmI3ZWJmZDVjMzZiMDc2MmFmZjZiNTVkM2FkMTA3ZjEzMzVkZjNmYjlmIiwidGFnIjoiIn0%3D

## Route Context

controller: App\Http\Controllers\KegiatanController@store
route name: kegiatan.store
middleware: web, auth

## Route Parameters

No route parameter data available.

## Database Queries

* mysql - select * from `sessions` where `id` = 'Fcbdsu3jj0Ojr0wfujDO602ODa08zJJYc6KUwq7W' limit 1 (25.81 ms)
* mysql - select * from `users` where `id` = 1 limit 1 (1.07 ms)
