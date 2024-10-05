<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class ConfigController extends Controller
{
    public function index(){
        $config=Config::find(1);
        return view('back.config.index',compact('config'));
    }

    public function update(Request $request){
        
        $config= Config::find(1);
        $config->title= $request->title;
        //Active'i null döndürüyor şimdilik izin ver
        $config->active = $request->active;
        $config->facebook= $request->facebook;
        $config->twitter= $request->twitter;
        $config->linkedin= $request->linkedin;
        $config->youtube= $request->youtube;
        $config->instagram= $request->instagram;
        $config->github= $request->github;

        if($request->hasFile('logo')){
            $logo = Str::of($request->title)->slug('-').'-logo'.'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'),$logo);
            $config->logo='uploads/'.$logo;
        }
        if($request->hasFile('favicon')){
            $favicon = Str::of($request->title)->slug('-').'-favicon'.'.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'),$favicon);
            $config->favicon='uploads/'.$favicon;
        }
        $config->save();
        toastr()->success('Başarıyla Güncellendi');
        return redirect()->back();

    }
}
