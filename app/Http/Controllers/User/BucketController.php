<?php

namespace App\Http\Controllers\User;

use App\utilities\TokenMgmt;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\BucketRequest;
use App\Models\Bucket;
use App\Models\Category;
use App\Transformers\User\BucketTransformer;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;

class BucketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = TokenMgmt::getUserObject($request);
        $buckets = $user->buckets()->where('status', 'active')->get();
        return fractal()
        ->serializeWith(new ArraySerializer())
        ->collection($buckets)
        ->transformWith(new BucketTransformer())
        ->respond();
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
    public function store(BucketRequest $request)
    {
        $user = TokenMgmt::getUserObject($request);
        $bucket = $user->buckets()->create($request->all());
        $category = Category::query()->where('name', $request['category'])->first();
        $bucket->categories()->attach($category->id);
        return response()->json(['error' => true, 
        'message' => 'Bucket Created Successfully!', 'bucket' => $bucket], 200);    
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
    public function destroy(Request $request, $bucket_id)
    {
        $user = TokenMgmt::getUserObject($request);
        $bucket = Bucket::query()->find($request->bucket_id);
        $bucket->update(['status' => 'deleted']);
        return response()->json(['error' => true, 
        'message' => 'Bucket Deleted Successfully!'], 200);
    }
}
