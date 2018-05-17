<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Auth;

class Note extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    public $fillable = [
    	'title',
    	'details',
    	'user_id'
    ];

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'details' => 'max:500'
        ];
    }

    public function updateRules()
    {
        return [
            'title' => 'required|max:100',
            'details' => 'max:500',
            'note' => 'required|exists:notes,id'
        ];
    }

    public function setDetailsAttribute($value)
    {
        $this->attributes['details'] = Crypt::encryptString($value);
    }

    public function getDetailsAttribute($value)
    {
        if(Auth::user()->id == $this->user_id)
            return Crypt::decryptString($value);
        else
            return $value;

    }

    public function existRules()
    {
        return [
            'note' => 'required|exists:notes,id'
        ];
    }

    public function scopeSelfAsOwner($query)
    {
        $query->where('user_id', '=', Auth::user()->id );
    }

    public function owner()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
