## Onsigbaar

Laravel Passport OAuth2 API Server authorization using [Resouce Owner Password Credential Grant](https://tools.ietf.org/html/rfc6749#section-4.3) 
with optional [Voyager admin dashboard](https://laravelvoyager.com/) that includes user-permission-role, GUI for CRUD operations, a media manager, menu builder, and much more.

---

- [Authorization API](https://github.com/consigliere/Passerby)
- [Authentication API](https://github.com/consigliere/Scaffold)
- [Install](#install)
    - [CLI](#cli)
    - [Create the database](#create-the-database)
    - [Passport install](#passport-install)
    - [Install Voyager](#install-voyager)
- [Api](#api)
    - [CLI](#cli)
    - [Authenticate users](#authenticate-users)
        - [Http request](#http-request)
        - [Http response](#http-response)
    - [Refresh token](#refresh-token)
        - [Http request](#http-request)
        - [Http response](#http-response)
    - [Logout user](#logout-user)
        - [Http request](#http-request)
        - [Http response](#http-response)
    - [Protected resources endpoint](#protected-resources-endpoint)
        - [Http request](#http-request)
        - [Http response](#http-response)
- [Log and send all error/ exception to user email](#log-and-send-all-error-exception-to-user-email)
- [API Tests](#api-tests)
- [Related resources](#related-resources)


## Install

### CLI

```bash
composer create-project --prefer-dist onsigbaar/onsigbaar projectname
```

### Create the database

Adjust .env with your database configuration/ credential.

```properties
# .env

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### Passport install

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

### Install Voyager

```bash
composer app-scaffold
```

---

## Api

### CLI

```bash
php artisan serve
```

### Authenticate users

#### Http request

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

#### Http response

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU1NjFjYzQxYWFjZWExNGIyM2Y4YmY1OWJiYjgzNDVhNWJjNjU1NmRmZmIwZTY5OWYwZjc3NDA1ZTI2MzhiM2VkMDg5ZTFkMGVjYTU2ZmJhIn0.eyJhdWQiOiIyIiwianRpIjoiZTU2MWNjNDFhYWNlYTE0YjIzZjhiZjU5YmJiODM0NWE1YmM2NTU2ZGZmYjBlNjk5ZjBmNzc0MDVlMjYzOGIzZWQwODllMWQwZWNhNTZmYmEiLCJpYXQiOjE1NTc5ODAyNTQsIm5iZiI6MTU1Nzk4MDI1NCwiZXhwIjoxNTU3OTg3NDU0LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.IhRPM8DOGiqD9PG24-WHj14Dk0MA-kZjp8pf8t_yko6reZHd6PVzwOKGrntpZXfNhF8Ua-9C_gsD8JaxOXoRq5WKIwcq2XiuIa1sNiuYjRtGHX9kbgczkSYkbmNTUlHvt-GQTADh5v3HwnWUlTKOr_qZUaoHaCg1ymA2hkvXWhDSvAkc4htYeWG38RgQRISDmhXAyUkO3yF8zCuNP_UtRpJDT12pGx9FW0gEJWEXOr4X-0U91CJ4GGBy3Z4Igpy-AyFivB7Zk5grtTvvpDJc_QiKi6UToDiSIDce0Nnyhu9jpC3Lgof64ah70TEW1BwyWtPGgwI7BFg27jAbq6GLwr_-fF-_cwWF9mA21HeePU7q25Lsxr-SflujL_CvcfnKBpilmpbXTuGUTAmF-9fpePY06U73rKGa9K8rlewaze3Kkf_NSG2R0LrcFKeJrKdwrNdqmxeS8Va1Lbp3CCn_sLL-WML1lQOuI9rHgoAT6QjSw_gxIldPmPAqEkAh5aagdI00YMvSAP03OVxtllLHSR0gDAuJk-EgNaDCBy4uxq2I8xiJbPdN6KKeCpjepSGsQ1YYNkodwcNh4P5MaHVahAF26VYN8quo0dXxMQ65XxGw6Xyf2NquM0PCQTnN39q6YxsNbHOpyBB9lHJk0vG-uugjo0icRW8Is2eyiDYMbsA",
    "refresh_token": "def5020085e818b57ce4820d959a3bd7160ab7460496d27be368821d0179033f763ff13fe5975c5888d98b50d7400a67aef4bda18f76c3042b34ac05080de4af9b162fc27227b5795546d74e91580b6420520b6919d3ec6d26240e8b85325f1e9843aa6d3a3c0477530b22338a4b5208c1a97f7f265acaabfaf3644daa01f6d691111f4d89374c518a36138f1e5fc80a87d41a880ac59a4999d4ed4831245d640d7142984d4f50229467b7614141116f1cf297cf13a2294ad3ab486e6cc6be2958abab70fcac627dabbe3c3f73a363de1843655bf1937f4afd6b7539ce694c9a9011bad97830bd8134966db489f9280b7cdc030b116ffcae8201fc887fa3e8f2ddfa7db507019521b94dd24fefcfac60c6cbc76cdee40b0d6869b642bc48b9168c98a63007cb85b4eabd8f1e68cb72ff764033cd9bb54df393e84fde9215a275d17af858723344b81dee097a25755feedba43ddffb595641c40907da3d761acce1",
    "expires_in": 7200
}
```

### Refresh token

#### Http request

```http
POST /api/login/refresh HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Content-Type: application/vnd.api+json

{
    "refreshToken":"def50200b18fa90ea8c0ff00f6cf49fa5240aa4eb11131c349e4c3fe5b072443eed8283bebd504ff496bd4835a31efed77dcdec47d971149626626e6003e07d76c6dab8049979c0d9760aab0216b91db71d94d2cdd1ede44007e2feb8e43812f4418a5e308a9a9f0865d016f93e8f333f75a3ffc6a640effa2d1d52a743c08d282ad47870b1152df18e4070cd260219cb11df058c9bf9eaff137a73ff257cf747dfb7a7400eb2c7dd39b626503aadaad2f192c2d5938f7fc271ef7bab99f07681f8abaab1b47afbb66b068817ac45b8e41077b5644d9be28305a27292dd7aab8cb080e8f781c0f0ecdd70a3c92c1ec99f4d3b7b2f0339648acc91dfc7d70efb3e550d07eadb5c459b5129b9e834a57bb0e380b3ed2112722a33ed78d763722c81a8a68c9ef2aff10cf146101084eee18a8bbf8851e6bee085bb0c0c6cb9a47ef70257deb11d93aede1cf6c0cd97d27e626c749e739062408c99acb828bbb95e61e"
}
```

#### Http response

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBlZjE3YTBlZGVhNTJlMjhhYTBiZGU2NjFhMmJhNjAwMDkxOTA1YjgwZTA1NWQ2MmY5MWViMjFmYTNiOWM2ZTAxZTZiNTllMTBlZTVjNDg4In0.eyJhdWQiOiIyIiwianRpIjoiMGVmMTdhMGVkZWE1MmUyOGFhMGJkZTY2MWEyYmE2MDAwOTE5MDViODBlMDU1ZDYyZjkxZWIyMWZhM2I5YzZlMDFlNmI1OWUxMGVlNWM0ODgiLCJpYXQiOjE1NjMxNjA3NzQsIm5iZiI6MTU2MzE2MDc3NCwiZXhwIjoxNTYzMTYxMzc0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.YSPefsWCdcbcSaG2JZTHcQTUvWs9OmU1wqnOTj8ctiHtya9n2PALgEZ5YHwBAIpnUB1YtcE5tg7VW7Rtc1XozbQkcc4ielfmamzAcR1ygWdaVSHOC03xKleuazcYdoJr-5ZMjRUpA-aicj4EXjWqFzUgZLd0fTgzUMPXOdLRaaj9SMVZaQWboZRiSIdo4lKelekRKxY1qY0R6VPG9N9fJhq-l494xQJpx1JPacqEH6CNHiYywtGUq7HN6f9IWSd0f5R_wNdCbitE7H6JWTfd36JUqW4bgs3YlM0DJEd3ExRebEdeglWEpb-eEOpRjyUuMpCQcydnjmJIEgQtmY-KvGBx_A-PWebp0JqUuxnk9kOrPP2k1MGNnCYJUkgEMiC73EFNaAYZkRpkcckTabsgUQE7WwFKDVVCXV8uWIETTkkpsMbtJawSbo6bXH6s5i7RiVGz4hJk5dCR5BI47dhZpdXEcWG89AZnMiRSDG5QcYKY1x6uyPyJqUuaSNQAeDOloj7ftRWvD4cEvlzj5dfYzP8I9T8aVOKKfkhYm2xUiqhsxJnjvf5WT-VXZAiwXp6Vxo5dFD-FNx6HMqH8hECraVSyu0K8Y_AsLcztyZ577IIMbQVEOea0-ZBjNh9gEekyz6N7CRULJjs74gp1Zzuym9PRg1zo4fKjg5YDrOceBWI",
    "refresh_token": "def50200eeb78ca69893af21b524737b2c84db47ca05c12ad2f97a860e4add13ad22e3d8bfe08a6b003017dd034dece06ecfeeac93a4dfb1af7e226133ee755507a110e5399e0c3e93cc2eda93f72583898d37c6dc5404147e4c1ab0140b028d90c4d1a3fce296bfa7b70999cd5bcc99423a539f67932fb8cb9b9a59514e11743657b125c72180832ad97b7c25b34245867cb02f4546b9b04f76f27eab12c9e59772438e99eeeddab5d06ddb0bedd164d5ca2da53cb2f768a99836b4b4cf7d504593aa74da4531d45fa2a3e5fb3c1148414ebc6497e610f3562b9a5015999244c4bc2f1c21abd7f6a9bc8847ad836edcf9e1f92fc2ab56f74ab1b92edf90c5ca4d0df5d5fc5082e90f4822a2009716db635d742858c970ef652467ed582473a4ff765947c4c40ff62440359f0583f19d51bea18e5309be60e902c8e0bd388d40f30ee3056ea3bbaa0b881f7fcd46af42a65dacfaa01030f4e6b8902c9b22caf09f",
    "expires_in": 600
}
```

### Logout user

#### Http request

```http
POST /api/logout HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU5Mjg2Nzg1MGU0YjA5ZDA0YzFhZDlmNzRiNTRlOTk2OGQxOWY3OWE4ZjMxMTVmZmFmNGUxMWQwMjJlYWMwMGU1MTJhNWM4MjMwY2Q5NDM1In0.eyJhdWQiOiIyIiwianRpIjoiZTkyODY3ODUwZTRiMDlkMDRjMWFkOWY3NGI1NGU5OTY4ZDE5Zjc5YThmMzExNWZmYWY0ZTExZDAyMmVhYzAwZTUxMmE1YzgyMzBjZDk0MzUiLCJpYXQiOjE1NjMxNjAxODQsIm5iZiI6MTU2MzE2MDE4NCwiZXhwIjoxNTYzMTYwNzgzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.m5YW72JVik95Tdqvt1l8kghlMf4RysblWw-dzwzafMZjmz-vxXeqboSS6MIbb6n_mWfbDxZ_3yAvqv5mUZxRSV2eXg-Fw_kOBdgwOn95gD1PEsarDT4haU0BC_u1Y5f5IzOfY6Tkh_Z4y5RNTkDd5H4zEYYZNoFPYKQWUvZibxQTYJ3fPVOLTZ_te_xJJ4jMD-l6POzZCvZvBE5OL7bxIcqEGjwFVjabrTD6iXpAL1HYh4bnj6325TqSipcN7d74OoKH7EGR-D6aLk4Q18O47gA3q4tK0c9QKeZYJCeZ9NQ5TsUTo2StEt0nruJRcg4Fg7BuMOJnPdwHG2F_vvxIM8ptBHgH6tzRrY2ai_RRjIhiZu8QGM1cxQbwSq62Fct9XtuegFpM8Vye2oFLFmgEQkWHDN684jSg15EVokTkc_utL7kEGP9lVKcSSmOk6-iXOxapTLeUYqB08QWEx7VCl9IdZezuVBHSKF5O1yx87hDkkV2GW7qHRskdT-faMA7UpqadMCZgbVgyj8zbL7sP8jaXdPzb8vCIYFIjDSJQqBkE4BxyQmz_0sxMgRqBxze-h0gf9CxbR1tEYGigkZy3myVhqGxWalnkwF4FkUsPGMA3aFq5mtrNQTD0UaC-_OkUqMP6ZYiCDuqNXN_9LDd4ZWgmgmd1NCXlWS2G6uZAGoE
```

#### Http response

```json

```

Notes:
- Success response will return http status `204 No Content`


### Protected resources endpoint

Implement `auth:api` middleware in any route to make the resources oauth2 protected.

```php
# Example in api/User/Routes/api.php

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
```

After successful login send get request to `http://localhost:8000/api/user/` to get authenticated user data.

#### Http request

```http
GET /api/user HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjEzYjYwZTI5NTkyOTNkMjgyMGJkNDNjMWU3N2RiYTFiNzQzZGZiZDc3OGMwMjA4MTZhODk2ODAxZWRhODEzYzc0OTQzZTQxODMxMWY0YjVjIn0.eyJhdWQiOiI2IiwianRpIjoiMTNiNjBlMjk1OTI5M2QyODIwYmQ0M2MxZTc3ZGJhMWI3NDNkZmJkNzc4YzAyMDgxNmE4OTY4MDFlZGE4MTNjNzQ5NDNlNDE4MzExZjRiNWMiLCJpYXQiOjE1NjM3NTcxMTcsIm5iZiI6MTU2Mzc1NzExNywiZXhwIjoxNTYzNzU3NzE0LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.wDWtL9I2VUZg49ah7Ff5hQpP7AlB82pWvuBQiD7RZVkzS_hSJ3Xkboz1vFjnOES9b5cIct2Dskz4sWSS_JBJmz7KILc4Py9D4PgAIPUCXVrgy_R7I23VwfTVA_3olVt-XW3nQsvQp2o9tu-0N5rFH6kqK8t2CevKxuWabUtFj7QlLyDnPy06D0zAfUU1lrwRYHv8BgID_hFxIxbO__lHHUgzVOOe-NtfXT5Ru64Mm9G-PqarZRpmfXy5GWthoHvzZxkHrUNiGoeaThjsDE2-AXqhIWDh02JlkgPTKJwjTaokHLIJk_2dI-kAIbHl4GtuNX6jT1-D5Khkq_FJWRFj3RYzpeZGBPFoOr4iJOpTSrfD5qtE_3eldS1jGbhWjsWUIGT3LDEts6bsnQssy2qPSNoJnqhO3nGsaKSg2nfa1DHBtLUzddLJRf3Ue5EdPugKyfG457LCnpHlmXQl8wDu5GEyl8cmPa6Bxqg5sqzEbBFe44bVqTmtvTh8b3hgMRiLnnwoiuxrHRpDJWeZHfVo1WwTTfpgn4sbbvcO3sWmDv8HeFsPVLQSi1LegCkim3Pps08X103BSDsWO0vPGOe_cP9lQOxgYlnHBlOHAtCjXtxrSqPnjZL1A0tm2iaA9R4SKAhDsgehGmLD3ydwc13pluQHyPw9BgMcu_76uZmJe_I
```

#### Http response

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
    "links": {
        "self": "http://localhost:8000/api/user"
    },
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

---

## Log and send all error/ exception to user email

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

## API Tests

Api tests refer to [Api authorization tests](https://github.com/consigliere/Passerby#api-tests) and [Api authentication tests](https://github.com/consigliere/Scaffold#api-testing)

## Related resources

- [Voyager Admin Dashboard](https://laravelvoyager.com/)
- [Laravel-Modules](https://nwidart.com/laravel-modules/v5/introduction)
- Api module [Authentication](https://github.com/consigliere/Passerby)
- Api module [Authorization](https://github.com/consigliere/Scaffold)
- Postman Authentication [API Docs](https://documenter.getpostman.com/view/1015471/S1EH21nx?version=latest)
- Postman Authorization [API Docs](https://documenter.getpostman.com/view/1015471/S1LyVTUs?version=latest)
- [Logging](https://github.com/consigliere/Signal)
- [Framework](https://github.com/onsigbaar/framework)
- [Resource Owner Password Credential Grant](https://tools.ietf.org/html/rfc6749#section-4.3)
- [Which grants](https://rn.netlify.com/blog/oauth2-grants.html)

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
