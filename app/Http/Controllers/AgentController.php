<?php

namespace App\Http\Controllers;

use App\Http\Resources\Agent as ResourcesAgent;
use App\Models\Agent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AgentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show', 'store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            // Without this initial where refactor, the search filter doesn't work.
            $agent = Agent::where('id', '>', 0);

            // Filtering name from search keyword
            if ($request->has('search_name')) {
                $agent->where('name', 'like', '%' . $request->search_name . '%');
            }
            $agents = $agent->get();
            return ResourcesAgent::collection($agents);
        } catch (Exception $ex) {
            Log::error('Users - index', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
