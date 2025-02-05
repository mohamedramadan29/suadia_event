<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\Message_Trait;
use App\Models\dashboard\CheckText;

class CheckTextController extends Controller
{
    use Message_Trait;
    public function index()
    {
        $problems = CheckText::all();
        return view('dashboard.checktext.index', compact('problems'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:check_texts,name',
        ]);
      
        CheckText::create(
            ['name' => $request->name]
        );
        return $this->success_message(' تم اضافة   بنجاح');
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $problem = CheckText::find($id);
        $problem->name = $data['name'];
        $problem->save();
        return $this->success_message(' تم تعديل   بنجاح');
    }

    public function destroy($id)
    {
        $problem = CheckText::find($id);

        $problem->delete();
        return $this->success_message(' تم حذف   بنجاح');
    }

}
