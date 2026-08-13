<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
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
}
