<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\dashboard\Collage;
use Illuminate\Http\Request;

class CollageController extends Controller
{
    use Message_Trait;
    public function index()
    {
        $collages = Collage::orderBy('id','desc')->paginate(12);
        return view("dashboard.collages.index",compact('collages'));
    }

    public function create(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            $collage = new Collage();
            $collage->name = $data['name'];
            $collage->type = $data['type'];
            $collage->building = $data['building'];
            $collage->save();
            return $this->success_message(' تم اضافة الكلية  بنجاح');
        }
        return view('dashboard.collages.store');
    }

    public function update(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            $collage = Collage::find($request->id);
            $collage->name = $data['name'];
            $collage->type = $data['type'];
            $collage->building = $data['building'];
            $collage->save();
            return $this->success_message(' تم تعديل الكلية  بنجاح');
        }
        $collage = Collage::find($request->id);
        return view('dashboard.collages.update',compact('collage'));
    }

    public function destroy($id){
        $collage = Collage::find($id);
        $collage->delete();
        return $this->success_message(' تم حذف الكلية  بنجاح');
    }
}
