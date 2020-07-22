<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
  /**
   * Регистрация привязок в контейнере.
   *
   * @return void
   */
  public function boot()
  {
    // Использование построителей на основе класса...
    view()->composer(
      'layouts.app', 'App\Http\ViewComposers\ProfileComposer'
    );
    /*
    // Использование построителей на основе замыканий...
    view()->composer('layouts.app', function ($view) {
      $view->title = "asdasdasdasd123";
    });//*/
  }

  /**
   * Регистрация сервис-провайдера.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
