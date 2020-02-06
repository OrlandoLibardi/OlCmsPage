## Páginas para OlCms

### Instalar o PageCms

```console
$ composer require orlandolibardi/pagecms
```
```console
$ php artisan vendor:publish --provider="OrlandoLibardi\PageCms\app\Providers\OlCmsPageServiceProvider" --tag="adminPage"
```
```console
$ php artisan migrate
```
```console
$ composer dump-autoload
```
```console
$ php artisan db:seed --class=PageTableSeeder
```

# \o/



