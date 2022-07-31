<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\ParnetResources;
use App\Models\ParentBaby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParnetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bepartner(Request $request)
    {
        if ($request->partner_id == Auth::user()->id) {
            return response()->json(['message'=>"you can't add yourself as a partner"],403);

        }

        Auth::user()->partners()->sync($request->partner_id);
        return response()->json(['message'=>'success'],200);
    }


    public function index()
    {
        return ParnetResources::collection(ParentBaby::paginate(5));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|max:255'
        ]);
        $parent = ParentBaby::create($data);

        return response()->json(['message'=>'Parent Successfully added','data'=>$parent], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent = ParentBaby::findOrfail($id);
        return new ParnetResources($parent);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $parent = ParentBaby::findOrfail($id);

        $data = $request->validate([
            'name'=>'required|max:255'
        ]);
        $parent->update($data);

        return response()->json(['message'=>'Parent Successfully updated','data'=>$parent], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = ParentBaby::findOrfail($id);

        $parent->delete();

        return response()->json(['message'=>'Parent Successfully deleted'], 200);
    }
}
