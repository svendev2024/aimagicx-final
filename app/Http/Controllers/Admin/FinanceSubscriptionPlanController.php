<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use DataTables;

class FinanceSubscriptionPlanController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubscriptionPlan::all()->sortByDesc("created_at");          
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>                                            
                                            <a href="'. route("admin.finance.plan.show", $row["id"] ). '"><i class="fa-solid fa-file-invoice-dollar table-action-buttons edit-action-button" title="View Plan"></i></a>
                                            <a href="'. route("admin.finance.plan.edit", $row["id"] ). '"><i class="fa-solid fa-file-pen table-action-buttons view-action-button" title="Update Plan"></i></a>
                                            <a class="deletePlanButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Plan"></i></a>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-status', function($row){
                        $custom_priority = '<span class="cell-box plan-'.strtolower($row["status"]).'">'.ucfirst($row["status"]).'</span>';
                        return $custom_priority;
                    })
                    ->addColumn('frequency', function($row){
                        $custom_status = '<span class="cell-box payment-'.strtolower($row["payment_frequency"]).'">'.ucfirst($row["payment_frequency"]).'</span>';
                        return $custom_status;
                    })
                    ->addColumn('custom-words', function($row){
                        $custom_storage = '<span class="font-weight-bold">'.number_format($row['words']).'</span>';
                        return $custom_storage;
                    })
                    ->addColumn('custom-images', function($row){
                        $custom_storage = '<span class="font-weight-bold">'.number_format($row['images']).'</span>';
                        return $custom_storage;
                    })
                    ->addColumn('custom-characters', function($row){
                        $custom_storage = '<span class="font-weight-bold">'.number_format($row['characters']).'</span>';
                        return $custom_storage;
                    })
                    ->addColumn('custom-minutes', function($row){
                        $custom_storage = '<span class="font-weight-bold">'.number_format($row['minutes']).'</span>';
                        return $custom_storage;
                    })
                    ->addColumn('custom-name', function($row){
                        $custom_name = '<span class="font-weight-bold">'.$row["plan_name"].'</span><br><span>'.$row["price"] . ' ' . $row["currency"].'</span>';
                        return $custom_name;
                    })
                    ->addColumn('custom-featured', function($row){
                        $icon = ($row['featured'] == true) ? '<i class="fa-solid fa-circle-check text-success fs-16"></i>' : '<i class="fa-solid fa-circle-xmark fs-16"></i>';
                        $custom_featured = '<span class="font-weight-bold">'.$icon.'</span>';
                        return $custom_featured;
                    })
                    ->addColumn('custom-image', function($row){
                        $icon = ($row['image_feature'] == true) ? '<i class="fa-solid fa-circle-check text-success fs-16"></i>' : '<i class="fa-solid fa-circle-xmark fs-16"></i>';
                        $custom_featured = '<span class="font-weight-bold">'.$icon.'</span>';
                        return $custom_featured;
                    })
                    ->addColumn('custom-free', function($row){
                        $icon = ($row['free'] == true) ? '<i class="fa-solid fa-circle-check text-success fs-16"></i>' : '<i class="fa-solid fa-circle-xmark fs-16"></i>';
                        $custom_featured = '<span class="font-weight-bold">'.$icon.'</span>';
                        return $custom_featured;
                    })
                    ->rawColumns(['actions', 'custom-status', 'created-on', 'frequency', 'custom-words', 'custom-name', 'custom-featured', 'custom-free', 'custom-image', 'custom-images', 'custom-characters', 'custom-minutes'])
                    ->make(true);
                    
        }

        return view('admin.finance.plans.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.finance.plans.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'plan-status' => 'required',
            'plan-name' => 'required',
            'cost' => 'required|numeric',
            'currency' => 'required',
            'words' => 'required|integer|min:0',
            'images' => 'required|integer|min:0',
            'characters' => 'required|integer|min:0',
            'minutes' => 'required|integer|min:0',
            'tokens' => 'required|integer|min:0',
            'frequency' => 'required',
            'image-feature' => 'required',
            'templates' => 'required'
        ]);

        $plan = new SubscriptionPlan([
            'paypal_gateway_plan_id' => request('paypal_gateway_plan_id'),
            'stripe_gateway_plan_id' => request('stripe_gateway_plan_id'),
            'paystack_gateway_plan_id' => request('paystack_gateway_plan_id'),
            'razorpay_gateway_plan_id' => request('razorpay_gateway_plan_id'),
            'flutterwave_gateway_plan_id' => request('flutterwave_gateway_plan_id'),
            'paddle_gateway_plan_id' => request('paddle_gateway_plan_id'),
            'status' => request('plan-status'),
            'plan_name' => request('plan-name'),
            'price' => request('cost'),
            'currency' => request('currency'),
            'free' => request('free-plan'),
            'image_feature' => request('image-feature'),
            'voiceover_feature' => request('voiceover-feature'),
            'transcribe_feature' => request('whisper-feature'),
            'chat_feature' => request('chat-feature'),
            'code_feature' => request('code-feature'),
            'templates' => request('templates'),
            'words' => request('words'),
            'chats' => request('chats'),
            'images' => request('images'),
            'payment_frequency' => request('frequency'),
            'primary_heading' => request('primary-heading'),
            'featured' => request('featured'),
            'plan_features' => request('features'),
            'max_tokens' => request('tokens'),
            'model' => request('model'),
            'team_members' => request('team-members'),
        ]); 
               
        $plan->save();            

        toastr()->success(__('New subscription plan has been created successfully'));
        return redirect()->route('admin.finance.plans');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionPlan $id)
    {
        return view('admin.finance.plans.show', compact('id'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionPlan $id)
    {
        return view('admin.finance.plans.edit', compact('id'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubscriptionPlan $id)
    {
        request()->validate([
            'plan-status' => 'required',
            'plan-name' => 'required',
            'cost' => 'required|numeric',
            'currency' => 'required',
            'words' => 'required|integer|min:0',
            'images' => 'required|integer|min:0',
            'frequency' => 'required',
        ]);

        $id->update([
            'paypal_gateway_plan_id' => request('paypal_gateway_plan_id'),
            'stripe_gateway_plan_id' => request('stripe_gateway_plan_id'),
            'paystack_gateway_plan_id' => request('paystack_gateway_plan_id'),
            'razorpay_gateway_plan_id' => request('razorpay_gateway_plan_id'),
            'flutterwave_gateway_plan_id' => request('flutterwave_gateway_plan_id'),
            'paddle_gateway_plan_id' => request('paddle_gateway_plan_id'),
            'status' => request('plan-status'),
            'plan_name' => request('plan-name'),
            'price' => request('cost'),
            'currency' => request('currency'),
            'free' => request('free-plan'),
            'words' => request('words'),
            'images' => request('images'),
            'characters' => request('characters'),
            'minutes' => request('minutes'),
            'payment_frequency' => request('frequency'),
            'primary_heading' => request('primary-heading'),
            'featured' => request('featured'),
            'plan_features' => request('features'),
            'image_feature' => request('image-feature'),
            'voiceover_feature' => request('voiceover-feature'),
            'transcribe_feature' => request('whisper-feature'),
            'chat_feature' => request('chat-feature'),
            'code_feature' => request('code-feature'),
            'templates' => request('templates'),
            'chats' => request('chats'),
            'max_tokens' => request('tokens'),
            'model' => request('model'),
            'team_members' => request('team-members'),
        ]); 
           
        toastr()->success(__('Selected plan has been updated successfully'));
        return redirect()->route('admin.finance.plans');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {

            $plan = SubscriptionPlan::find(request('id'));

            if($plan) {

                $plan->delete();

                return response()->json('success');

            } else{
                return response()->json('error');
            } 
        }
    }
}
