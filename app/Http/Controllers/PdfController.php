<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Image;
use Barryvdh\DomPDF\Facade as PDF;
class PdfController extends Controller
{
    public function imprimir(Request $request){
        $images = Image::all();
        $pdf = PDF::loadView('reporte',['images'=>$images]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('reporte.pdf', compact('images'));
    }
}
