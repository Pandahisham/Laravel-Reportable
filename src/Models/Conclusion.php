<?php

namespace DraperStudio\Reportable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Conclusion.
 */
class Conclusion extends Model
{
    /**
     * @var string
     */
    protected $table = 'reports_conclusions';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = ['meta' => 'array'];

    /**
     * @return Model
     */
    public function conclusion()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * @return Model
     */
    public function judge()
    {
        return $this->belongsTo($this->judge_type);
    }
}
