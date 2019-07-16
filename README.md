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
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjY5MzIxMzc4MzNhOGYzMjFmZmYwMWNmNDU4ODNmMWM5NWEyNWFmN2QwMmZkNmQ3MzdkMTEyNzI5NzdiNDlhN2Q4NzM1MzU5MjVkNTNjMzRjIn0.eyJhdWQiOiIyIiwianRpIjoiNjkzMjEzNzgzM2E4ZjMyMWZmZjAxY2Y0NTg4M2YxYzk1YTI1YWY3ZDAyZmQ2ZDczN2QxMTI3Mjk3N2I0OWE3ZDg3MzUzNTkyNWQ1M2MzNGMiLCJpYXQiOjE1NjMxNTk5NTMsIm5iZiI6MTU2MzE1OTk1MywiZXhwIjoxNTYzMTYwNTUzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.he4oQNrcUCIgmkDKO_SSUfqpEMSTkCR6AVDLJRXI4acrDi6DVP8vMSkH6VfuNENt9TqNnYgQdU9msZD7Iwzbj0_zmBykWQpBFEESiiNSl7IWoFgwQdvXrrAChClSeH_CNKA5OzeIBv4H4IcSvK_lDnrVxB7bfsqMpStnq0TjdlUlgJfhBhlIl3qqt0sTiEO8M4txeCnmHCMSJGsZoywDc18lmYe0FofwVc6EYmKHhfoD-JVR6MQ2nhxjUxeCfvlbY4K72BIHeWnGqYOOz4NkPHcSukDlXh0T_imPQsToXVKHKY7Dzbgig_clWrXcUJ2kwiz_DQyB-nVT-6g6JZbG6uU55ft2eUo4DRAf12iwnJrDelHtlrK5BHv1oAp4j7seOJa77JKdqn5JF6VAL56YmM8jdnZByn4Ef7MhajFID-yGFtZFsBBJBv4xB3W9RbKEVxLvXsPL0CpGWEv5383T8Wi6Ca3RgKFDDbSG_e5zLS4tlVM-j4u_vEKu_HZHG2fWFxYForhoTJSRuzzhl0mLe4Y5e3E_42EvgovqWDGqDFF77O-vXzNPVb3HepRE6lCZE9OEJEuW73ZX_1UWhHCSTNgRbTUJNvIVNXx2PlvDH38M7nRqrds9Mh93NaRcrcCiGDNpAdt7fVgsak2ni1oi63mcZNVvspmFJPeBFghBg_o",
    "expires_in": 600
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
POST /api/login/refresh HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json

```

### _Response Example: Http Response return from server_

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ0YWE3Yzg2NTMwNmY0NDkxMDI5MjA3YWQ2NDk1ZTMyNGE0ZTU1MzI1MDNhNjhjMDZmZDM4M2JjZWU4ZDNkN2Y5MTFhMDVhM2Q2NmZhMzI5In0.eyJhdWQiOiIyIiwianRpIjoiZDRhYTdjODY1MzA2ZjQ0OTEwMjkyMDdhZDY0OTVlMzI0YTRlNTUzMjUwM2E2OGMwNmZkMzgzYmNlZThkM2Q3ZjkxMWEwNWEzZDY2ZmEzMjkiLCJpYXQiOjE1NjMxNTk5OTIsIm5iZiI6MTU2MzE1OTk5MiwiZXhwIjoxNTYzMTYwNTkyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.pQaRWeF7Oz4lccMU7crT2SuVG15bbZ3K2g1VWhOHkaJXJC2MG36awqzFn_JPkfnN3kpv2fej8OgISnDDbbf-mC3sJ4qRpr4mIgcSfmpsgzWSpnu4juBQ7cPfTSVn-e9Bwvry0T1hgwlee2Z450gOB0EmACE5bAIu_wck1Hq4NhKxxoaTKzlfJMFVBP7up5Ny2UtcrERkDwD7Yap7EbY-Zq9eehDOHsGWRt0wEzt41_ql5MqcK4Ww6gBHIdhToW_KN1La5YvrEPB9fe071KwccWlLdpv88ZS5GmmEY8qschcNQMxcgHZLjWvJZde--6ae234yIas6sLzsVMTqasH3JSL_LltCB52ncEt6CKP4VY_oyE5GpKzoO6oUJRj40WKWZ9vTCIFsvtFLx-GWKDKAg-0KA8OZmSNQyQRJIioqeVnxFoJ06aTKglgN0JxoCeWmDL6uxQLaK10NOce_fTibYSZo5keBQWkbxNo6yG6he4zO1sum8tByzhua9TdTDBxYbBNPDhFFune2nKpf2Ux9tzVVezLskuj9OTIPRTr2kZmH2Rdr7U7rE_nQl37XmUg-MYWNHV51JeI4sHuJHJzSd72_rTHw2YwjHIijw6yw8eH_Z9qUQRsSp4A0nHVCukqC0ZilrZljZhYTIqrLWjoW2jPK_TQGjdbxqELB_U_nm40",
    "expires_in": 600
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
    "refreshToken":"def50200b18fa90ea8c0ff00f6cf49fa5240aa4eb11131c349e4c3fe5b072443eed8283bebd504ff496bd4835a31efed77dcdec47d971149626626e6003e07d76c6dab8049979c0d9760aab0216b91db71d94d2cdd1ede44007e2feb8e43812f4418a5e308a9a9f0865d016f93e8f333f75a3ffc6a640effa2d1d52a743c08d282ad47870b1152df18e4070cd260219cb11df058c9bf9eaff137a73ff257cf747dfb7a7400eb2c7dd39b626503aadaad2f192c2d5938f7fc271ef7bab99f07681f8abaab1b47afbb66b068817ac45b8e41077b5644d9be28305a27292dd7aab8cb080e8f781c0f0ecdd70a3c92c1ec99f4d3b7b2f0339648acc91dfc7d70efb3e550d07eadb5c459b5129b9e834a57bb0e380b3ed2112722a33ed78d763722c81a8a68c9ef2aff10cf146101084eee18a8bbf8851e6bee085bb0c0c6cb9a47ef70257deb11d93aede1cf6c0cd97d27e626c749e739062408c99acb828bbb95e61e"
}
```

### _Response Example 1: sent `refreshToken` in http request body payload_

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBlZjE3YTBlZGVhNTJlMjhhYTBiZGU2NjFhMmJhNjAwMDkxOTA1YjgwZTA1NWQ2MmY5MWViMjFmYTNiOWM2ZTAxZTZiNTllMTBlZTVjNDg4In0.eyJhdWQiOiIyIiwianRpIjoiMGVmMTdhMGVkZWE1MmUyOGFhMGJkZTY2MWEyYmE2MDAwOTE5MDViODBlMDU1ZDYyZjkxZWIyMWZhM2I5YzZlMDFlNmI1OWUxMGVlNWM0ODgiLCJpYXQiOjE1NjMxNjA3NzQsIm5iZiI6MTU2MzE2MDc3NCwiZXhwIjoxNTYzMTYxMzc0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.YSPefsWCdcbcSaG2JZTHcQTUvWs9OmU1wqnOTj8ctiHtya9n2PALgEZ5YHwBAIpnUB1YtcE5tg7VW7Rtc1XozbQkcc4ielfmamzAcR1ygWdaVSHOC03xKleuazcYdoJr-5ZMjRUpA-aicj4EXjWqFzUgZLd0fTgzUMPXOdLRaaj9SMVZaQWboZRiSIdo4lKelekRKxY1qY0R6VPG9N9fJhq-l494xQJpx1JPacqEH6CNHiYywtGUq7HN6f9IWSd0f5R_wNdCbitE7H6JWTfd36JUqW4bgs3YlM0DJEd3ExRebEdeglWEpb-eEOpRjyUuMpCQcydnjmJIEgQtmY-KvGBx_A-PWebp0JqUuxnk9kOrPP2k1MGNnCYJUkgEMiC73EFNaAYZkRpkcckTabsgUQE7WwFKDVVCXV8uWIETTkkpsMbtJawSbo6bXH6s5i7RiVGz4hJk5dCR5BI47dhZpdXEcWG89AZnMiRSDG5QcYKY1x6uyPyJqUuaSNQAeDOloj7ftRWvD4cEvlzj5dfYzP8I9T8aVOKKfkhYm2xUiqhsxJnjvf5WT-VXZAiwXp6Vxo5dFD-FNx6HMqH8hECraVSyu0K8Y_AsLcztyZ577IIMbQVEOea0-ZBjNh9gEekyz6N7CRULJjs74gp1Zzuym9PRg1zo4fKjg5YDrOceBWI",
    "refresh_token": "def50200eeb78ca69893af21b524737b2c84db47ca05c12ad2f97a860e4add13ad22e3d8bfe08a6b003017dd034dece06ecfeeac93a4dfb1af7e226133ee755507a110e5399e0c3e93cc2eda93f72583898d37c6dc5404147e4c1ab0140b028d90c4d1a3fce296bfa7b70999cd5bcc99423a539f67932fb8cb9b9a59514e11743657b125c72180832ad97b7c25b34245867cb02f4546b9b04f76f27eab12c9e59772438e99eeeddab5d06ddb0bedd164d5ca2da53cb2f768a99836b4b4cf7d504593aa74da4531d45fa2a3e5fb3c1148414ebc6497e610f3562b9a5015999244c4bc2f1c21abd7f6a9bc8847ad836edcf9e1f92fc2ab56f74ab1b92edf90c5ca4d0df5d5fc5082e90f4822a2009716db635d742858c970ef652467ed582473a4ff765947c4c40ff62440359f0583f19d51bea18e5309be60e902c8e0bd388d40f30ee3056ea3bbaa0b881f7fcd46af42a65dacfaa01030f4e6b8902c9b22caf09f",
    "expires_in": 600
}
```

Note :
- Enable when `refreshToken.cookie.httpOnly` value in `config/password` set to _false_

### _Request Example 2: sent refresh token in http request param query-string_

```http
POST /api/login/refresh?refreshToken=def502006320a539f572b90591cd91531d6ebc2552d18c01a51f626e14437c1b404824d61675e77a9cb3fdf7e10bac030d6741faf64c75a2dec495a823e3ce1182eb930024e2c2ee28f2c22caaf150ec73d746b42677053617a61aa91c0b43d062d6ffd124ca1c7831ad5345f0358089f2a69887821eced19d0400083175fa1a32b75a61643a82a94c17ac5f16ba5c279e00eee0106629c67fbbbd647ab73f3755a0314bef81592242089ce30f65e361a3bf9c477104c1840d9a0fb4379107a7371669e765dcb0ed62c916c33785d86e120dc531ea43c13dc698bc57848c09f4e0f77761920c35da18c1015d41b0e822b9688afce75d947ac639bae88035f26f7a1926623bca68bbb6bf7bc5a3cac45e2039ea2a0354b40b2166a1acbb3471c52d019825bd97b26564e7a92933224d521c8290b22938c1feaee98460aa6b06fd252bd39132c134fdc5732fba4c4e312bc27f30329540feaafee7c501acb6024f22 HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json

```

### _Response Example 2: sent refresh token in http request param query-string_

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE0OWRiOWE5OTZiZWM2ZDIwZTIyYmVkMTRlYmZhYTZkNjQ1ZTA0NjI4NDdiNjE3ZmJiNWM0ZDcxNjdhZWQ5MGUzMTE4NDVlZDQxZjk2Zjc1In0.eyJhdWQiOiIyIiwianRpIjoiYTQ5ZGI5YTk5NmJlYzZkMjBlMjJiZWQxNGViZmFhNmQ2NDVlMDQ2Mjg0N2I2MTdmYmI1YzRkNzE2N2FlZDkwZTMxMTg0NWVkNDFmOTZmNzUiLCJpYXQiOjE1NjMxNjA2NDAsIm5iZiI6MTU2MzE2MDY0MCwiZXhwIjoxNTYzMTYxMjM5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.r1w675wU_wof2Tn-eiOryXjdK81hWXfXqCPUY6EnwVEqAdyZeiaTcQIZB8Nh8bRQiUQEyKSG-UltKQLhajgEnoJ_8H2UqWSquhIUBcXe91NJXVLYnuODUZAXtJSsCCKMcHZqP4VRXDs7ZMaEso44tLHzlmTH4daPMDJMwuCrv20QmN3NKi-P_XISC77df6p1xSBTTRAw7VZSgxxNfnlyc_30RtvVRnLG2aNq5Qc3upfRIzjrqWiGrbzGnrWTMR4WAOS283STUz9ZtwEYAzschuLM4XM_pFckonespub1z24wNv41olnJF6ADoL3Z2fDJeFulkEZugCDQwl5ca1t9YwCDxpSn-zfY_QZ5YPinrFGwxliXZk1ZzO5iNpXHGKMwsnGCZc3s60TunyJaBjwgd6EFhiABquyjHvQ5QYSGaJXXz3FKhtsjCK144kdseWapAYp00QTp8CkGkqZNLRcP14w98cVyDeHic0gEQwK1IYPoMFPA0RGsDs8fRZoR88qitBl3l-Dz4f3JPc7fUkcxL-wc9-FxPP2WaEuwKflxdMZSSlv0dQKt_EgC_BxEnhEJ8eUh3_CAM21P3wntfSpoqBnnDjXPw-LN2CVPLovonExsJHGgDCb9sIqNQv_rkih7KKnEoMxMNESD40qwrtlNpKOqUj_nJRE1d3hVppBoY0U",
    "refresh_token": "def50200b18fa90ea8c0ff00f6cf49fa5240aa4eb11131c349e4c3fe5b072443eed8283bebd504ff496bd4835a31efed77dcdec47d971149626626e6003e07d76c6dab8049979c0d9760aab0216b91db71d94d2cdd1ede44007e2feb8e43812f4418a5e308a9a9f0865d016f93e8f333f75a3ffc6a640effa2d1d52a743c08d282ad47870b1152df18e4070cd260219cb11df058c9bf9eaff137a73ff257cf747dfb7a7400eb2c7dd39b626503aadaad2f192c2d5938f7fc271ef7bab99f07681f8abaab1b47afbb66b068817ac45b8e41077b5644d9be28305a27292dd7aab8cb080e8f781c0f0ecdd70a3c92c1ec99f4d3b7b2f0339648acc91dfc7d70efb3e550d07eadb5c459b5129b9e834a57bb0e380b3ed2112722a33ed78d763722c81a8a68c9ef2aff10cf146101084eee18a8bbf8851e6bee085bb0c0c6cb9a47ef70257deb11d93aede1cf6c0cd97d27e626c749e739062408c99acb828bbb95e61e",
    "expires_in": 599
}
```

## Logout user

Send post request into endpoint `http://localhost:8000/api/logout`

### _Request Example_

```http
POST /api/logout HTTP/1.1
Host: localhost:8000
Accept: application/vnd.api+json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU5Mjg2Nzg1MGU0YjA5ZDA0YzFhZDlmNzRiNTRlOTk2OGQxOWY3OWE4ZjMxMTVmZmFmNGUxMWQwMjJlYWMwMGU1MTJhNWM4MjMwY2Q5NDM1In0.eyJhdWQiOiIyIiwianRpIjoiZTkyODY3ODUwZTRiMDlkMDRjMWFkOWY3NGI1NGU5OTY4ZDE5Zjc5YThmMzExNWZmYWY0ZTExZDAyMmVhYzAwZTUxMmE1YzgyMzBjZDk0MzUiLCJpYXQiOjE1NjMxNjAxODQsIm5iZiI6MTU2MzE2MDE4NCwiZXhwIjoxNTYzMTYwNzgzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.m5YW72JVik95Tdqvt1l8kghlMf4RysblWw-dzwzafMZjmz-vxXeqboSS6MIbb6n_mWfbDxZ_3yAvqv5mUZxRSV2eXg-Fw_kOBdgwOn95gD1PEsarDT4haU0BC_u1Y5f5IzOfY6Tkh_Z4y5RNTkDd5H4zEYYZNoFPYKQWUvZibxQTYJ3fPVOLTZ_te_xJJ4jMD-l6POzZCvZvBE5OL7bxIcqEGjwFVjabrTD6iXpAL1HYh4bnj6325TqSipcN7d74OoKH7EGR-D6aLk4Q18O47gA3q4tK0c9QKeZYJCeZ9NQ5TsUTo2StEt0nruJRcg4Fg7BuMOJnPdwHG2F_vvxIM8ptBHgH6tzRrY2ai_RRjIhiZu8QGM1cxQbwSq62Fct9XtuegFpM8Vye2oFLFmgEQkWHDN684jSg15EVokTkc_utL7kEGP9lVKcSSmOk6-iXOxapTLeUYqB08QWEx7VCl9IdZezuVBHSKF5O1yx87hDkkV2GW7qHRskdT-faMA7UpqadMCZgbVgyj8zbL7sP8jaXdPzb8vCIYFIjDSJQqBkE4BxyQmz_0sxMgRqBxze-h0gf9CxbR1tEYGigkZy3myVhqGxWalnkwF4FkUsPGMA3aFq5mtrNQTD0UaC-_OkUqMP6ZYiCDuqNXN_9LDd4ZWgmgmd1NCXlWS2G6uZAGoE

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
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjIwYWRmMDZjZDA0OTI1MzI4NmQzOGI3MDYyYzhlYmI3MmNmOTQ5ZjNjMTQyNTIxZWYzNmY1YTUzNzQ5ZGFiNjg3YTQ1OGZiYjA1ZWE3OGFiIn0.eyJhdWQiOiIyIiwianRpIjoiMjBhZGYwNmNkMDQ5MjUzMjg2ZDM4YjcwNjJjOGViYjcyY2Y5NDlmM2MxNDI1MjFlZjM2ZjVhNTM3NDlkYWI2ODdhNDU4ZmJiMDVlYTc4YWIiLCJpYXQiOjE1NjMxNjEwMjMsIm5iZiI6MTU2MzE2MTAyMywiZXhwIjoxNTYzMTYxNjIzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Vx4K3Tp1XMTGz_pJx9JFuTZ9YuPB8WfFpX4hH701PR5ELnYZ3m71fQdL76jxuuDt37AWoSJacJeh5BYcwZsYRkg9PkHwIjmG7Hl3F-fXyri144VxocArkY_yy7Qt5M62bevMUk7vU0lT5P7qz3Nq8QEIQz78PZ6kZbp2J6M28ineXB0ZSkQ4wEHcZOd-1DjwhTUR-N0_cUS8ivXTM6XrJCEu43dHsv7WA05Iy11mZsnJuS3GUmkui5kCHzDsQXeqp7s50JQo0WsGU_JOsfY0QLFxnwA7uu1rBq2feaFDOFW60T9ThkUwsyCz3_VDeOonWCBpzYHBk20Qnd2_Hm2cTK7eJLJ0SV1PxUiMBP8NngiA61ffSeETcMOqfjqZJ3QJuDshwWSIC4jwFkw01jT9ArJFRJLTQ3EQ1HnAs1MfxY0aY3_k_aR3FOhlznpWLtWYS2nrSYemYF1WJxji4wQwf_6faauyzRwfht55Sq8CA7P5Wquj0QkFJnp3aLp5b37w-Vkym6iphm5yNNxYp_g5C3Ke7aeGQXGUs9Etb4mOsgbY0efk-YHyiIcWgAQwECqhoQavfTDYN_H5hTSN2ybStq9V2szTjo6J46WlMnxTVr_7u9RNvIBBVKgjI-eTMynPKMHSytYm5Z9E8OeD9esnqfCtF_i_IgIiSovNn0DuGv8

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
    "links": "http://localhost:8000/api/user",
    "meta": {
        "copyright": "copyrightⒸ 2019 Laravel",
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

- Api module [Authentication](https://github.com/consigliere/Passerby)
- Api module [Authorization](https://github.com/consigliere/Scaffold)
- [Logging](https://github.com/consigliere/Signal)
- [Modules](https://github.com/onsigbaar/components)
- [Framework](https://github.com/onsigbaar/framework)
- [Resource Owner Password Credential Grant](https://tools.ietf.org/html/rfc6749#section-4.3)
- [Which grants](https://rn.netlify.com/blog/oauth2-grants.html)
- Postman Authentication [API Docs](https://documenter.getpostman.com/view/1015471/S1EH21nx?version=latest)
- Postman Authorization [API Docs](https://documenter.getpostman.com/view/1015471/S1LyVTUs?version=latest)

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
