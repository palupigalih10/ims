<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MenuRepository;
use App\Http\Resources\MenuCollection;
use App\Libraries\ApiResponse;

class MenuController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Show sidebar data menu.
     * 
     * @return response()
     */
    public function sidebar(Request $request, MenuRepository $repo)
    {
        $menus =  $repo->getMenus();

        if (!$menus) {
            return ApiResponse::failed('Failed to get data');
        }

        return ApiResponse::successWithData([
            'data' => new MenuCollection($menus)
        ], 'Data found');
    }
}
