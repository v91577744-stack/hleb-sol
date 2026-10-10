# Хлеб Соль

Интернет-магазин русской кухни на WordPress.
Учебный проект (ПМ.04, специальность 09.02.07).

## Что реализовано
- Собственная тема `hleb-sol` с фиксированным меню
- Главная страница (hero, о нас, популярные блюда, преимущества, новости)
- Форма обратной связи (WPForms)
- Страница новостей с пагинацией (6 записей на странице)
- Каталог товаров и корзина (WooCommerce)
- Подвал: авторские права, условия использования, ссылки на соцсети
- Google Analytics (плагин GA Google Analytics)

## Стек
WordPress, WooCommerce, WPForms, PHP 7.4+, MySQL, OpenServer.

## Как развернуть
1. Скопировать проект в `OSPanel/domains/shop.rus/`.
2. В phpMyAdmin создать базу и импортировать `db/dump.sql`.
3. Указать данные базы в `wp-config.php`.
4. Открыть `http://shop.rus`, в админке активировать тему «Хлеб Соль».

## Структура темы
`wp-content/themes/hleb-sol/` — style.css, functions.php, header.php, footer.php,
front-page.php, home.php, page.php, single.php, index.php, woocommerce.php.
