What is Theodo Evolution?
=========================

Theodo Evolution is a set of tools, methodologies and software components, making the code of a legacy php application
more maintainable, easily scalable, secure and fast.

Theodo Evolution's SessionIntegrationBundle
===========================================

This bundle allows a Symfony 2 application to access the legacy session.

Works so far for legacy app made with:

* Symfony 1.x

Installation
============

Add the following lines to your composer.json:

.. code-block::
    "repositories": [
        ...
        {
            "type":"vcs",
            "url":"git@github.com:theodo/TheodoEvolutionSessionIntegrationBundle.git"
        }
    ],
    "require": {
        ...
        "theodo/evolution-session-integration-bundle": "1.0.*"
    },

And run composer:

.. code-block::
    php composer.phar update theodo/evolution-session-integration-bundle


Configuration
=============

* Register the bundles in your app/AppKernel.php:

.. code-block::
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            //vendors, other bundles...
            new Theodo\Evolution\Bundle\SessionIntegrationBundle\TheodoEvolutionSessionIntegrationBundle(),
        );
    }

* Choose the BagManager and the corresponding BagConfiguration you want to use:

.. code-block::
    # app/config/parameters.yml

    ...
    evolution.session.bag_manager.class: Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager\VendorSpecific\Symfony1xBagManager
    evolution.session.bag_manager_configuration.class: Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager\VendorSpecific\Symfony1xBagConfiguration


Choose BagManager from existing ones (in Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager)
or use the `Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager\BagManagerInterface` to create a new one

* In config.yml:
  * define your session name (`framework:session:name`) to reuse your legacy cookie name
  * define your session path (`framework:session:save_path`)
  * define other configuration variables if needed (best method - make a `phpinfo()` inside your legacy application to find the correct values)

.. code-block::
    # app/config/config.yml

    framework:
        ...
        session:
            name: symfony # the name of your legacy session
            save_path: /var/lib/php5/ # the path vers your legacy session is stored

