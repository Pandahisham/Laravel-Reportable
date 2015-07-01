# Laravel Reportable

Use At Your Own Risk - Not Maintained!

-----

## Installation

First, pull in the package through Composer.

```js
"require": {
    "draperstudio/laravel-reportable": "~1.0"
}
```

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    'DraperStudio\Reportable\ReportableServiceProvider'
];
```

At last you need to publish and run the migration.

```
php artisan vendor:publish && php artisan migrate
```

## Setup a Model
```php
<?php

namespace App;

use DraperStudio\Reportable\Traits\Reportable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Reportable;
}

```

## Examples

#### The User Model reports the Post Model
```php
$post->report([
    'reason' => str_random(10),
    'meta' => ['some more optional data, can be notes or something'],
], $user);
```

#### Create a conclusion for a Report and add the User Model as "judge" (useful to later see who or what came to this conclusion)
```php
$report->conclude([
    'conclusion' => 'Your report was valid. Thanks! We\'ve taken action and removed the entry.',
    'action_taken' => 'Record has been deleted.' // This is optional but can be useful to see what happend to the record
    'meta' => ['some more optional data, can be notes or something'],
], $user);
```

#### Get the conclusion for the Report Model
```php
$report->conclusion;
```

#### Get the judge for the Report Model (only available if there is a conclusion)
```php
$report->judge(); // Just a shortcut for $report->conclusion->judge
```

#### Get an array with all Judges that have ever "judged" something
```php
Report::allJudges();
```
