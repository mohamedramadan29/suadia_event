<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Traits\Slug_Trait;
use App\Models\dashboard\Event;
use App\Models\dashboard\Collage;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\dashboard\Eventtype;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class EventController extends Controller
{
    use Message_Trait;
    use Slug_Trait;
    use Upload_Images;
    public function index()
    {
        if (Auth::guard('admin')->user()->type != 'admin') {
            $events = Event::where('collage_id', Auth::guard('admin')->user()->collage_id)->orderBy('id', 'desc')->paginate(12);
        } else {
            $events = Event::orderBy('id', 'desc')->paginate(12);
        }
        return view("dashboard.events.index", compact('events'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'collage_id' => 'required',
                'event_name' => 'required',
                'event_location' => 'required',
                'event_start_month' => 'required',
                'event_start_day' => 'required',
                'event_start_time' => 'required',
                'event_end_month' => 'required',
                'event_end_day' => 'required',
                'event_end_time' => 'required',
                'event_type_id' => 'required',
                'event_status' => 'required',
            ];
            $messages = [
                'collage_id.required' => ' من فضلك حدد الكلية  ',
                'event_name.required' => ' من فضلك ادخل اسم الحدث  ',
                'event_location.required' => ' من فضلك ادخل مكان الحدث  ',
                'event_start_month.required' => ' من فضلك ادخل شهر بداية الحدث  ',
                'event_start_day.required' => ' من فضلك ادخل يوم بداية الحدث  ',
                'event_start_time.required' => ' من فضلك ادخل وقت بداية الحدث  ',
                'event_end_month.required' => ' من فضلك ادخل شهر نهاية الحدث  ',
                'event_end_day.required' => ' من فضلك ادخل يوم نهاية الحدث  ',
                'event_end_time.required' => ' من فضلك ادخل وقت نهاية الحدث  ',
                'event_type_id.required' => ' من فضلك حدد نوع الحدث  ',
                'event_status.required' => ' من فضلك حدد حالة الحدث  ',
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->hasFile('event_image') && $request->file('event_image')->isValid()) {
                $event_image = $this->saveImage($request->file('event_image'), public_path('assets/uploads/events'));
            }
            $event = new Event();
            $event->collage_id = $data['collage_id'];
            $event->event_name = $data['event_name'];
            $event->event_slug = $this->CustomeSlug($data['event_name']);
            $event->event_location = $data['event_location'];
            $event->event_start_month = $data['event_start_month'];
            //$event->event_start_day = $data['event_start_day'];
            $event->event_start_day = Carbon::parse($data['event_start_day'])->format('d-M, Y');
           // $event->event_start_time = $data['event_start_time'];
            $event->event_start_time = Carbon::parse($data['event_start_time'])->format('h:iA');
            $event->event_end_month = $data['event_end_month'];
          //  $event->event_end_day = $data['event_end_day'];
            $event->event_end_day = Carbon::parse($data['event_end_day'])->format('d-M, Y');
           // $event->event_end_time = $data['event_end_time'];
            $event->event_end_time = Carbon::parse($data['event_end_time'])->format('h:iA');

            $event->event_type_id = $data['event_type_id'];
            $event->event_status = $data['event_status'];
            $event->event_image = $event_image;
            $event->save();
            return $this->success_message(' تم اضافة الحدث بنجاح');
        }
        if (Auth::guard('admin')->user()->type != 'admin') {
            $collages = Collage::where('id', Auth::guard('admin')->user()->collage_id)->get();
        } else {
            $collages = Collage::all();
        }

        $types = Eventtype::all();
        return view('dashboard.events.store', compact('collages', 'types'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        if (Auth::guard('admin')->user()->type != 'admin') {
            $collages = Collage::where('id', Auth::guard('admin')->user()->collage_id)->get();
        } else {
            $collages = Collage::all();
        }

        $types = Eventtype::all();
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'collage_id' => 'required',
                'event_name' => 'required',
                'event_location' => 'required',
                'event_start_month' => 'required',
                'event_start_day' => 'required',
                'event_start_time' => 'required',
                'event_end_month' => 'required',
                'event_end_day' => 'required',
                'event_end_time' => 'required',
                'event_type_id' => 'required',
                'event_status' => 'required',
            ];
            $messages = [
                'collage_id.required' => ' من فضلك حدد الكلية  ',
                'event_name.required' => ' من فضلك ادخل اسم الحدث  ',
                'event_location.required' => ' من فضلك ادخل مكان الحدث  ',
                'event_start_month.required' => ' من فضلك ادخل شهر بداية الحدث  ',
                'event_start_day.required' => ' من فضلك ادخل يوم بداية الحدث  ',
                'event_start_time.required' => ' من فضلك ادخل وقت بداية الحدث  ',
                'event_end_month.required' => ' من فضلك ادخل شهر نهاية الحدث  ',
                'event_end_day.required' => ' من فضلك ادخل يوم نهاية الحدث  ',
                'event_end_time.required' => ' من فضلك ادخل وقت نهاية الحدث  ',
                'event_type_id.required' => ' من فضلك حدد نوع الحدث  ',
                'event_status.required' => ' من فضلك حدد حالة الحدث  ',
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->hasFile('event_image') && $request->file('event_image')->isValid()) {
                #### Delete old image
                $old_image = public_path('assets/uploads/events/' . $event->event_image);
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
                $event_image = $this->saveImage($request->file('event_image'), public_path('assets/uploads/events'));
                $event->update([
                    'event_image' => $event_image
                ]);
            }
            $event->collage_id = $data['collage_id'];
            $event->event_name = $data['event_name'];
            $event->event_slug = $this->CustomeSlug($data['event_name']);
            $event->event_location = $data['event_location'];
            $event->event_start_month = $data['event_start_month'];
            $event->event_start_day = Carbon::parse($data['event_start_day'])->format('d-M, Y');
            $event->event_start_time = Carbon::parse($data['event_start_time'])->format('h:iA');
            $event->event_end_month = $data['event_end_month'];
            $event->event_end_day = Carbon::parse($data['event_end_day'])->format('d-M, Y');
            $event->event_end_time = Carbon::parse($data['event_end_time'])->format('h:iA');
            $event->event_type_id = $data['event_type_id'];
            $event->event_status = $data['event_status'];
            //$event->event_image = $event_image;
            $event->save();
            return $this->success_message(' تم تعديل الحدث بنجاح');
        }
        return view('dashboard.events.update', compact('event', 'collages', 'types'));
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return $this->success_message('تم حذف الحدث بنجاح');
    }


}
