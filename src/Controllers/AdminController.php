<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\HotelService;

class AdminController extends Controller
{
 public function index():void
 {

     $hotels = new HotelService($this->db());

     $this->view('admin/index', [
         'hotels' => $hotels->all()
     ]);


 }
}