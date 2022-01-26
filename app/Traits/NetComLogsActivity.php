<?php
/**
* This trait extends Spatie\Activitylog\Traits\LogsActivity
* Only change is to add action property to database and nullable description handling.
* @docs https://spatie.be/docs/laravel-activitylog/v3/advanced-usage/logging-model-events
*/
namespace App\Traits;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\DetectsChanges;
use Illuminate\Support\Collection;
use Spatie\Activitylog\ActivityLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Illuminate\Database\Eloquent\Relations\MorphMany;
#use Illuminate\Http\Request;

trait NetComLogsActivity
{
    use LogsActivity;

    protected $enableLoggingModelsEvents = true;

    protected static function bootLogsActivity()
    {
        static::eventsToBeRecorded()->each(function ($eventName) {
            return static::$eventName(function (Model $model) use ($eventName) {
                if (! $model->shouldLogEvent($eventName)) {
                    return;
                }

                $description = $model->getDescriptionForEvent($eventName);

                $logName = $model->getLogNameToUse($eventName);

                if ($description === '')
                   return;
                if ($description === null)
                {
                  //autofill
                  $request = request();
                  $description = 'IP: '.$request->ip()."\n".'Agent: '.$request->userAgent()."\n".'Url: '.$request->fullUrl()."\n".'Method: '.$request->method();
                }

                $activity = app(ActivityLogger::class)
                    ->useLog($logName)
                    ->performedOn($model)
                    ->withProperties($model->attributeValuesToBeLogged($eventName))
                    ->log($description);
                $activity->action = $eventName;
                $activity->save();
            });
        });
    }

}
