<?php


namespace core\builders;

use core\controllers\LoginCoreController;
use core\controllers\UserController;
class NavbarBuilder
{
    public $navbar;
    public function __construct($navbarMode,$navbarSearch,$Brand,$activePage = null){

        $Pages =  require 'config/'.$navbarMode.'_pages.php'; // Получили страницы для конкретного типа пользователя
        $this->navbar = self::NavbarBegin($Brand);
        foreach ($Pages as $page){
            if(isset($page['SUB'])){ // Если у нас есть кнопка с выпадающим меню
                $this->navbar.='        <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    '.$page['Title'].'
                                </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">'.PHP_EOL;
                foreach ($page['SUB'] as $el){
                    $this->navbar.= '                                <li><a class="dropdown-item" href="'.$el['URL'].'">'.$el['Title'].'</a></li>'.PHP_EOL;
                }
                $this->navbar.='                    </ul>'.PHP_EOL.'          </li>'.PHP_EOL;
            }
            else{ // Если у нас обычная кнопка
                if(($page['Title']==$activePage)&&(!is_null($activePage))){//Если эта страница является активной
                    $this->navbar.='        <li class="nav-item">
                <span class="nav-link active" aria-current="page">'.$page['Title'].'</span>
                    </li>'.PHP_EOL;
                }
                else{
                    $this->navbar.='<li class="nav-item">
                                <a class="nav-link" aria-current="page" href="'.$page['URL'].'">'.$page['Title'].'</a>
                              </li>'.PHP_EOL;
                }
            }
        }
        $this->navbar.=self::NavbarEnd($navbarSearch);
        return $this->navbar;
    }

    private static function NavbarBegin($Brand){ // Начало навбара
        return '
        <nav class="navbar  navbar-expand-lg navbar-light bg-light " id="Navbar">
            <div class="container-fluid">
            <a class="navbar-brand" href="/">'.$Brand.'</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        ';
    }

    private static function UserLogin(){
        if(UserController::Logined()===false){
        return    '<div class="dropdown">
                        <img src="'.UserController::UserInfo('img').'" class="img-fluid rounded-circle" style="max-width: 50px; cursor: pointer;" 
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" role="button" onclick="LoginRegModal.OpenModal(\'Login\')"/>
                        
                    </div>';
        }
        else{
               return' <div class="dropdown">
                        <img src="'.UserController::UserInfo('img').'" class="img-fluid rounded-circle" style="max-width: 50px; cursor: pointer;" 
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" role="button"/>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a href="/Lk/logout" class="dropdown-item" >Выход</a></li>
                        </ul>
                    </div>';
            }
    }

    private static function NavbarEnd($navbarSearch){//
        if($navbarSearch === true) {
            return '
                    </ul>
                        <div class="ml-auto">
                    '.self::UserLogin().'
                        </div>
                        <form class="d-flex ml-auto" v-on:submit.prevent.stop>
                            <template v-if="TooShort==true">
                                <div class="alert alert-secondary fade show" role="alert">
                                    Запрос минимум 3 символа 
                                    <button type="button" class="btn-close" aria-label="Close" v-on:click="ClearAlert(\'Tooshort\')"></button>
                                </div>
                            </template>
                            <template v-if="NoResults==true">
                                <div class=" alert alert-secondary fade show" role="alert">
                                    Не найдены результаты
                                    <button type="button" class="btn-close"  aria-label="Close" v-on:click="ClearAlert(\'NoResults\')"></button>
                                </div>
                            </template>
                            <template v-if="NoErrors==true">
                                <div class="input-group">
                                    <input class="form-control" id="NavbarSearch" type="search" placeholder="Поиск" v-model="SearchQuery"  aria-label="Search">
                                    <span class="input-group-text" style="cursor: pointer" v-on:click="QuerySTR()"><i class="fab fa-searchengin"></i></span>
                                </div>
                            </template>   
                        </form>
                  </div>
               </div>
        </nav>
        <div class="modal fade hide" id="NavbarSearchResults" tabindex="-1" aria-labelledby="NavbarSearchResultsLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="NavbarSearchResultsLabel">Результаты поиска</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="ResBlock">
                         <div class="container shadow-lg mt-2 mb-2" v-for="item in SearchResultsContent">
                            <div class="col" v-html="item"></div>
                         </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="button" class="btn btn-primary" >Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>                      
        <script src="/assets/bootstrap/js/NavbarVUE.js"></script>
  </div>
</div>
        
        ';
        }
        else{
            return '
                    </ul>
                        <div class="ml-auto" style="margin-right: 100px;">
                    '.self::UserLogin().'
                        </div>
                  </div>
               </div>
        </nav>
        
        ';
        }
    }

    private static function ADDJS_Modal(){
        if(UserController::Logined()===false){ // Если пользователь не залогиненный то ему отправлем модалку входа и регистрации + JS для входа
       return'<div class="modal fade" id="LoginRegModalbootstrap" tabindex="-1" aria-labelledby="LoginRegModalLabel" aria-hidden="true">
                <div class="modal-dialog" id="LoginRegModal">
                    <div class="modal-content">
                      <form method="post" action="/Login/AdminLogin">
                        <div class="modal-header">
                            <h5 class="modal-title" >{{ Title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="password" name="password" class="form-control" placeholder="Введите пароль" required/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success">Войти</button>
                        </div>
                      </form>  
                    </div>
                </div>
            </div>
            <script src="/assets/bootstrap/js/LoginRegVUE.js"></script>
            ';
        }
    }

    public function render(){
        $this->navbar.= self::ADDJS_Modal();
        return $this->navbar;
    }
}


