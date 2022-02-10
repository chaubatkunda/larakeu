# Lara'keu

#### requires

php 8.0

Download atau clone project dari github:

```sh
https://github.com/chaubatkunda/larakeu.git
```

```sh
composer install
```

jika pada saat janlakan composer install masi terdapat `error` jalankan sekali lagi perintah di bawah ini.

```sh
composer install --ignore-platform-reqs
```

copy atau rubah file env.example menjadi .env dan masukan nama database pada DB_DATABASE=
setelah itu ketikkan pada terminal perintah di bawah ini.

```sh
php artisan migrate
php artisan key:generate
php artisan optimize
php artisan db:seed
```

### Plugin

| Plugin                   | Readme                                              |
| ------------------------ | --------------------------------------------------- |
| Laravel Yajra Datatables | https://yajrabox.com/docs/laravel-datatables/master |
| Laravel sweet-alert      | https://realrashid.github.io/sweet-alert/           |
