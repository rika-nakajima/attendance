<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'user_id',
        'date',
        'clock_in',
        'clock_out',
        'status',
        'note',
    ];
    // ▼ 休憩時間リレーション（必須）
    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}
