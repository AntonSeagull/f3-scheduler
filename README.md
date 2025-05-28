# F3Scheduler

**F3Scheduler** is a simple cron-style task scheduler plugin for the [Fat-Free Framework (F3)](https://fatfreeframework.com). It allows you to register periodic tasks using cron expressions and execute them via a route or CLI-safe handler.

## 🚀 Features

- Register tasks using cron expressions or helper methods like `everyMinute()`, `hourly()`, `daily()`, etc.
- Supports callable PHP functions and string commands (executed via `php index.php ...`).
- Flexible error handling via `setErrorHandler(...)`.
- Built-in route: `GET /cron/schedule/run` for triggering tasks from CRON.
- Designed for F3 and easy integration.

## 🛠 Installation

```bash
composer require antonchaikin/f3-scheduler
```

## 🧩 Setup

In your app bootstrap:

```php
\F3Scheduler\F7SchedulePlugin::register();
```

This will:

- Register the route `GET /cron/schedule/run`
- Bind `Schedule` to `$f3->schedule` for easy static access

## 🧪 Usage

Register a task:

```php
$f3->schedule::everyMinute(function () {
    echo "Run every minute!";
});
```

Register a shell command:

```php
$f3->schedule::daily("clear-cache");
```

Custom cron:

```php
$f3->schedule::on("0 0 1 * *", fn() => echo "Run every 1st of month!");
```

Set error handler:

```php
$f3->schedule::setErrorHandler(function ($e) {
    error_log("[SCHEDULE ERROR] " . $e->getMessage());
});
```

Trigger tasks manually (e.g. from cron job):

```bash
curl https://your-app.com/cron/schedule/run
```

## ⏰ System Cron Setup

To run scheduled tasks every minute, add the following line to your server's crontab:

```bash
* * * * * curl -s https://your-app.com/cron/schedule/run > /dev/null 2>&1
```

Make sure the route `/cron/schedule/run` is publicly accessible or secured via IP/user-agent as needed.

## 📚 Available Methods

- `everyMinute(callable|string)`
- `everyFiveMinute(callable|string)`
- `everyTenMinutes(callable|string)`
- `everyFifteenMinutes(callable|string)`
- `everyThirtyMinutes(callable|string)`
- `hourly(callable|string)`
- `daily(callable|string)`
- `dailyNoon(callable|string)`
- `weekly(callable|string)`
- `monthly(callable|string)`
- `on(string cronExpression, callable|string)`

## 🧠 Notes

- String tasks will be executed using `php ./index.php {your-command}`.
- The route `/cron/schedule/run` accepts only bot/cron-like User-Agents by default. CLI is always allowed.

## 📄 License

MIT © Anton Chaikin
