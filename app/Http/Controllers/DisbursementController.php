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

    public function show(Disbursement $disbursement)
    {
        return $disbursement;
    }

    public function store(Request $request)
    {
        $disbursement = Disbursement::create($request->all());

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
