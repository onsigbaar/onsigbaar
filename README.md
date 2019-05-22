## onsigbaar

Laravel Passport OAuth2 API Server authentication using [Resouce Owner Password Credential Grant](https://tools.ietf.org/html/rfc6749#section-4.3) 
with optional laravel admin dashboard that includes user-permission-role, GUI for CRUD operations, a media manager, menu builder, and much more.

## Install

```bash
composer create-project --prefer-dist onsigbaar/onsigbaar projectname
```

## Create the database

Adjust .env with your database configuration/ credential.

```properties
# .env

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Passport install

```bash
composer passport-install
```

Copy personal access and password grant client value into `.env`

```properties
# .env
PERSONAL_CLIENT_ID=
PERSONAL_CLIENT_SECRET=
PASSWORD_CLIENT_ID=
PASSWORD_CLIENT_SECRET=
```

Install done.

---

## Api

In the _terminal_/ _cmd_/ _bash_ run the dev server using `php artisan serve`.

## Authenticate user

Send post request into endpoint `http://localhost:8000/api/login/` with user credential :

```bash
# username key can use username or email as it's value
username: user # user@api.com
password: user
```

### _Request Example_

```http
POST /api/login HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Content-Type: application/vnd.api+json

{
	"username":"user",
	"password":"user"
}
```

### _Response Example_

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImViMzQyN2VjZTQ0MTRiMGQ0NmI5ZGUxODQ5MGZjM2ZmNzdkMjRmZjgzZjE4MGI3ZTM1Y2U2ODA2OTc1Zjg5MDhjZjQzNmY5MDkzMTQ2ZmEzIn0.eyJhdWQiOiIyIiwianRpIjoiZWIzNDI3ZWNlNDQxNGIwZDQ2YjlkZTE4NDkwZmMzZmY3N2QyNGZmODNmMTgwYjdlMzVjZTY4MDY5NzVmODkwOGNmNDM2ZjkwOTMxNDZmYTMiLCJpYXQiOjE1NTc5Nzk0MzksIm5iZiI6MTU1Nzk3OTQzOSwiZXhwIjoxNTU3OTg2NjM4LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.jgytkbnrg97V2wlQnpRgTyauMEjPjFdy-ZsYbzC_ma04HCvBRKG4PTMv9WQ8s6J7gIbAwUGyyjbTO8iuFL1UreoGmbt1C72oYdJwzdQq3K92OoO4HngxjGrQkcjRNjFJ-75e3n9atAHKWfmETsVF3x-BZrt3pk73H0aOIFj3pPIUKCcbSTGK9psbyN9bHs1xK-P9Wmsahpd3Z8wyD9gXRkniZLVy4laoFIu8RWdDRl9PuMwUrGnBMeoWvC0CQidmFHLweI0iZYjWShsML9qmH0fg8fwgqKJQpmwvhL-SjmWrgxhKafxVyjAxDrQBPioUaCTqDxX1-zlSgaWHEKXbxiVlkwZd4E0Btv1B5Wm6xpFNvq9sbMC1tR583B--qrkVHLxkr1dC9-9C-F2o3jnnzyevpk7Cs6jL0r8978u7yBqIk8_ykxfbxnnzeR73SOvTxHbvIQFlpX6-qRGm6uYKzr-TWckAQbwqxxwfksl0eMsM9WjQ7Tfj4g-mirJsSDMei856iflDB0oZDacrcHQpDYaz3wmByK2zdCmxnXq-TlQCYYvt9fLJ0c_1-P-GmFuKw8tqhGPztNYkFUl9b84TchI3vaiFEM5krbyVFirYt8pqWWD9WBYgj-d5gYAL-vULioCJd5frgNtRjiJxvBFpPSo2PtVVMESBrMFOsFqLgv0",
    "expires_in": 7199
}
```

Note :
- Enable when `refreshToken.cookie.httpOnly` value in `config/password` set to _true_

## Refresh token with http-only cookies

Enable when `httpOnly` value in `config/password` are set to __true__. Default value.

In this mode, the refresh token will be set in a cookie with http-only flag, 
making it inaccessible by scripting languages (ie. javascript), the cookie can be accessed by the server.

Send post request into endpoint `http://localhost:8000/api/login/refresh`

### _Request Example_

```http
POST /api/login HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Content-Type: application/vnd.api+json

{
	"username":"user",
	"password":"user"
}
```

### _Example: Http Response return from server_

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImViMzQyN2VjZTQ0MTRiMGQ0NmI5ZGUxODQ5MGZjM2ZmNzdkMjRmZjgzZjE4MGI3ZTM1Y2U2ODA2OTc1Zjg5MDhjZjQzNmY5MDkzMTQ2ZmEzIn0.eyJhdWQiOiIyIiwianRpIjoiZWIzNDI3ZWNlNDQxNGIwZDQ2YjlkZTE4NDkwZmMzZmY3N2QyNGZmODNmMTgwYjdlMzVjZTY4MDY5NzVmODkwOGNmNDM2ZjkwOTMxNDZmYTMiLCJpYXQiOjE1NTc5Nzk0MzksIm5iZiI6MTU1Nzk3OTQzOSwiZXhwIjoxNTU3OTg2NjM4LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.jgytkbnrg97V2wlQnpRgTyauMEjPjFdy-ZsYbzC_ma04HCvBRKG4PTMv9WQ8s6J7gIbAwUGyyjbTO8iuFL1UreoGmbt1C72oYdJwzdQq3K92OoO4HngxjGrQkcjRNjFJ-75e3n9atAHKWfmETsVF3x-BZrt3pk73H0aOIFj3pPIUKCcbSTGK9psbyN9bHs1xK-P9Wmsahpd3Z8wyD9gXRkniZLVy4laoFIu8RWdDRl9PuMwUrGnBMeoWvC0CQidmFHLweI0iZYjWShsML9qmH0fg8fwgqKJQpmwvhL-SjmWrgxhKafxVyjAxDrQBPioUaCTqDxX1-zlSgaWHEKXbxiVlkwZd4E0Btv1B5Wm6xpFNvq9sbMC1tR583B--qrkVHLxkr1dC9-9C-F2o3jnnzyevpk7Cs6jL0r8978u7yBqIk8_ykxfbxnnzeR73SOvTxHbvIQFlpX6-qRGm6uYKzr-TWckAQbwqxxwfksl0eMsM9WjQ7Tfj4g-mirJsSDMei856iflDB0oZDacrcHQpDYaz3wmByK2zdCmxnXq-TlQCYYvt9fLJ0c_1-P-GmFuKw8tqhGPztNYkFUl9b84TchI3vaiFEM5krbyVFirYt8pqWWD9WBYgj-d5gYAL-vULioCJd5frgNtRjiJxvBFpPSo2PtVVMESBrMFOsFqLgv0",
    "expires_in": 7199
}
```

## Refresh token without http-only cookies

Enable when `httpOnly` value in `config/password` are set to __false__.

Send post request into endpoint `http://localhost:8000/api/login/refresh`

### _Request Example 1: sent `refreshToken` in http request body payload_

```http
POST /api/login/refresh HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Content-Type: application/vnd.api+json

{
"refreshToken":"def50200562b1bdb2f8f6908b4730ecbaf5ee946cd14c09d5d559f4aecf07fe426b19dcdd6ff7b403b73f933506ba645f979811d3ff77d1b4ef5ab25de993215fe46aa7960acdd123661c56069ccd90323b12cdfb3d2cdac3ce3d96cf5909cffee856210dc29ef19f7bb56cf26a3b7983df4daf8753a10495e41142bed30c2f7de8ee0460633d619da4d24d8c5d73d9598bdba6eaad1cbd34cf68f70191902bae9a3a321bb0816cfc1c2b9b30ba59808a43bb51cbec5b889aa6e133c81f6da8f11c2c617da47b9bd24d7b90f1e368e61a004799f14a48e5b92e6a0d1053460707335032e55dd736f73452f159f9864e02bee5a9dcfdc75b05a9ed2939eaa0e070e69b0b714dd3aa1cd65c9c02b2ba67860be28f1f77c25604f557cb6f3f10845364d3a25db70d0e61eca11881a26fbb0f1a846ada228b9f9082dd80f348d28b5aba746d9141df9b009477f25ee3c5b18f5b8a37af0739457632fb770b42a9a5bd0"
}
```

### _Response Example 1: sent `refreshToken` in http request body payload_

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE0MTI3YjJkZjNjNmNkZGNmMDMwODE3NTNhMDMyNzJmNmJjZDU3ODk5NDZmM2RjYWRhNDY3NzM1NmM4OThiYWJhNTBlZTJmZTU3NTk2NjhjIn0.eyJhdWQiOiIyIiwianRpIjoiYTQxMjdiMmRmM2M2Y2RkY2YwMzA4MTc1M2EwMzI3MmY2YmNkNTc4OTk0NmYzZGNhZGE0Njc3MzU2Yzg5OGJhYmE1MGVlMmZlNTc1OTY2OGMiLCJpYXQiOjE1NTc5ODEyMTksIm5iZiI6MTU1Nzk4MTIxOSwiZXhwIjoxNTU3OTg4NDE5LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.TlhzeNouP6NK6ucdJB4-hcQU7cFlIKItMsbY1e0pA7XtdC90UHuUea15Vu6ZDBLqVpnWGZTemi9VQHAl4R54ym0cqEIWKQtyX9qxFTADWDRbIeUlbOSULtTwmDCZdp-joCw9NlRiTy0YgfmROEem2SbZZAROxLF_zOkch4M4N2H1Ooxi8czNJ1nd4svE9vWjXBIlOPQKF3_fx1NRO5MVQsIsVXd5uqRkRRlJUuaqLXSs0-EQf-DrxFSA1OAJNuSzA8BBqa-7a7wixrGCV9vAGf3TQgt66RJP2Tt0g-HCJpPxQj4868bVfOOOpnKwMwvSJuo4bVO0EkS3MOvxTlm0E9w1DYtsFrZtLQxtejP7MKrq3HiVdUXDTIhhuzLye_KBn8RMKNZwTelthUUn0EYKyFne93xFBz1E-VLgZRtUJyxBCWtREHjfCtmsTInFszS3sYuBmpu3ztXtb_dydSmSMA_VSLCBXITT6fL3xckZWx3n6g6k6eWlOnvvuube2kQKXfXA0m4U5QFQDJ2M9eSsOC_K3PaIs0Lwouj7I53pjunZlR1Jn2Am_R1_8quxCZnTpSYdq4_DQ-VQ9T4CFCzM-j6YD9R0WzNwHQdldTkXVHWatNzDQF76yZxBJIbQ7CcJZs9EnJbPT_vuycHP1UgnqynfnmSiP1A63DuWJxso3lo",
    "refresh_token": "def50200927ad69eb342cf35c9ebfd7b5d53412afa66ec504d46c4d1eb9862772c7d3a390dfa975e355d8d429ac9abf71e8ee2988c51e46fa09ff2b77f16a36acc4eeabf5363e4bfe6fd5cf87558a280e764d6dc864217fc4efc2494cf1df582b8059c8f36d3f01a969502fd0c2394c5feb746a8fdd0795fde8da93a3e51ffc16c6d951b88932602fcbe6f59858079d88a8b91ff367820d9d8462ddbd6cd3de8755e69b8fcdc08a0e4bf4ffc34e2c60211752d573c90e5813483a359d9dfc179f77e4f7a064b61d4487c2742e0b0cf9314aefe52a53ee971c7e1f6d63f574d37904168d7a28552c1ec7ededf0c7a4235e13b36488776a31a9eb850819b1f8da9ae9b0a393046c97b5d2e10de317ad54f6799e7f2920c5d1c8207d51d38e83da686a1f0beafd2f69cf306adc978cf9c78e77bb3779cac15e5b472bd5d1d79e75daaad505390f8ebbd6709ee6eeba9e21652e1a51a08905eab2f4f2746da7f068cae",
    "expires_in": 7200
}
```

Note :
- Enable when `refreshToken.cookie.httpOnly` value in `config/password` set to _false_

### _Request Example 2: sent refresh token in http request param query-string_

```http
POST /api/login/refresh?refreshToken=def50200a7f8ff65af9397f759f04506dcfc9141e98b976108ab99c2f2a2d4ced1389bd4969423d4c2f5949cade8a7fa22af469ed6e980f3a41b81c293d321833b5eb26b3470e3405f0ad1c26490519138c96ff511806f4aece2f3534de6f201206f83a44a7a6698a40c43ebb96fe5462f7ed51cb734532c2255772354e15e57879930cc26f632f83399dd1d934dbe13c7c6210778809b54ff46118de1ebbffa4e03e92621476e742f100d968fcd34e47eac09a7af4b5c3c2785438f73619d0ebf3b7dd0c22462a88b81839aa323182bf2c78ddfc04547523d53b17c4291248533c2fe5ad896e4d2af46e4c48e7434a6dff787ab7d2e15e1cd27a211f94c65e6c66087e3dd6a20516edd4f26da6b1aac42b8b373c4cc23861ffceb7e89cdda088483d6cc32b7a6f042eedd340de4b470525fc83dabca329241d51e176595242cad4f609500060225a5e28fdd681882d10b5eae2ad1dbea193283bdb4bf127c8f4c HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Content-Type: application/vnd.api+json

```

### _Response Example 2: sent refresh token in http request param query-string_

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU1Y2I0MmQ2YzI1YjY0OWFkYjNhN2RhZWFmMGYyZmU0NDZiZDRjZDAxZDVlNWRiMTFjNmE3MDRhYjE4YzE0MGRiZGMzNGZhNGVhMDBhNjU1In0.eyJhdWQiOiIyIiwianRpIjoiZTVjYjQyZDZjMjViNjQ5YWRiM2E3ZGFlYWYwZjJmZTQ0NmJkNGNkMDFkNWU1ZGIxMWM2YTcwNGFiMThjMTQwZGJkYzM0ZmE0ZWEwMGE2NTUiLCJpYXQiOjE1NTc5ODA4NjgsIm5iZiI6MTU1Nzk4MDg2OCwiZXhwIjoxNTU3OTg4MDY4LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.UIhU1ihn3MmXVUQnn1q5Im2klH7_h1YJRLwZU3LXyItG6iUqvPLkqKSp9ZPfkAKKJzzkOupK4oJcPeXP6K3p9YUZxb3cPWNAGFjTORR8DreV-j0_792Fm-Ym6NWqAf65IUuRhnSNVJFkdsCQ5QzcS4zwjcvaYfaacrw3PG_nyGl5ejK2mcPI3cldUO3HpApiThPg-TZASMBwMUUC-1hnM7vNLM4epwe2_Vbj5IGfoIwoQT-6OD0-KinEpte0hruy6msKNKkmvvMunw8j8BMYbtq-p1QuIeDBOvtiI4O58jYDdJgplLIO6YxAFdcOWBp6KtF9DF0Mcf6UTCJkyaR2Vg-dskycMSxorrf02xYOMbXdGRemw9kT-eMylsoXUcZXPjufE83QL7ySIGm0oq5TsxZ4uCidcV4PejgL5bwvSD1q4iwZ4z4kxr4ef7WsEb905bZD6YvKtl6DVVf5_2etvphvPFddHjJSIGhVtlkJys_gNi5X5ZiB5WIvHhTmLQuIYW4xG5OPeu2Y_EiPAZ5jmFhTPQotwyFM6rt7bfKxaDuzv_bvi40YHTqZs-UYWMvJ7j3b2bz6ZrILXYCgTREdclbzreJUbtHCvLv1ymPiTXxMZVspuzWQ52EumhWIeoI-hidqZawKvaUP4BhnAc5q6UR6FNDbOzTQ410keSwm2BU",
    "refresh_token": "def502004576e6410900e8db0ba53f5637e76c3cbaca1f4fcfbfc128405349e32cf9d6e72154c1550e32e806a4971d2d0b3696c8bac99ba549ce34bea2274ff3918d28a79accb16d616a90664ffe032bf26929e51644bf9853782594a9612d9ca424becaf1d1bf5b97c63b1e05f7e75b5928f7ebaa0c468a225aef802132d85a93d033138bbea51591f8622692afc39722b14a3ce53f7b4f9603db9c4289cc4367ae01b1ce599fb64a771a2dbb77239498d18665d3051d6efc5d68b33d3ae900db93e7c0155e5703975ebe8302e1844ec6fd03f8e567e2dbe560eb8c6f7f2a0f709e598c5ca9f7bb6513b1ee92b6ea17a3fdb9e29a27bb0415816fa1e632ecbecf69bbea06436dc40be16f775f696fcc2b5bd0d2a5c61192ef651525eab566c5385e7243b57baaafd2109dd352234a7c752933107aa4325444744dc3a58366ce50bc6d711a062ea431dc2aaf1c66ef2548cd09974e8ec4b9930b215628c76feff4",
    "expires_in": 7200
}
```

## Logout user

Send post request into endpoint `http://localhost:8000/api/logout`

### _Request Example_

```http
POST /api/logout HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Content-Type: application/vnd.api+json

```

Notes:
- Success response will return http status `204 No Content`

## Protected resources endpoint

Implement `auth:api` middleware in any route to make the resources oauth2 protected.

```php
# Example in api/User/Routes/api.php

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
```

After successful login send get request to `http://localhost:8000/api/user/` to get authenticated user data.

### _Request Example_

```http
GET /api/user HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Content-Type: application/vnd.api+json

```

### _Response Example_

```json
{
    "data": {
        "type": "users",
        "id": "9e556479-7003-5916-9cd6-33f4227cec9b",
        "attributes": {
            "username": "user",
            "name": "user",
            "email": "user@api.com"
        }
    },
    "link": "http://localhost:8000/api/user",
    "meta": {
        "copyright": "copyrightⒸ 2019 Onsigbaar",
        "author": [
            {
                "name": "anonymoussc",
                "email": "50c5ac69@opayq.com"
            }
        ]
    }
}
```

## Send all error/ exception to user email

Make sure the application can send email by providing the correct data in `.env`

```properties
MAIL_DRIVER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
```

Set the `LOG_ACTIVITY` and `SIGNAL_EMAIL_SENT` value to `true` in `.env`.
Provide user email data where it will be sent etc.

```properties
LOG_ACTIVITY=true
SIGNAL_EMAIL_SENT=true
SIGNAL_EMAIL_SENT_TO=person1@email.com
SIGNAL_USE_TABLE=signal_log

MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

Multiple email recipient provide as follow (separate by a comma)

```properties
SIGNAL_EMAIL_SENT_TO=person1@email.com,person2@email.com,person3@email.com,person15@email.com
```

In `app/Exceptions/Handler.php` uncomment the line code bellow, from previously :

```php
# app/Exceptions/Handler.php
...
public function report(Exception $exception)
{
    parent::report($exception);

    # Log all error exception into database.
    # $this->fireLog('error', $exception->getMessage(), ['error' => $exception]);
}
...
```

Changed into :

```php
# app/Exceptions/Handler.php
...
public function report(Exception $exception)
{
    parent::report($exception);

    # Log all error exception into database.
    $this->fireLog('error', $exception->getMessage(), ['error' => $exception]);
}
...
```

Global application error exception will be saved into the database and sent to user email.
The data saved and emailed will include the user ID, request URL, request method, client IP, browser, browser version, user OS, etc.

### Related resources

- Oauth2 password grants implementation for this repo located in [here](https://github.com/consigliere/Passerby)
- Log message into database through event subscribe using [signal](https://github.com/consigliere/Signal)
- [Modules](https://github.com/onsigbaar/components)
- [Framework](https://github.com/onsigbaar/framework)
- [Resouce Owner Password Credential Grant](https://tools.ietf.org/html/rfc6749#section-4.3)
- [Which grants](https://rn.netlify.com/blog/oauth2-grants.html)
- Postman [API Docs](https://documenter.getpostman.com/view/1015471/S1EH21nx)

---

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost you and your team's skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
