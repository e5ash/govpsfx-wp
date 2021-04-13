<?php
define( 'WP_CACHE', true );
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', "govpsfx" );

/** Имя пользователя MySQL */
define( 'DB_USER', "root" );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', "" );

/** Имя сервера MySQL */
define( 'DB_HOST', "localhost" );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

define( 'WPCF7_AUTOP', false );

define('FS_METHOD', 'direct');

define('ALLOW_UNFILTERED_UPLOADS', true);

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'J*vWx3[zZ@p_G]7A8kj_=?{,X@k)h)5iUXA[/5f-RoHXKn!)wN d 105/B4XQ)S3' );
define( 'SECURE_AUTH_KEY',  'dutvwGZ<^iK.[kPXu/p .VR|llg2rt$N|3Wsl.fcrrpXE{wxU6N;>s3]Kp]nV8`;' );
define( 'LOGGED_IN_KEY',    'qds#8Uhd(%Ui<b>qO-+}_0Qk8HJ>V+&rL{5c*B)lIU5hjMg6Bg^dy|5P=Q w,wjh' );
define( 'NONCE_KEY',        '=k&+m&:lUe9<%QT}KU:(384I|q!}UU4~?B5by}i6,[M1zz3()sO{gLTt#%/8vJHm' );
define( 'AUTH_SALT',        '$C8Wi)[U;Gzt$n/{M?kf1LJmE$y@~@i-OMg8L~eT9)Q(&rZ/[>.=cAip5VVT8{@g' );
define( 'SECURE_AUTH_SALT', '%Pa#y4X/e4e?e*^P?}2nI1gK#.Y&|3v{qC]l^?BpMc1`:^vXDCcm .HIzK=^sD z' );
define( 'LOGGED_IN_SALT',   '??5T`tqwyf=gvOjl9PUt9|#bu>N:?yW<]1|E5h4Y4<eeS3Ge1,9dCGqnu3OcuR_s' );
define( 'NONCE_SALT',       '`NSD+7Za F&.eYjWF~TH0l5xOjScAU*qOx#DU(U9q-x%p3WZ<#7AJAmLC%X&@m9S' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
