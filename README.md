# Показывает README.md файлы установленных расширений через composer

Будут показаны все установленые расширения в папке **vendor/**.
Также будут показаны **README.md** файлы в корневых подпапках проекта.

## Установка через composer

```json
{
  "require":{
    "infrajs/mdreader":"~1",
	"infrajs/router":"~1"
  }
}
```
## Необходима настройка .htaccess

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ vendor/infrajs/router/index.php [L,QSA]
```

## Использование
После установки нужно открыть в браузере адрес **/-mdreader/**

## Установка без [infrajs/router](https://github.com/infrajs/router)

###composer.json

```json
{
  "require":{
    "infrajs/mdreader":"~1",
  }
}
```

Для работы скрипта в корне проекта рядом с ```vendor/``` потребуется вручную создать папку ```cache/``` с подпапкой ```mem/```. Папка ```cache/mem/``` должна быть доступна для записи.
Настривать **.htaccess** не нужно, скрипт будет работать по более длинному адресу. **/vendor/infrajs/mdreader/**





