<?php

namespace OrlandoLibardi\PageBuildCms\app;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'content', 'status', 'meta_title', 'meta_description', 'meta_image'
    ];
    /**
    * Date updated_at Accessor
    */   
    public function getUpdatedAtAttribute($value)
    {
        if($value) return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
    /**
    * Date created_at Accessor
    */   
    public function getCreatedAtAttribute($value)
    {
        if($value) return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
    /**
    * Scope Status
    */
    public function scopeStatus($q){
        return $q->where('status', 1);
    }
    /**
    * Scope Alias
    */    
    public function scopeAlias($q, $alias){
        return $q->status()->where('alias', '=', $alias);
    }
}
?>