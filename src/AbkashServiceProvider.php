<?php

namespace Anwar\Abkash;

use Illuminate\Support\ServiceProvider;

class AbkashServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->publishes([
			__DIR__ . '/Config/abkash.php' => config_path('Abkash.php'),
		]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->make('Anwar\Abkash\AbkashController');
		$this->app->bind('Abkash', function () {
			return new AbkashController;
		});
	}
}
