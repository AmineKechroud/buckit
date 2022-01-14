<?php

namespace App\Transformers\User;

use App\Models\BucketItem;
use League\Fractal\TransformerAbstract;

class BucketItemTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
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
    public function transform(BucketItem $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'image' => $item->image,
            'due_date' => $item->image,
            'created_at' => $item->created_id,
            'updated_at' => $item->updated_at,
            'is_done' => $item->is_done
        ];
    }
}
