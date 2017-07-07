<?php

namespace App\Providers;

use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'ROAM',
        'product' => 'jaro',
        'street' => "7 Ravenscraig Road…202 Mason's Press",
        'location' => 'Woodstock Cape Town 7925',
        'phone' => '074 103 68 48',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = 'garrethedwards@gmail.com';

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'garrethedwards@gmail.com'
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        Spark::useStripe()->noCardUpFront()->trialDays(10);

        Spark::freePlan()
            ->features([
                'Advert enhancement'
            ]);

        Spark::plan('Basic', 'provider-id-1')
            ->price(10)
            ->features([
                'Advert enhancement'
            ]);
    }
}
