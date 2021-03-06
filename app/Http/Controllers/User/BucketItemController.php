<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\BucketItemRequest;
use App\Models\Bucket;
use App\Models\BucketItem;
use App\utilities\TokenMgmt;
use Illuminate\Http\Request;

class BucketItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(BucketItemRequest $request)
    {
        //
        $user = TokenMgmt::getUserObject($request);
        $bucket = Bucket::query()->find($request->bucket_id);
        $item = $bucket->bucketItems()->create($request->all());
        return response()->json(['error' => true, 
        'message' => 'Item Added Successfully!', 'item' => $item], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $bucket_id)
    {
        $user = TokenMgmt::getUserObject($request);
        $bucket = Bucket::query()->find($bucket_id);
        $items = $bucket->bucketItems()->where('status', 'active')->get();
        return response()->json(['error' => true, 
        'data' => $items], 200);
    }

    public function toggle(Request $request, $item_id)
    {
        $user = TokenMgmt::getUserObject($request);
        $bucket = BucketItem::query()->find($item_id);
        if($bucket->is_done == true)
        {
            $items = $bucket->update(['is_done' => 0]);
            return response()->json(['error' => true, 
        'message' => 'Item marked not done'], 200);
        }else{
            $items = $bucket->update(['is_done' => 1]);
            return response()->json(['error' => true, 
        'message' => 'Item marked done'], 200);
        }
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $item_id)
    {
        $user = TokenMgmt::getUserObject($request);
        $bucket = BucketItem::query()->find($item_id);
        $items = $bucket->update(['status' => 'deleted']);
            return response()->json(['error' => true, 
        'message' => 'Item deleted'], 200);
    }
}
