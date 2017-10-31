# Реализация NotifyJs для Laravel 5.5.x

[![Latest Version](https://img.shields.io/github/release/rulweb/laravel-notify.svg?style=flat)](https://github.com/rulweb/laravel-notify/releases)
[![License](https://img.shields.io/packagist/l/rulweb/laravel-notify.svg?style=flat)](https://packagist.org/packages/rulweb/laravel-notify)

## Установка

Установка пакета с помощью [Composer](https://getcomposer.org/), в корневом каталоге вашего приложения

```bash
$ composer require rulweb/laravel-notify
```

В Laravel 5.5.x пакеты подгружаются автоматически, по этому не нужно ничего прописывать в `config/app.php`

В шаблоне перед тегами `</body></html>` добавить:

```blade
@if (session()->has('notify.title'))
    <script>
        $.notify({
            title: '{{ session()->get('notify.title') }}',
            text: '{{ session()->get('notify.text') }}',
            image: '{{ session()->get('notify.image') }}'
        }, {!! session()->get('notify.title') !!})
    </script>
@endif
```

## Использование

Использование [фасада](http://laravel.com/docs/facades)
```php
use RulWeb\Notify\Facades\Notify;
```

```php
// Использование методов
Notify::error($title, $message);

// Более гибкий вариант
Notify::type('error')->title('Ошибка')->text('Время действия прошлого <strong>ключа подтверждения</strong> ещё не истекло');
```

Использование хелперов
```php
// Использование методов
notify()->error($title, $message);
```
```php
// Более гибкий вариант
notify()->type('error')->title('Ошибка')->text('Время действия прошлого <strong>ключа подтверждения</strong> ещё не истекло');
```

## License

[MIT](LICENSE) © [RuleZzz](https://github.com/rulweb)