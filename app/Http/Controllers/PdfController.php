<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
Use App\Image;
use Barryvdh\DomPDF\Facade as PDF;
class PdfController extends Controller
{
    public function imprimir(Request $request){
        $now = new \DateTime();//hora
        $images = Image::all();
        $pdf = PDF::loadView('reporte',['images'=>$images],compact('now'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('reporte.pdf', compact('images'));
    }
}
