# Laravel Messageable

Use At Your Own Risk - Not Maintained!

-----

## Installation

First, pull in the package through Composer.

```js
"require": {
    "draperstudio/laravel-messageable": "~1.0"
}
```

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    'DraperStudio\Messageable\MessageableServiceProvider'
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

use DraperStudio\Messageable\Traits\Messageable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Messageable;
}

```

## Examples

#### Create a new thread
```php
Thread::create([
    'subject' => str_random(10),
]);
```

#### Add one message to a thread
```php
$thread->addMessage([
    'body' => str_random(10),
], $user);
```

#### Add multiple messages to a thread
```php
$thread->addMessage([
    [
        'data' => ['body' => str_random(10)],
        'creator' => User::find(1),
    ],
    [
        'data' => ['body' => str_random(10)],
        'creator' => User::find(2),
    ],
], $user);
```

#### Add one participant to a thread
```php
$thread->addParticipant($user);
```

#### Add multiple participants to a thread
```php
$thread->addParticipants([
    User::find(3), Organization::find(2), Player::find(4)
]);
```

#### Mark a thread as ready by the user
```php
$thread->markAsRead($user);
```

#### Get all threads
```php
Thread::getAllLatest()->get();
```

#### Get all threads that a user has participated in
```php
Thread::forModel($user)->latest('updated_at')->get();
```

#### Get all threads that a user has participated in with new messages
```php
Thread::forModelWithNewMessages($user)->latest('updated_at')->get();
```

#### Get the creator of a thread
```php
$thread->creator();
```

#### Get the latest message of a thread
```php
$thread->getLatestMessage();
```

#### Get an array of participant IDs and Types
```php
$thread->participantsIdsAndTypes();
```

#### Check if the User Model hasn't read the latest message in the thread yet
```php
$thread->isUnread($user);
```

#### Check if the User Model participated to the Thread
```php
$thread->hasParticipant($user);
```

-----

This package used [cmgmyr/laravel-messenger](https://github.com/cmgmyr/laravel-messenger) as a base and added some functions to it.
