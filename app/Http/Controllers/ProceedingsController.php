<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SIG005;
use App\Models\IVMSOL;
use App\Models\SHMCER;
use App\Models\PRMCLI;


class ProceedingsController extends Controller
{
    public function getProceedings($cedula){
        $expedientes = SIG005::where('NroExpPer',$cedula)->where('TexCod',118)->get();
        $certificados = SHMCER::where('CerPosCod',$cedula)->get();
        $certificadosconyuge = SHMCER::where('CerCoCI',$cedula)->get();
        $cartera = PRMCLI::where('PerCod',$cedula)
        ->where('PylCod','!=' ,'P.F.')
        ->get();
        $solicitantes = IVMSOL::where('SolPerCge',$cedula)->first();      

        if ($expedientes->count() >= 1) {
            return response()->json(array('Expe' => 'Ya existe expediente de FICHA DE PRE-INSCRIPCION FONAVIS-SVS!', 'cod'=>1));

        }else{
            $todos = IVMSOL::where('SolPerCod',$cedula)
            ->where('SolEtapa','B')
            ->first();
            if ($todos) {
                return response()->json(array('Expe' => 'Ya es Beneficiario Final!', 'cod'=>1));
            }
        }

        if ($certificados->count() >= 1) {
            return response()->json(array('Expe' => 'Ya cuenta con certificado de Subsidio como Titular!', 'cod'=>1));
        }

        if ($certificadosconyuge->count() >= 1) {
            return response()->json(array('Expe' => 'Ya cuenta con certificado de Subsidio como Conyuge!', 'cod'=>'1'));
        }

        if ($cartera->count() >= 1) {
            return response()->json(array('Expe' => 'Ya cuenta con Beneficios en la Institución!', 'cod'=>'1'));
        }

        if ($solicitantes) {
            //dd(trim($solicitantes->SolPerCod));
            $carterasol = PRMCLI::where('PerCod',trim($solicitantes->SolPerCod))
            ->where('PylCod','!=' ,'P.F.')
            ->get();
            if ($carterasol->count() >= 1) {
                return response()->json(array('Expe' => 'Ya cuenta con Beneficios en la Institución como Conyuge!', 'cod'=>'1'));
            }
        }
        
        return response()->json(array('Expe' => 'Cedula de Identidad no se ha encontró en ningún expediente', 'cod'=>'0'));


    }
}
