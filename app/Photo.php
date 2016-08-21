<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    /**
     * The associated table.
     * 
     * @var string
     */
    protected $table = 'flyer_photos';

    /**
     * Fillable fields for a Photo.
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
        'thumbnail_path'
    ];

    /**
     * A Photo belongs to a Flyer.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    /**
     * Get the base directory for photo uploads.
     * 
     * @return string
     */
    public function baseDir()
    {
        return 'images/flyers';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() .'/'. $name;
        $this->thumbnail_path = $this->baseDir() .'/tn-'. $name;
    }

    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }
}
