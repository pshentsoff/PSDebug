## debug

Небольшая библиотека отладочных инструментов, без претензий. Часто выручает.

-   Contributors: pshentsoff
-   [Donate link](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FGRFBSFEW5V3Y "Please, donate to support project")
-   Tags: wordpress, plugins, posts, events
-   Author: pshentsoff
-   [Author's homepage](http://pshentsoff.ru "Author's homepage")
-   License: Apache License, Version 2.0
-   License URI: http://www.apache.org/licenses/LICENSE-2.0.html

### Versions history & todos:
### Version 0.0.9

#### 0.0.7
-   Прилизан вывод dgb::prelog()
-   dgb::filelog() - ф. записывает сообщение в лог-файл
-   tracer.php - debug back trace utils (untested)
-   dbg::get_caller_info() - Функция возвращает информацию о вызвавшем объекте/функции в виде строки

#### 09.12.2011 7:59:02
-   Просмотреть и добавить в проект библами что находится по закладке print_r - Manual

#### 27.06.2011 17:06:07
-   функции Firebug 1.8: console.timeStamp()
  http://www.softwareishard.com/blog/firebug/firebug-1-8-console-timestamp/

#### 20.06.2011 15:21:18
+   if(empty($var)) $var = 'CJSConsoleDebug: empty variable';

#### 22/05/2011
+   JSCD: оставить слэши в путях
-   JSCD: добить вывод в опере
+   XDebug: xdebug_call_full() - вывод первого элемента, массив уменьшить на вызовы из самих
