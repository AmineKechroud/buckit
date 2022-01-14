<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $bucket_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $due_date
 * @property string $status
 * @property boolean $is_done
 * @property string $created_at
 * @property string $updated_at
 * @property Bucket $bucket
 */
class BucketItem extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bucket_item';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['bucket_id', 'name', 'description', 'image', 'due_date', 'status', 'is_done', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bucket()
    {
        return $this->belongsTo('App\Bucket');
    }
}
