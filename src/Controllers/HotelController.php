<?php

namespace App\Controllers;

use App\Kernel\View\View;
use App\Kernel\Controller\Controller;
use App\Kernel\Validator\Validator;
use App\Kernel\Http\Redirect;
use App\Services\HotelService;


class HotelController extends Controller
{
    private HotelService $service;

//    public function index(): void
//    {
//
//        $this->view('admin/hotels/add');
//    }

    public function add(): void
    {
        $this->view('admin/hotels/add');
    }

    public function store()
    {

        $file = $this->request()->file('image');



        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required'],
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/admin/hotels/add');

        }

        $this->service()->store(
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image'),
        );

        $this->redirect('/admin');
    }

    public function edit(): void
    {


        $this->view('admin/hotels/update', [
            'hotel' => $this->service()->find($this->request()->input('id')),
        ]);
    }

    public function update()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'description' => ['required'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect("/admin/hotels/update?id={$this->request()->input('id')}");
        }

        $this->service()->update(
            $this->request()->input('id'),
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image'),
        );

        $this->redirect('/admin');
    }

    public function destroy (): void
    {
        $this->service()->destroy($this->request()->input('id'));

        $this->redirect('/admin');
    }

    public function show(): void
    {
        $hotel = $this->service()->find($this->request()->input('id'));

        $this->view('hotel', [
            'hotel' => $hotel,
        ], "Отель - {$hotel->name()}");
    }

    private function service(): HotelService
    {
        if (! isset($this->service)) {
            $this->service = new HotelService($this->db());
        }

        return $this->service;
    }
}