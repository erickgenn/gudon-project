<?php namespace Config;

use Daycry\CronJob\Scheduler;

use App\Commands\SubscriptionRenewal;

class CronJob extends \Daycry\CronJob\Config\CronJob
{
	/**
	 * Directory
	 */
    public $FilePath = WRITEPATH . 'cronJob/';
    
	/**
	 * Filename setting
	 */
	public $FileName = 'jobs';

	/**
	 * Set true if you want save logs
	 */
	public $logPerformance = false;

	/*
    |--------------------------------------------------------------------------
    | Log Saving Method
    |--------------------------------------------------------------------------
    |
    | Set to specify the REST API requires to be logged in
    |
    | 'file'   Save in file
    | 'database'  Save in database
    |
    */
	public $logSavingMethod = 'file';

	/*
    |--------------------------------------------------------------------------
    | Database Group
    |--------------------------------------------------------------------------
    |
    | Connect to a database group for logging, etc.
    |
    */
	public $databaseGroup = 'default';

	/*
    |--------------------------------------------------------------------------
    | Cronjob Table Name
    |--------------------------------------------------------------------------
    |
    | The table name in your database that stores cronjobs
    |
    */
	public $tableName = 'cronjob';

    /*
    |--------------------------------------------------------------------------
	| Cronjobs
	|--------------------------------------------------------------------------
    |
	| Register any tasks within this method for the application.
	| Called by the TaskRunner.
	|
	| @param Scheduler $schedule
	*/
	public function init( Scheduler $schedule )
	{
		// Subscription Renewal
		$schedule->command('Email:SubscriptionRenewal')->cron('35 22 * * *')->named('Email Service Subscription Renewal');
	}
}