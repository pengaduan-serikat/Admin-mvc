# pengaduan-serikat
Pengaduan Serikat Buruh

## Migrate DB

```
  php artisan migrate
```

## Seeding DB

```
  php artisan db:seed --class=AccessTypeTableSeeder
  php artisan db:seed --class=DivisionsTableSeeder
  php artisan db:seed --class=PositionTableSeeder
  php artisan db:seed --class=UsersTableSeeder
```

## Installing

```
  composer install
```

## Running
```
  php artisan serve
```