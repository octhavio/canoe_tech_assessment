<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Events\NewFundCreated;

use Illuminate\Http\Request;


/**
 * @group Funds
 * Fund query and update endpoints
 */

class FundController extends Controller
{
   /**
     * @queryParam name string Filter by fund name
     * @queryParam fund_manager_id integer Filter funds by manager id
     * @queryParam start_year integer Filter by fund start year
     * 
     */
    public function index(Request $request)
    {
        request()->validate([
            'name' => 'nullable|max:300',
            'fund_manager_id' => 'nullable|exists:fund_managers,id',
            'start_year' => 'nullable|integer|min:1900|max:2023',
        ]);

        $funds = Fund::latest();

        if ($request->name) {
            $funds->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if ($request->fund_manager_id) {
            $funds->where('fund_manager_id', $request->fund_manager_id);
        }

        if ($request->start_year) {
            $funds->where('start_year', $request->start_year);
        }

        return $funds->paginate(50);

    }
 /**
     * @bodyParam name string Update fund name
     * @bodyParam fund_manager_id integer Update fund manager id
     * @bodyParam start_year integer Update fund start year
     */
    public function update(Request $request, Fund $fund)
    {
        $data = request()->validate([
            'name' => 'nullable|max:300',
            'fund_manager_id' => 'nullable|exists:fund_managers,id',
            'start_year' => 'nullable|integer|min:1900|max:2023',
        ]);

        $fund->update($data);

        return $fund;

    }

 /**
     * @bodyParam name string Update fund name
     * @bodyParam fund_manager_id integer Update fund manager id
     * @bodyParam start_year integer Update fund start year
     */
    public function store(Request $request){
        $data = request()->validate([
            'name' => 'required|max:300',
            'fund_manager_id' => 'required|exists:fund_managers,id',
            'start_year' => 'required|integer|min:1900|max:2023',
        ]);

        $fund = Fund::create($data);

        try {
            NewFundCreated::dispatch($fund);
        } catch (\Throwable $th) {
            throw $th;
        }


        return $fund;

    }
}
