<?php
use \Illuminate\Support\Facades\DB;

function currentUser(){
    if(Auth::check()) {
        return Auth::user() ;
    }else{
        return '';
    }
}
function setActive($uri){
    return Request::is($uri) ? 'kt-menu__item--active' : '';
}

function moneyFormat($number, $fractional = false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);

        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}
