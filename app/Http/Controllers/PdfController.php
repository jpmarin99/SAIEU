<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;
class PdfController extends Controller
{
    public function imprimir(Request $request){
        $now = new DateTime();//hora
        $images = Post::orderBy('id', 'desc')->paginate(10);;
        $pdf = PDF::loadView('reporte',['images'=>$images],compact('now'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('reporte.pdf', compact('images'));
    }
}

