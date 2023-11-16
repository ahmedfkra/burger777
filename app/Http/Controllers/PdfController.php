<?php

namespace App\Http\Controllers;

use App\Models\Balances;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    //
    /*public function __invoke(Balances $order)
    {
        return Pdf::loadView('pdf', ['record' => $order])
            ->download($order->number. '.pdf');
    }
    */
}
