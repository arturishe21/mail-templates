
В composer.json добавляем в блок require
```json
 "vis/mail-templates": "1.0.*"
```

Выполняем
```json
composer update
```

Добавляем в app.php
```php
  'Vis\MailTemplates\MailTemplatesServiceProvider',
```

Выполняем миграцию таблиц
```json
   php artisan migrate --package=vis/mail-templates
```

Публикуем js файлы
```json
   php artisan asset:publish vis/mail-templates
```

В файле app/config/packages/vis/builder/admin.php в массив menu в настройки добавляем
```php
 	   array(
          'title' => 'Почта',
          'icon'  => 'envelope-o',
          'check' => function() {
              return true;
          },
          'submenu' => array(
              array(
                  'title' => "Шаблоны писем",
                  'link'  => '/emails/letter_template',
                  'check' => function() {
                      return true;
                  }
              ),
              array(
                  'title' => "Письма",
                  'link'  => '/emails/mailer',
                  'check' => function() {
                      return true;
                  }
              ),
              array(
                  'title' => "Настройки",
                  'link'  => '/emails/settings',
                  'check' => function() {
                      return true;
                  }
              ),
          )
      ),
```