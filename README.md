# Laravel bKash Marchant Transaction Verification
A package for verify bkash marchant payment recived.

### Requirements
    Laravel >=5.1
    PHP >= 5.5.9
    
    
## Installation

For Laravel >= 5.5 you need to follow these steps
---

1. Run
    ```
    composer require anwar/abkash
    ```
2. Run for publish config file
  ```
  php artisan vendor:publish --provider Anwar\Abkash\AbkashServiceProvider --force true
  ```
For Laravel < 5.5 you need to follow these steps
---
1. Run
    ```
    composer require anwar/abkash
    ```
2. Add service provider to **config/app.php** file.
    ```php
    'providers' => [
        ...
        Anwar\Abkash\AbkashServiceProvider::class,
    ],
    ```
    ```php
    'aliases' => [
        ...
        Anwar\Abkash\Faceds\AbkashFaced::class,
    ],
    ```
3. Run for publish config file
  ```
  php artisan vendor:publish --provider Anwar\Abkash\AbkashServiceProvider --force true
  ```
  
For using
----
```PHP
<?php

/**
 * @Author: anwar
 * @Date:   2018-02-07 11:13:24
 * @Last Modified by:   anwar
 * @Last Modified time: 2018-02-07 11:32:48
 */
return [
	"Abkash" => [
		'username' => '', //username of your marchant account
		'password' => '', //password of your marchant account
		'mobile' => '',  //mobile of your marchant account
	],
];
```
After config 
----
You use like this 

```PHP
<?php

namespace App\Http\Controllers;

use Abkash;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return view('home', compact('Abkash'));
	}
}
```

