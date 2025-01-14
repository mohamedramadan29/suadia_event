<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\dashboard\Invoice;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Upload_Images;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\dashboard\InvoiceImage;
use App\Models\dashboard\ProblemCategory;
use Exception;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    use Message_Trait;
    use Upload_Images;

    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.invoices.index', compact('invoices'));
    }

    public function create(Request $request)
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
                DB::commit();
                return $this->success_message(' تم اضافة الفاتورة بنجاح');
            }
        } catch (Exception $e) {
            return $this->exception_message($e);
        }
        $problems = ProblemCategory::all();
        return view('dashboard.invoices.create', compact('problems'));
    }

    public function destroy($id)
    {
        try {
            $invoice = Invoice::find($id);
            ////////// Delete Files
            $files = InvoiceImage::where('invoice_id', $id)->get();
            foreach ($files as $file) {
                unlink(public_path('assets/uploads/invoices_files/' . $file->image));
                $file->delete();
            }
            $invoice->delete();
            return $this->success_message(' تم حذف الفاتورة بنجاح');
        } catch (Exception $e) {
            return $this->exception_message($e);
        }
    }
}
