<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EvaluationForm extends Model
{
    use HasFactory;
    
    protected $table = 'evaluation_forms';
    
    protected $fillable = [
        'teacher_id',
        'campus_id',
        'class_id',
        'section_id',
        'subject_id',
        'evaluation_date',
        'total_students',
        'appearance_dress_code',
        'lesson_plan',
        'standard_of_lesson_plan',
        'introduction_pk_testing',
        'islamization',
        'gesture_tone_body_language',
        'communication_skill',
        'strategies_activities',
        'discipline_class_control',
        'tools_av_aids',
        'tools_illustrative_material',
        'tools_writing_board',
        'real_life_integration',
        'competency_command_on_subject',
        'time_management',
        'evaluation_conclusion',
        'diary_hw_checking',
        'call_on_board',
        'knowledge_gain',
        'skill_gain_spoken',
        'skill_gain_written',
        'personality_trait_confidence',
        'response_of_previous_knowledge',
        'total_marks',
        'percentage',
        'observer_guidance',
        'teacher_views',
        'observer_name',
        'observer_signature',
    ];
    
    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'evaluation_date' => 'date',
        'total_marks' => 'integer',
        'percentage' => 'float',
    ];
    
    /**
     * Boot the model - automatically set evaluation_date on creation
     */
    protected static function boot()
    {
        parent::boot();
        
        // Automatically set evaluation_date to today when creating
        static::creating(function ($model) {
            if (!$model->evaluation_date) {
                $model->evaluation_date = Carbon::today();
            }
        });
        
        // Prevent evaluation_date from being updated
        static::updating(function ($model) {
            $model->evaluation_date = $model->getOriginal('evaluation_date');
        });
    }
    
    /**
     * Get formatted evaluation date
     */
    public function getFormattedEvaluationDateAttribute()
    {
        return $this->evaluation_date ? $this->evaluation_date->format('d-m-Y') : null;
    }
    
    // Relationships
    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}