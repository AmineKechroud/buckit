<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $due_date
 * @property string $status
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property Category[] $categories
 * @property BucketItem[] $bucketItems
 */
class Bucket extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bucket';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'user_id', 'due_date', 'status', 'image', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bucketItems()
    {
        return $this->hasMany('App\Models\BucketItem');
    }
}
