<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disbursement;
use App\Integration\SlightlyBig;
use Illuminate\Support\Facades\Log;
use App\Models\Disbursement as DisbursementModel;

class DisbursementController extends Controller
{
	public function index()
    {
        return Disbursement::all();
    }

    public function show(string $disbursement_id)
    {
        $disbursement = DisbursementModel::where('disbursement_id', $disbursement_id)->first();
        return $disbursement;
    }

    public function store(Request $request)
    {
        $slightlyBig = new SlightlyBig();
        $disbursement = $slightlyBig->sendDisbursement($request->all());

        $disbursementModel = new DisbursementModel;
        $disbursementModel->disbursement_id = $disbursement->id;
        $disbursementModel->amount = $disbursement->amount;
        $disbursementModel->status = $disbursement->status;
        $disbursementModel->disbursement_timestamp = $disbursement->timestamp;
        $disbursementModel->bank_code = $disbursement->bank_code;
        $disbursementModel->account_number = $disbursement->account_number;
        $disbursementModel->beneficiary_name = $disbursement->beneficiary_name;
        $disbursementModel->remark = $disbursement->remark;
        $disbursementModel->receipt = $disbursement->receipt;

        if($disbursement->time_served != '0000-00-00 00:00:00'){
            $disbursementModel->disbursement_time_served = $disbursement->time_served;
        }

        $disbursementModel->fee = $disbursement->fee;

        $disbursementModel->save();

        return response()->json($disbursement, 201);
    }

    public function update(Request $request, Disbursement $disbursement)
    {
        $disbursement->update($request->all());

        return response()->json($disbursement, 200);
    }

    public function delete(Disbursement $disbursement)
    {
        $disbursement->delete();

        return response()->json(null, 204);
    }

    public function view()
    {
		return view('view', []);
    }
}
