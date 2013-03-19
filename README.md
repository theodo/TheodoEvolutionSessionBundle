#README


##What is Theodo Evolution?


Theodo Evolution is a set of tools, methodologies and software components, making the code of a legacy php application more maintainable, easily scalable, secure and fast.

##TheodoEvolutionSessionIntegrationBundle

This bundle provides the legacy session to the sf2 app.

Works for legacy app made with:

* Symfony 1.x

##Installation

###With Symfony 2.0

* 1. Add this in your deps file:

```
[TheodoEvolutionSessionIntegrationBundle]
    git=git@github.com:theodo/SessionIntegrationBundle.git
    version=origin/master
    target=../src/TheodoEvolution/SessionIntegrationBundle
```

* 2. Then execute this command in the root of your project:

```
$ bin/vendors install
```

* 3. Finally, add the bundles in your app/autoload.php:

```php
$loader->registerNamespaces(array(
    
    // Some namespaces
    'TheodoEvolution\\SessionIntegrationBundle'   => __DIR__.'/../src/TheodoEvolution/SessionIntegrationBundle',
));
```

###With Symfony 2.1

Add the following lines to your composer.json:

```json
    "repositories": [
        ...
        {
            "type":"vcs",
            "url":"git@github.com:theodo/SessionIntegrationBundle.git"
        }
        ...
    ],
    "require": {
        ...
        "theodo/evolution-session-integration-bundle": "dev-session-integration-bundle"
        ...
    },

```

##Configuration

* Add the bundles in your app/AppKernel.php:

```php
public function registerBundles()
{
    $bundles = array(
        //vendors, other bundles...
        new Theodo\Evolution\Bundle\SessionIntegrationBundle\TheodoEvolutionSessionIntegrationBundle(),
    );
}
```

* Require the configuration file:

```yaml
# app/config/config.yml
imports:
    - { resource: "@TheodoEvolutionSessionIntegrationBundle/Resources/config/services/session.yml" }
```

* Register a BagManager as a parameter named `evolution.session.bag_manager.class`:
  choose from existing ones (in Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager)
  or use the `Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager\BagManagerInterface` to create a new one
* Register the BagManagerConfiguration class as a parameter named `evolution.session.bag_manager_configuration.class`
* Define your session name in config.yml (`framework:session:name`) to reuse your legacy cookie name
* Define your session path (`framework:session:session_path`) and other configuration variables if needed (best method - make a `phpinfo()` inside your legacy application to find the correct values)

## HowTo

**TODO**: Test the service on another legacy project.

Tip: look at the [Tests](git@github.com:theodo/SessionIntegrationBundle/tree/master/Tests)
