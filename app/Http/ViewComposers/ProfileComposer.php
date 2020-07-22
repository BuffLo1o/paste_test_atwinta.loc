<?php

namespace App\Http\ViewComposers;

//для версии 5.2 и выше:
use Illuminate\View\View;
use App\Repositories\UserRepository;

class ProfileComposer
{
  /**
   * Реализация пользовательского репозитория.
   *
   * @var UserRepository
   */
  protected $pastes;
  protected $user_pastes;
  /**
   * Создание построителя нового профиля.
   *
   * @param  UserRepository  $users
   * @return void
   */
  public function __construct(\App\Repositories\PasteRepository $pastes)
  {
    // Зависимости автоматически извлекаются сервис-контейнером...
    $this->pastes = $pastes->loadLast();
    if(\Auth::user()!=null)
    {
        $this->user_pastes = $pastes->loadUserLast(\Auth::user());
    }
  }

  /**
   * Привязка данных к представлению.
   *
   * @param  View  $view
   * @return void
   */
  public function compose(View $view)
  {
    $view->with('pastes', $this->pastes);
    $view->with('user_pastes', $this->user_pastes);
  }
}