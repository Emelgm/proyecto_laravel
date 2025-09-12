<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Producto;

class ProductosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function view(): View
    {
        $stock=Producto::all();
        $stock->each(function($stock){
            $stock->color;
            $stock->talla;
            $stock->modelo;
        });

        return view('excel.stock', [
            'stock' => $stock
        ]);
    }
}
