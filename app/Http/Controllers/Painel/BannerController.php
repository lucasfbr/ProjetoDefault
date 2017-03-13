<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;

class BannerController extends Controller
{
    public function update(Request $request, $id){

       $banner = Banner::find($id);

       $banner->status = '1';

       if($banner->update()){
           $data = 'Banner ' . $id . ' atualizado';
       }else{
           $data = 'Erro ao atualizar o banner ' . $id;
       }

        return response()->json($data);

    }
}
