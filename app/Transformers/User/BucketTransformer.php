<?php

namespace App\Transformers\User;

use App\Models\Bucket;
use App\Transformers\CategoryTransformer;
use League\Fractal\TransformerAbstract;

class BucketTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'items', 'categories'
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Bucket $bucket)
    {
        return [
            'id' => $bucket->id,
            'name' => $bucket->name,
            'description' => $bucket->description,
            'due_date' => $bucket->due_date,
            'image' => $bucket->image,
            'created_at' => $bucket->created_at,
            'updated_at' => $bucket->updated_at
        ];
    }

    public function includeItems(Bucket $bucket)
    {
        if($bucket->bucketItems)
        {
            $items = $bucket->bucketItems()->where('status','active')->get();
            return $this->collection($items, new BucketItemTransformer()); 
        }else{
            return null;
        }
    }

    public function includeCategories(Bucket $bucket)
    {
        if($bucket->categories())
        {
            $items = $bucket->categories()->where('status','active')->get();
            return $this->collection($items, new CategoryTransformer()); 
        }else{
            return null;
        }
    }
}
