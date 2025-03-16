<?php

namespace App\Controllers;
use App\Kernel\View\View;
use App\Kernel\Controller\Controller;
use App\Services\HotelService;

class HomeController extends Controller
{
 public function index():void{
$hotels = new HotelService($this->db());
$this->view('home',[
    'hotels' => $hotels->new(),
     ], 'Главная страница');
 }
}