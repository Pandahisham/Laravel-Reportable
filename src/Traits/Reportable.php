<?php

namespace DraperStudio\Reportable\Traits;

use DraperStudio\Reportable\Models\Report;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reportable.
 */
trait Reportable
{
    /**
     * @return mixed
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    /**
     * @param $data
     * @param Model $reportable
     */
    public function report($data, Model $reportable)
    {
        $report = (new Report())->fill(array_merge($data, [
            'reporter_id' => $reportable->id,
            'reporter_type' => get_class($reportable),
        ]));

        $this->reports()->save($report);

        return $report;
    }
}
