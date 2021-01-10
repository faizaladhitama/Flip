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
        try{
            $disbursement = DisbursementModel::where('disbursement_id', $disbursement_id)->first();
            return response()->json(array(
                'status' => 'success',
                'data' => $disbursement
            ), 200);
        }catch(Exception $e){
            return response()->json(array(
                'status' => 'error',
                'message' => $e->getMessage()
            ), 500);
        }
    }

    public function store(Request $request)
    {
        try{
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
                $disbursementModel->time_served = $disbursement->time_served;
            }

            $disbursementModel->fee = $disbursement->fee;

            $disbursementModel->save();

            return response()->json(array(
                'status' => 'success',
                'data' => $disbursement
            ), 201);
        }catch(Exception $e){
            return response()->json(array(
                'status' => 'error',
                'message' => $e->getMessage()
            ), 500);
        }
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
