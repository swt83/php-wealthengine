# WealthEngine

A PHP library for working w/ the WealthEngine API.

## Install

Normal install via Composer.

## Usage

```php
use Travis\WealthEngine;

// find by address
$response = WealthEngine::by_address([
	'apikey' => '12345',
	'is_full' => false,
	'last_name' => 'Tarsus',
	'first_name' => 'Saul',
	'address_line1' => '777 Pearly Gates', // only the first line of the address, no suites
	'city' => 'Paradise', // the city
	'state' => 'TX', // the 2 letter state code
	'zip' => '77777', // the 5 digit zip code
]);

// find by email
$response = WealthEngine::by_email([
	'apikey' => '12345',
	'is_full' => false,
	'email' => 'paul@damascus.net',
	'last_name' => 'Tarsus', // optional
	'first_name' => 'Saul', // optional
]);

// find by phone
$response = WealthEngine::by_phone([
	'apikey' => '12345',
	'is_full' => false,
	'phone' => '7777777777', // numbers only
	'last_name' => 'Tarsus', // optional
	'first_name' => 'Saul', // optional
]);
```

Note that each API call includes an ``apikey`` and ``is_full`` value in the payload.  The full lookup includes more information, but costs more per query.

You can also add a ``is_sandbox`` argument, if you want to use the testing API endpoint.

It is probably a good idea to cache these API responses, using whatever method you prefer, to reduce duplicate charges for queries you've already run in the past.

For more information, see the (documentation)[https://dev.wealthengine.com/documentation].