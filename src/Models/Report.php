<?php

namespace DraperStudio\Reportable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report.
 */
class Report extends Model
{
    /**
     * @var string
     */
    protected $table = 'reports';

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
    public function reportable()
    {
        return $this->morphTo();
    }

    /**
     * @return Model
     */
    public function conclusion()
    {
        return $this->hasOne(Conclusion::class);
    }

    /**
     * @return Model
     */
    public function judge()
    {
        return $this->conclusion->judge;
    }

    /**
     * @param array $data
     * @param Model $judge
     *
     * @return mixed
     */
    public function conclude($data, Model $judge)
    {
        $conclusion = (new Conclusion())->fill(array_merge($data, [
            'judge_id' => $judge->id,
            'judge_type' => get_class($judge),
        ]));

        $this->conclusion()->save($conclusion);

        return $conclusion;
    }

    /**
     * @return array
     */
    public static function allJudges()
    {
        $judges = [];

        foreach (Conclusion::get() as $conclusion) {
            $judges[] = $conclusion->judge;
        }

        return $judges;
    }
}
