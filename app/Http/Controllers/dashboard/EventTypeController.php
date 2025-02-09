<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Slug_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\dashboard\Eventtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventTypeController extends Controller
{
    use Message_Trait;
    use Upload_Images;
    use Slug_Trait;
    public function index()
    {
        $types = Eventtype::orderBy('id', 'desc')->paginate(12);
        return view("dashboard.event_types.index", compact('types'));
    }
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'type_name' => 'required',
                'color' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ];
            $messages = [
                'type_name.required' => 'اسم النوع مطلوب',
                'color.required' => 'اللون مطلوب',
                'image.required' => 'صورة الايقون مطلوبة',
                'banner.required' => 'صورة البنر مطلوبة',
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $icon_image = $this->saveImage($request->file('image'), public_path('assets/uploads/event_icons'));
            }
            if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
                $banner_image = $this->saveImage($request->file('banner'), public_path('assets/uploads/event_banners'));

            }
            $type = new Eventtype();
            $type->type_name = $data['type_name'];
            $type->slug = $this->CustomeSlug($data['type_name']);
            $type->color = $data['color'];
            $type->image = $icon_image;
            $type->banner = $banner_image;
            $type->save();
            return $this->success_message(' تم اضافة النوع  بنجاح');
        }
        return view("dashboard.event_types.store");
    }


    public function update(Request $request, $id)
    {
        $type = Eventtype::find($id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'type_name' => 'required',
                'color' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'banner' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ];
            $messages = [
                'type_name.required' => 'اسم النوع مطلوب',
                'color.required' => 'اللون مطلوب',
                'image.required' => 'صورة الايقون مطلوبة',
                'banner.required' => 'صورة البنر مطلوبة',
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                ##### Delete old image
                $old_image = public_path('assets/uploads/event_icons/' . $type->image);
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
                $icon_image = $this->saveImage($request->file('image'), public_path('assets/uploads/event_icons'));

                $type->update([
                    'image' => $icon_image,
                ]);
            }
            if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
                ##### Delete old banner
                $old_banner = public_path('assets/uploads/event_banners/' . $type->banner);
                if (file_exists($old_banner)) {
                    @unlink($old_banner);
                }
                $banner_image = $this->saveImage($request->file('banner'), public_path('assets/uploads/event_banners'));
                $type->update([
                    'banner' => $banner_image,
                ]);
            }
            $type->type_name = $data['type_name'];
            $type->color = $data['color'];
            $type->save();
            return $this->success_message(' تم تعديل النوع  بنجاح');
        }
        return view("dashboard.event_types.update", compact('type'));
    }

    public function destroy($id)
    {
        $type = Eventtype::find($id);
        ##### Delete old image
        $old_image = public_path('assets/uploads/event_icons/' . $type->image);
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        ##### Delete old banner
        $old_banner = public_path('assets/uploads/event_banners/' . $type->banner);
        if (file_exists($old_banner)) {
            @unlink($old_banner);
        }
        $type->delete();
        return $this->success_message(' تم حذف النوع  بنجاح');
    }
}
