<?php

namespace App\Models;

use App\Enum\MessageReadOption;
use App\Traits\UUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory,UUID;
    protected $guarded = ['id'];
    protected $fillable = ['message','sender_id','recipient_id','read_option','expiry_at'];
    protected $casts = [
        'read_option' => MessageReadOption::class
    ];


    public function setExpiryAtAttribute($value){
        if(is_null($value)){
            $this->attributes['expiry_at'] = null;
        }else{
            $this->attributes['expiry_at'] = Carbon::parse($value);
        }
        
    }

    public function sender() : BelongsTo {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function recipient() : BelongsTo {
        return $this->belongsTo(User::class,'recipient_id');
    }
}
