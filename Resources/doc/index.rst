Installation
============

Add the following lines to your composer.json:

::

    "require": {
        ...
        "theodo-evolution/session-bundle": "1.0.*"
    },

And run composer:

::

    php composer.phar update theodo-evolution/session-bundle


Configuration
=============

1. Register the bundles in your app/AppKernel.php:

::

    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            //vendors, other bundles...
            new Theodo\Evolution\Bundle\SessionBundle\TheodoEvolutionSessionBundle(),
        );
    }

2. Choose the BagManager and the corresponding BagConfiguration you want to use:

::

    # app/config/config.yml
    theodo_evolution_session:
        bag_manager:
            class: Theodo\Evolution\Bundle\SessionBundle\Manager\VendorSpecific\Symfony1xBagManager
            configuration_class: Theodo\Evolution\Bundle\SessionBundle\Manager\VendorSpecific\Symfony1xBagConfiguration


Choose one from those in Theodo\Evolution\Bundle\SessionBundle\Manager or use the
``Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerInterface`` to create a new one.

3. In config.yml:

* define your session name (``framework:session:name``) to reuse your legacy cookie name
* define your session path (``framework:session:save_path``)
* define other configuration variables if needed (best method - run ``phpinfo()`` inside your legacy application to find the correct values)

::

    # app/config/config.yml

    framework:
        session:
            name: symfony # the name of your legacy session
            save_path: /var/lib/php5/ # the path vers your legacy session is stored

