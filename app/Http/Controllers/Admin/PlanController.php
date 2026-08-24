<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function AllPlans()
    {
        $plan = Plan::latest()->get();

        return view('admin.backend.plan.all_plan', compact('plan'));
    }

    public function AddPlans()
    {
        return view('admin.backend.plan.add_plan');
    }

    public function StorePlans(Request $request)
    {
        Plan::create([
            'name' => $request->name,
            'knowledge_base' => $request->knowledge_base,
            'chat_bot' => $request->chat_bot,
            'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Plan Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.plans')->with($notification);
    }

    public function EditPlans($id)
    {
        $plan = Plan::find($id);
        return view('admin.backend.plan.edit_plan', compact('plan'));
    }

    public function UpdatePlans(Request $request)
    {

        $plan_id = $request->id;
        Plan::find($plan_id)->update([
            'name' => $request->name,
            'knowledge_base' => $request->knowledge_base,
            'chat_bot' => $request->chat_bot,
            'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Plan Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.plans')->with($notification);
    }

    public function DeletePlans($id) {
        Plan::find($id)->delete();

        $notification = array(
            'message' => 'Plan Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function AllOrders(){
        $orders = Transaction::with(['user','plan'])->get();
        return view('admin.backend.transaction.all_transaction',compact('orders'));

    }
}
