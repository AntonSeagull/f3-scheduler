<?php

namespace F3Scheduler;

use Base;

class F7SchedulePlugin
{
    /**
     * Регистрация плагина в Fat-Free Framework.
     *
     * @param string $cronRoute Путь для запуска задач по расписанию.
     */
    public static function register($cronRoute = '/cron/schedule/run'): void
    {
        $f3 = Base::instance();

        $f3->set('schedule', Schedule::class);

        $f3->route('GET ' . $cronRoute, function (): void {
            Schedule::run();
        });
    }
}



/**
 * @property \F3Scheduler\Schedule $schedule
 */
interface ScheduleAwareF3 {}
