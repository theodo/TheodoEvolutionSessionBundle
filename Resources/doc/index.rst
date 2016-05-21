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
            class:                  Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagManager
            configuration_class:    Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagConfiguration

You can pick the manager and the configuration you need among the following list:

 * Symfony1:
   * manager service id: theodo_evolution.session.symfony1.bag_manager
   * configuration service id: theodo_evolution.session.symfony1.bag_manager_configuration
 * CodeIgniter:
   * manager service id: theodo_evolution.session.bag_manager
   * configuration service id: theodo_evolution.session.code_igniter.bag_manager_configuration

You can also create your own bag manager. To do so you only need to create a new service that implements the
``Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerInterface`` interface.

::

    use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerInterface;

    class MyBagManager implements BagManagerInterface
    {
        /**
         * {@inheritdoc}
         */
        public function initialize(SessionInterface $session)
        {
            // do something
        }
    }

3. In config.yml:

* define your session name (``framework:session:name``) to reuse your legacy cookie name
* define your session path (``framework:session:save_path``)
* define other configuration variables if needed (best method - run ``phpinfo()`` inside your legacy application to find the correct values)

::

    # app/config/config.yml

    framework:
        session:
            name: symfony # the name of your legacy session
            save_path: /var/lib/php5/ # the path where your legacy session is stored

Usage
=====

Once the configuration is done, you can access the data from your legacy session in the following way:

::

    {# somewhere in a twig template #}

    {# Get the value of a scalar parameter bag #}
    {% set isAuthenticated = app.request.session.getBag('custom-framework/user/authenticated').get %}

    {# Get a value of a namespaced parameter bag #}
    {% set value = app.request.session.getBag('custom-framework/attributes').get('something') }}

Troubleshooting
===============

Here is a list of causes that may make the session sharing not work.

1. Cookie domain name

Check if the cookie domain for your legacy application and for Symfony2 are the same. If you use two different domains it will not work, you should use subdomains.
To configure the cookie domain name in Symfony2, edit your ```config.yml``` file:

::

    framework:
        ...
        session:

        cookie_domain: .legacy.com

Then do the same in your legacy application and check if it works.

2. Session handler

Make sure that the legacy application and Symfony2 use the same session handler. To know which handler php use you can type the following command in your terminal:

::

    expert@theodo:/vagrant/sf2project: php -i | grep session.save_path
