<?php

namespace App\Http\Controllers\dashboard;

use Exception;
use Illuminate\Http\Request;
use App\Models\dashboard\Admin;
use App\Models\dashboard\Invoice;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Upload_Images;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\dashboard\InvoiceImage;
use App\Models\dashboard\InvoiceSteps;
use App\Models\dashboard\ProblemCategory;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
// use Intervention\Image\Facades\Image;
class InvoiceController extends Controller
{
    use Message_Trait;
    use Upload_Images;

    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->paginate(10);
        $techs = Admin::where('type', 'فني')->get();
        return view('dashboard.invoices.index', compact('invoices', 'techs'));
    }

    public function create(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $data = $request->all();
                //dd($data);
                $rules = [
                    'name' => 'required',
                    'phone' => 'required',
                    'title' => 'required',
                    'problems' => 'required',
                    'description' => 'required',
                    'price' => 'required',
                    'date_delivery' => 'required',
                    'time_delivery' => 'required',
                    'status' => 'required',
                    'signature' => 'required', // إضافة التوقيع
                ];
                $messages = [
                    'name.required' => 'من فضلك ادخل اسم العميل ',
                    'phone.required' => 'من فضلك ادخل رقم الهاتف ',
                    'title.required' => 'من فضلك ادخل عنوان الفاتورة ',
                    'problems.required' => 'من فضلك ادخل المشاكل ',
                    'description.required' => 'من فضلك ادخل الوصف ',
                    'price.required' => 'من فضلك ادخل السعر ',
                    'date_delivery.required' => 'من فضلك ادخل تاريخ الاستلام ',
                    'time_delivery.required' => 'من فضلك ادخل وقت الاستلام ',
                    'status.required' => 'من فضلك ادخل حالة الفاتورة ',
                    'signature.required' => 'يرجى توقيع الفاتورة قبل الحفظ.',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                DB::beginTransaction();
                $invoice = new Invoice();
                $invoice->invoice_number = 1;
                $invoice->name = $data['name'];
                $invoice->phone = $data['phone'];
                $invoice->title = $data['title'];
                $invoice->problems = json_encode($data['problems']);
                $invoice->description = $data['description'];
                $invoice->price = $data['price'];
                $invoice->date_delivery = $data['date_delivery'];
                $invoice->time_delivery = $data['time_delivery'];
                $invoice->status = $data['status'];
                $invoice->admin_recieved_id = Auth::id();
                // حفظ التوقيع
                if ($request->has('signature')) {
                    $signatureData = $request->input('signature');

                    // إزالة رأس الـ Data URL
                    $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
                    $signatureData = base64_decode($signatureData);

                    // إنشاء اسم الملف بشكل فريد
                    $filename = 'signature_' . time() . '.png';

                    // مسار حفظ الصورة
                    $path = public_path('assets/uploads/invoices_files/' . $filename);

                    // استخدام Intervention Image لحفظ الصورة
                    //    $image = Image::make($signatureData);
                    // $image = Image::make($signatureData);
                    // $image->save($path);
                }

                $invoice->signature = 'assets/uploads/invoices_files/' . $filename;
                $invoice->save();
                ############ Start Insert Files ################
                if ($request->hasFile('files')) {
                    $files = $request->file('files');
                    foreach ($files as $file) {
                        $filename = $this->saveImage($file, public_path('assets/uploads/invoices_files'));
                        $invoice_image = new InvoiceImage();
                        $invoice_image->invoice_id = $invoice->id;
                        $invoice_image->image = $filename;
                        $invoice_image->user_upload = Auth::id();
                        $invoice_image->save();
                    }
                }
                ############# Add Invoice Step ###############
                $invoice_step = new InvoiceSteps();
                $invoice_step->invoice_id = $invoice->id;
                $invoice_step->admin_id = Auth::id();
                $invoice_step->step_details = ' تم اضافة الفاتورة  ';
                $invoice_step->save();
                DB::commit();
                return $this->success_message(' تم اضافة الفاتورة بنجاح');
            }
        } catch (Exception $e) {
            return $this->exception_message($e);
        }
        $problems = ProblemCategory::all();
        return view('dashboard.invoices.create', compact('problems'));
    }

    public function update(Request $request, $id)
    {
        try {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'name' => 'required',
                    'phone' => 'required',
                    'title' => 'required',
                    'problems' => 'required',
                    'description' => 'required',
                    'price' => 'required',
                    'date_delivery' => 'required',
                    'time_delivery' => 'required',
                    'status' => 'required',

                ];
                $messages = [
                    'name.required' => 'من فضلك ادخل اسم العميل ',
                    'phone.required' => 'من فضلك ادخل رقم الهاتف ',
                    'title.required' => 'من فضلك ادخل عنوان الفاتورة ',
                    'problems.required' => 'من فضلك ادخل المشاكل ',
                    'description.required' => 'من فضلك ادخل الوصف ',
                    'price.required' => 'من فضلك ادخل السعر ',
                    'date_delivery.required' => 'من فضلك ادخل تاريخ الاستلام ',
                    'time_delivery.required' => 'من فضلك ادخل وقت الاستلام ',
                    'status.required' => 'من فضلك ادخل حالة الفاتورة ',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                DB::beginTransaction();
                $invoice = Invoice::find($id);
                $invoice->name = $data['name'];
                $invoice->phone = $data['phone'];
                $invoice->title = $data['title'];
                $invoice->problems = json_encode($data['problems']);
                $invoice->description = $data['description'];
                $invoice->price = $data['price'];
                $invoice->date_delivery = $data['date_delivery'];
                $invoice->time_delivery = $data['time_delivery'];
                $invoice->status = $data['status'];
                $invoice->save();
                ############ Start Insert Files ################
                if ($request->hasFile('files')) {
                    $files = $request->file('files');
                    foreach ($files as $file) {
                        $filename = $this->saveImage($file, public_path('assets/uploads/invoices_files'));
                        $invoice_image = new InvoiceImage();
                        $invoice_image->invoice_id = $invoice->id;
                        $invoice_image->image = $filename;
                        $invoice_image->user_upload = Auth::id();
                        $invoice_image->save();
                    }
                }
                ############# Add Invoice Step ###############
                $invoice_step = new InvoiceSteps();
                $invoice_step->invoice_id = $invoice->id;
                $invoice_step->admin_id = Auth::id();
                $invoice_step->step_details = ' تم تعديل الفاتورة  ';
                $invoice_step->save();
                DB::commit();
                return $this->success_message(' تم تعديل الفاتورة بنجاح');
            }
        } catch (Exception $e) {
            return $this->exception_message($e);
        }
        $invoice = Invoice::find($id);
        $problems = ProblemCategory::all();
        return view('dashboard.invoices.update', compact('invoice', 'problems'));
    }
    public function destroy($id)
    {
        try {
            $invoice = Invoice::find($id);
            ////////// Delete Files
            $files = InvoiceImage::where('invoice_id', $id)->get();
            foreach ($files as $file) {
                @unlink(public_path('assets/uploads/invoices_files/' . $file->image));
                $file->delete();
            }
            $invoice->delete();
            return $this->success_message(' تم حذف الفاتورة بنجاح');
        } catch (Exception $e) {
            return $this->exception_message($e);
        }
    }

    public function delete_file($id)
    {
        try {
            $file = InvoiceImage::find($id);
            @unlink(public_path('assets/uploads/invoices_files/' . $file->image));
            $file->delete();
            return $this->success_message(' تم حذف الملف بنجاح');
        } catch (Exception $e) {
            return $this->exception_message($e);
        }
    }

    public function print($id)
    {
        $invoice = Invoice::find($id);
        return view('dashboard.invoices.print', compact('invoice'));
    }

    public function steps($id)
    {
        $steps = InvoiceSteps::where('invoice_id', $id)->get();
        $invoice = Invoice::find($id);
        return view('dashboard.invoices.steps', compact('steps', 'invoice'));
    }

    public function add_tech(Request $reques, $id)
    {
        DB::beginTransaction();
        $invoice = Invoice::find($id);
        $invoice->admin_repair_id = $reques->admin_repair_id;
        $invoice->status = 'تحت الصيانة';
        $invoice->checkout_time = now();
        $invoice->save();
        ############# Add Invoice Step ###############
        $invoice_step = new InvoiceSteps();
        $invoice_step->invoice_id = $invoice->id;
        $invoice_step->admin_id = Auth::id();
        $invoice_step->step_details = ' تم تعين فني من جانب المدير  ';
        $invoice_step->save();
        DB::commit();
        return $this->success_message('تم تعين فني من جانب المدير  بنجاح');

    }
}
