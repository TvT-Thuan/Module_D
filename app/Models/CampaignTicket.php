<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignTicket extends Model
{
    use HasFactory;
    public $timestamps = false;
    //các giá trị được phép thêm
    protected $fillable = [
        'campaign_id', 'name', 'cost', 'special_validity',
    ];

    // sử lý kiểu dữ liệu của cột special_validity định dạng gốc null | ['type' = 'date|amount'; 'date|amount' = 'date|number']
    public function getFormatSpecialValidityAttribute()
    {
        if ($this->special_validity != null) { //kiểm tra cột có phải là trống ?
            if ($this->special_validity['type'] == 'date') { //kiểm tra type date hay amount
                //nối chuỗi và format lại data type date
                if (strlen($this->special_validity['date']) == 10) {
                    return "Available untill " . Carbon::createFromFormat('Y-m-d', $this->special_validity['date'])->format('M d, Y');
                }
                return "Available untill " . Carbon::createFromFormat('Y-m-d H:i', $this->special_validity['date'])->format('M d, Y');
            };
            //nối chuỗi với data type number
            return $this->special_validity['amount'] . " tickets available";
        }
        return '&nbsp;';
    }

    public function setSpecialValidityAttribute($values)
    {
        $array = [];
        if (isset($values['amount'])) {
            $array['type'] = 'amount';
            $array['amount'] = $values['amount'];
        }
        if (isset($values['valid_until'])) {
            $array['type'] = 'date';
            $array['date'] = $values['valid_until'];
        }
        if (empty($array)) {
            $this->attributes['special_validity'] = null;
        } else {
            $this->attributes['special_validity'] = json_encode($array);
        }
    }

    public static function handleStoreCreateTicket($request, $id)
    {
        $validated = $request->safe()->only('name', 'cost');
        $validated['campaign_id'] = $id;
        $validated['special_validity'] = $request->validated();
        CampaignTicket::create($validated);
    }

    public function Campaign(){
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function Registration()
    {
        return $this->hasMany(Registration::class, 'ticket_id');
    }
    // check available ticket
    public function getAvailableTicketAttribute()
    {
        if($this->special_validity['amount'] > $this->Registration->count()){
            return true;
        }
        return false;
        // $quantity = explode(' ', $this->format_specialvalidity);
        // if ((int)$quantity[0] > $this->Registration->count()) {
        //     return true;
        // };
        // return false;
    }

    public function getAvailableDateAttribute()
    {
        if (strlen($this->special_validity['date']) == 10) {
            $date = Carbon::createFromFormat('Y-m-d', $this->special_validity['date']);
        }
        else{
            $date = Carbon::createFromFormat('Y-m-d H:i', $this->special_validity['date']);
        }
        if($date->diffInSeconds() > 0){
            return false;
        }
        return true;
        // $date = Carbon::createFromFormat('M d, Y', substr($this->format_specialvalidity, 17));
        // if ($date->diffInSeconds() > 0) {
        //     return false;
        // };
        // return true;
    }

    // định dạng kiểu dữ liệu mặc định cho giá trị
    protected $casts = [
        'special_validity' => 'array',
        'cost' => 'integer'
    ];
}
