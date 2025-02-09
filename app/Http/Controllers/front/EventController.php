<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Models\dashboard\Eventtype;
use App\Http\Controllers\Controller;
use App\Models\dashboard\Event;
use Carbon\Carbon;
class EventController extends Controller
{
    public function event($slug)
    {
        $event_type = Eventtype::where('slug', $slug)->first();
        $type_id = $event_type->id;

        $events = Event::where('event_type_id', $type_id)
            ->orderBy('event_start_month', 'asc')
            ->orderBy('event_start_day', 'asc')->
            get()->map(function ($event) {
                // تنظيف الوقت من المسافات الزائدة
                $start_time = trim($event->event_start_time);
                $end_time = trim($event->event_end_time);

                // تحويل الوقت إلى صيغة 12 ساعة مع صباحًا/مساءً
                try {
                    $event->formatted_start_time = Carbon::createFromFormat('h:iA', $start_time)
                        ->locale('ar')
                        ->translatedFormat('h:i') . (strpos($start_time, 'AM') !== false ? ' صباحًا' : ' مساءً');
                } catch (\Exception $e) {
                    $event->formatted_start_time = 'وقت غير صحيح';
                }

                try {
                    $event->formatted_end_time = Carbon::createFromFormat('h:iA', $end_time)
                        ->locale('ar')
                        ->translatedFormat('h:i') . (strpos($end_time, 'AM') !== false ? ' صباحًا' : ' مساءً');
                } catch (\Exception $e) {
                    $event->formatted_end_time = 'وقت غير صحيح';
                }

                return $event;
            });

        return view('front.event', compact('event_type', 'events'));
    }
}
