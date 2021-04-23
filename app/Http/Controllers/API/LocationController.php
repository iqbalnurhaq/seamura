<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Cabang;
use App\Ongkir;

class LocationController extends Controller
{
    public function regencies(Request $request){
        return Regency::all();
    }
    
    public function districts(Request $request, $regencies_id){
        return District::where('regency_id', $regencies_id)->get();
    }

    public function villages(Request $request, $districts_id){
        return Village::where('district_id', $districts_id)->get();
    }

    // ============== Admin ===================

    public function openCabang(){
        $data = [];
        $cabang = Cabang::all();

        foreach ($cabang as $value) {
            array_push($data, $value->id_re);
        }
        return Regency::whereNotIn('id', $data)->get();
    }

    public function getBranchs(){
         return Cabang::all();
    }

    public function addCabang(Request $request){
         $data = $request->all();

         $cabangId = $request->input('id_re');
         $cabang = Cabang::where('id_re', $cabangId)->first();
         if ($cabang) {
             return response()->json([
                'status' => 'error',
                'message' => 'something went wrong'
            ], 404);
         }
         
         $createCabang = Cabang::create($data);


        return response()->json([
            'status' => 'success',
            'data' => $createCabang
        ]);
    }

    public function deleteCabang(Request $request, $id){
          $cabang = Cabang::find($id);
         if (!$cabang) {
             return response()->json([
                'status' => 'error',
                'message' => 'something went wrong'
            ], 404);
         }
        $cabang->delete();


          return response()->json([
            'status' => 'success',
            'data' => 'berhasil hapus'
        ]);
         
    }

    public function addOngkir(Request $request){
        $data = $request->all();

         $district_id = $request->input('district_id');
         $cabang = Ongkir::where('district_id', $district_id)->first();
         if ($cabang) {
             return response()->json([
                'status' => 'success',
                'message' => 'something went wrong'
            ]);
         }
         
         $createCabang = Ongkir::create($data);


        return response()->json([
            'status' => 'success',
            'data' => $createCabang
        ]);
    }

    public function districtsOngkir(Request $request, $regencies_id){
        $data = [];
        $ongkir = Ongkir::all();

        foreach ($ongkir as $value) {
            array_push($data, $value->district_id);
        }
        return District::where('regency_id', $regencies_id)->whereNotIn('id', $data)->get();
        // return District::where('regency_id', $regencies_id)->get();
    }

    public function getOngkir(Request $request, $districts_id){
        return Ongkir::where('district_id', $districts_id)->get();
    }

}
