<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disbursement;

class DisbursementController extends Controller
{
	public function index()
    {
        return Disbursement::all();
    }
 
    public function show($id)
    {
        return Disbursement::find($id);
    }

    public function store(Request $request)
    {
        return Disbursement::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Disbursement = Disbursement::findOrFail($id);
        $Disbursement->update($request->all());

        return $Disbursement;
    }

    public function delete(Request $request, $id)
    {
        $Disbursement = Disbursement::findOrFail($id);
        $Disbursement->delete();

        return 204;
    }
}
