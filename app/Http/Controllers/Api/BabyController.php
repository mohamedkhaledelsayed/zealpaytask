<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\BabyResource;
use App\Models\Baby;
use App\Models\ParentBaby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BabyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentids =Auth::user()->partners->pluck('id')->toArray();
        array_push($parentids, Auth::user()->id);

        return BabyResource::collection(Baby::whereIn('parent_id', $parentids)->paginate(10));

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

        $request->validate([
            'name'=>'required|max:255',
        ]);
        $baby = Baby::create(['name'=>$request->name,'parent_id'=>Auth::user()->id]);
        return response()->json(['message'=>'Baby Successfully added','data'=>$baby], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Baby  $baby
     * @return \Illuminate\Http\Response
     */
    public function show(Baby $baby)
    {
        $parentids =Auth::user()->partners->pluck('id')->toArray();
        array_push($parentids, Auth::user()->id);
        if(in_array($baby->parent_id, $parentids)){
            return new BabyResource($baby);
        }
        return response()->json(['message' => 'This is not your baby'], 403);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Baby  $baby
     * @return \Illuminate\Http\Response
     */
    public function edit(Baby $baby)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Baby  $baby
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $baby = Baby::findOrfail($id);

        $data = $request->validate([
            'name'=>'required|max:255'
        ]);
        $baby->update($data);

        return response()->json(['message'=>'Baby Successfully updated','data'=>$baby], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Baby  $baby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Baby $baby)
    {

        if($baby->parent_id == Auth::user()->id){
            $baby->delete();
            return response()->json(['message' => 'Deleted Success'], 200);
        }
        return response()->json(['message' => 'This is not your baby'], 403);
    }
}
