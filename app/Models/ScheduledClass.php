<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduledClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'semester_id', 'subject_id', 'class_code', 'lecturer_id',
        'max_students', 'current_students', 'schedule_info', 'notes'
    ];

    public function semester(): BelongsTo { return $this->belongsTo(Semester::class); }
    public function subject(): BelongsTo { return $this->belongsTo(Subject::class); }
    public function lecturer(): BelongsTo { return $this->belongsTo(Lecturer::class); }
}