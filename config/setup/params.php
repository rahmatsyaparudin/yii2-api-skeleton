<?php

require_once __DIR__ . '/../core/CoreParamLoader.php';

// 1. Load default core parameters
$coreParams = CoreParamLoader::load();

// 2. Load user-defined additional config
$appParams = require __DIR__ . '/params_app.php';

// 3. Base override definition
// Uncomment any block below to override the corresponding core parameter
$params = [];

/**
 * --------------------------------------------------------------------------
 * Migrate Database
 * --------------------------------------------------------------------------
 * Uncomment to override the default migrate database parameter.
 */
$params['migrateDb'] = YII_ENV_DEV;

/**
 * --------------------------------------------------------------------------
 * Service Metadata Override
 * --------------------------------------------------------------------------
 * Modify service-level identifiers or title if needed.
 */
// $params['titleService'] = 'Yii2 Boilerplate Core Service';
// $params['serviceVersion'] = 'V1';
// $params['codeApp'] = 'boilerplateCore';

/**
 * --------------------------------------------------------------------------
 * Timestamp / DateTime Settings
 * --------------------------------------------------------------------------
 * Uncomment if you want to change default timezone or date format.
 */
// $params['timestamp'] = [
//     'timeZone' => 'Asia/Jakarta',
//     'UTC' => 'Y-m-d\TH:i:s\Z',
//     'local' => 'd-m-Y H:i:s',
// ];

/**
 * --------------------------------------------------------------------------
 * Language Configuration
 * --------------------------------------------------------------------------
 * Uncomment to override the default language or add more supported languages.
 */
// $params['language'] = [
//     'default' => 'en',
//     'list' => ['en', 'id'],
// ];

/**
 * --------------------------------------------------------------------------
 * JWT (JSON Web Token) Settings
 * --------------------------------------------------------------------------
 * Uncomment to override JWT signing key, algorithm, or expiration.
 */
// $params['jwt'] = [
//     'key' => 'boilerplate-secret-key-256-bit',
//     'algorithm' => 'HS256',
//     'expire' => '+2 hours',
//     'issuer' => 'https://sso.example.com',
//     'audience' => 'https://sso.example.com',
//     'id' => 'boilerplate-sso-core',
//     'request_time' => '+5 minutes',
//     'except' => YII_ENV_DEV ? ['*'] : ['index'],
// ];

/**
 * --------------------------------------------------------------------------
 * CORS (Cross-Origin Resource Sharing) Settings
 * --------------------------------------------------------------------------
 * Uncomment to modify allowed origins, headers, or methods.
 */
// $params['cors'] = [
//     'allowCredentials' => true,
//     'requestMethods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
//     'allowHeaders' => ['Origin', 'Content-Type', 'Authorization', 'Accept-Language'],
//     'requestHeaders' => ['*'],
//     'requestOrigin' => ['*'],
//     'origins' => YII_ENV_DEV ? [
//         'http://localhost',
//         'http://example.com',
//         'http://subdomain.example.com',
//     ] : [
//         'http://example.com',
//         'http://subdomain.example.com',
//     ],
// ];

/**
 * --------------------------------------------------------------------------
 * Request Settings
 * --------------------------------------------------------------------------
 * Uncomment to change CSRF, cookie validation, or add extra cookies.
 */
// $params['request'] = [
//     'extraCookies' => 'boilerplate-cookie-session',
//     'cookieValidationKey' => 'boilerplateCoreCookieKey123456',
//     'enableCookieValidation' => !YII_ENV_DEV,
//     'enableCsrfValidation' => false, #always false for API
// ];

/**
 * --------------------------------------------------------------------------
 * Development-Only Domains
 * --------------------------------------------------------------------------
 * Uncomment to modify allowed domains during development or testing.
 */
// $params['developmentOnly'] = [
//     'http://localhost',
//     'http://localhost:5173',
//     'https://example.com',
//     'https://subdomain.example.com',
// ];

/**
 * --------------------------------------------------------------------------
 * Pagination Settings
 * --------------------------------------------------------------------------
 * Uncomment to change default page size or sort direction.
 */
// $params['pagination'] = [
//     'pageSize' => 10,
//     'sortDir' => SORT_DESC,
// ];

/**
 * --------------------------------------------------------------------------
 * HTTP Verb Mapping
 * --------------------------------------------------------------------------
 * Uncomment to override allowed HTTP verbs for controller actions.
 */
// $params['verbsAction'] = [
//     'index'  => ['get'],
//     'data'   => ['post'],
//     'list'   => ['post'],
//     'create' => ['post'],
//     'update' => ['put'],
//     'delete' => ['delete'],
//     'view'   => ['post'],
// ];

/**
 * --------------------------------------------------------------------------
 * Mailer Settings
 * --------------------------------------------------------------------------
 * Uncomment to override sender or admin email addresses.
 */
// $params['mailer'] = [
//     'adminEmail' => 'admin@example.com',
//     'senderEmail' => 'noreply@example.com',
//     'senderName' => 'Example Mailer',
// ];

/**
 * --------------------------------------------------------------------------
 * Meta Settings
 * --------------------------------------------------------------------------
 * Uncomment to override meta params.
 */
// $params['meta'] = [
//     'organization' => 'Example',
//     'developer' => 'Example Dev Team',
//     'contact' => 'developer@example.com',
//     'support' => 'support@example.com',
// ];

/**
 * --------------------------------------------------------------------------
 * Final Merge Order
 * --------------------------------------------------------------------------
 * 1. Core defaults (params_core.php)
 * 2. Local overrides (this file, params.php)
 * 3. User additions (params_app.php)
 *
 * The order ensures:
 * - params.php can replace or extend any core value.
 * - params_app.php only appends or adds new keys, does not override.
 */
return array_merge_recursive($coreParams, $params, $appParams);