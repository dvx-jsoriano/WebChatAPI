<?php

namespace App\Http\Controllers;

use App\Http\Resources\Agent as ResourcesAgent;
use App\Models\Agent;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            $agent = Agent::query();

            // Without this initial where refactor, the search filter doesn't work.
            if ($request->has('active'))
                $agent->where('active', $request->active);
            else
                $agent->where('active', 1);

            // Filtering name from search keyword
            if ($request->has('search_name')) {
                $agent->where(function ($agent_query) use ($request) {
                    $agent_query->where('agent_handle', 'like', '%' . $request->search_name . '%')
                        ->orWhere('agent_first', 'like', '%' . $request->search_name . '%')
                        ->orWhere('agent_last', 'like', '%' . $request->search_name . '%');
                });
            }

            //Filtering type
            if ($request->has('type'))
                $agent->where('agent_type', strtoupper($request->type));

            //Filtering status
            if ($request->has('status'))
                $agent->where('status', strtoupper($request->status));

            //Execute the select query built by refactoring
            $agents = $agent->get();
            return ResourcesAgent::collection($agents);
        } catch (Exception $ex) {
            Log::error('Agents - index', [$ex->getMessage()]);
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
        try {

            // Validate requests
            $validator = Validator::make($request->all(), [
                'agent_username' => 'required|min:8|max:20',
                'agent_password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                // get first error message
                $error = $validator->errors()->first();
                return response()->json(['status' => $error], 422);
            }

            // Collect names and combine
            $first = (string) $request->name_first;
            $last = (string) $request->name_last;
            //$name = $first . " " . $last;

            // Double check Email input if it is existing.
            $result = Agent::where('agent_username', (string) $request->username)->first();
            if ($result) return response()->json(['status' => 'Username already exists.'], 403);

            $agent = Agent::create([
                'agent_username' => (string) $request->username,
                'agent_password' => Hash::make($request->password),
                'agent_handle' => ucfirst($request->handle),
                'agent_first' => ucfirst($first),
                'agent_last' => ucfirst($last),
                'agent_type' => (string) $request->type,
                'agent_maxchat' => (string) $request->max_chat,
            ]);

            return new ResourcesAgent($agent);
        } catch (Exception $ex) {
            Log::error('adding agent.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 400);
        } catch (ModelNotFoundException $ex) {
            Log::error('adding agent.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $result = Agent::findOrFail($id);
            //If found return the result
            return new ResourcesAgent($result);
        } catch (ModelNotFoundException $ex) {
            Log::error('retrieving an agent.', [$ex->getMessage()]);
            return response()->json(['status' => 'Agent not found.'], 404);
        } catch (Exception $ex) {
            Log::error('retrieving an agent.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        try {

            // Validate requests
            $validator = Validator::make($request->all(), [
                'agent_handle' => 'min:2|max:50',
                'agent_first' => 'min:2|max:50',
                'agent_last' => 'min:2|max:50',
            ]);

            if ($validator->fails()) {
                // get first error message
                $error = $validator->errors()->first();
                return response()->json(['status' => $error], 422);
            }

            // Search if username was already used by other agents
            $found = Agent::where('agent_username', $request->agent_username)->where('id', '!=', $agent->id)->first();

            if (!$found) {
                $agent->update($request->only([
                    'agent_username',
                    'agent_password',
                    'agent_handle',
                    'agent_first',
                    'agent_last',
                    'agent_type',
                    'agent_maxchat',
                ]));

                return new ResourcesAgent($agent);
            } else {
                Log::warning('email exists.', [$found]);
                return response()->json(['status' => 'Email already in use.'], 403);
            }
        } catch (Exception $ex) {
            Log::error('updating agent.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 500);
        }
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
