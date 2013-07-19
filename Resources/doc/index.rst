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

2. Choose the BagManager and the corresponding BagConfiguration you want to use.
Choose one from those in Theodo\Evolution\Bundle\SessionBundle\Manager or use the
``Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerInterface`` to create a new one.

If you want to share session between Symfony1 and Symfony2 :

::

    # app/config/config.yml
    theodo_evolution_session:
        bag_manager:
            class: Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagManager
            configuration_class: Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagConfiguration

If you want to share session between ZendFramework 1.12 and Symfony2, you MUST register the namespaces of your Zend_Session_Namespace objects with the
zf1_namespaces parameter.

::

    # app/config/config.yml
    theodo_evolution_session:
        bag_manager:
            class: Theodo\Evolution\Bundle\SessionBundle\Manager\ZendFramework1\BagManager
            configuration_class: Theodo\Evolution\Bundle\SessionBundle\Manager\ZendFramework1\BagConfiguration
        zf1_namespaces:
              - 'zf_namespace1'
              - 'zf_namespace2'

To access Zend session inside a Symfony controller use $this->get('session')->get('your_zend_namespace')->get('your_variable_name');
(You must replace 'your_zend_namespace' and 'your_variable_name' with your own values).

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
