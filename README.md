#README


##What is Theodo Evolution?


Theodo Evolution is a set of tools, methodologies and software components, making the code of a legacy php application more maintainable, easily scalable, secure and fast.

##TheodoEvolutionHttpFoundationBundle

This bundle provides the legacy session to the sf2 app.

Works for legacy app made with:

* Symfony 1.0

##Installation

###With Symfony 2.0

* 1. Add this in your deps file:

```
[TheodoEvolutionHttpFoundationBundle]
    git=https://github.com/theodo/theodo-evolution.git
    version=origin/http-foundation-bundle
    target=../src/TheodoEvolution/HttpFoundationBundle
```

* 2. Then execute this command in the root of your project:

```
$ bin/vendors install
```

* 3. Finally, add the bundles in your app/autoload.php:

```php
$loader->registerNamespaces(array(
    
    // Some namespaces
    'TheodoEvolution\\HttpFoundationBundle'   => __DIR__.'/../src/TheodoEvolution/HttpFoundationBundle',
));
```

###With Symfony 2.1

* **TODO**: use composer.
* *Problem*: theodo-evolution is a private repository. Should we use Satis?
* Doc:
  * [Manage package repository with composer](http://getcomposer.org/doc/05-repositories.md#package-2)
  * [Hosting your own packages](http://getcomposer.org/doc/05-repositories.md#hosting-your-own)

##Configuration

### Legacy app made with symfony 1.0

* Add the bundles in your app/AppKernel.php:

```php
public function registerBundles()
{
    $bundles = array(
        //vendors, other bundles...
        new TheodoEvolution\HttpFoundationBundle\TheodoEvolutionHttpFoundationBundle(),
    );
}
```

* Require the configuration file:
```yaml
# app/config/config.yml
imports:
    - { resource: "@TheodoEvolutionHttpFoundationBundle/Resources/config/services/session.yml" }
```
* Choose a BagManager from existing ones or use TheodoEvolution\HttpFoundationBundle\Manager\BagManagerInterface to create a new one
* Register the BagManager class as a parameter named evolution.session.bag_manager.class in your configuration
* Register the BagManagerConfiguration class as a parameter named evolution.session.bag_manager_configuration.class
* Define your session name in config.yml (framework:session:name) to reuse your legacy cookie name

## HowTo

**TODO**: Test the service on another legacy project.

Tip: look at the [Tests](https://github.com/theodo/theodo-evolution/tree/http-foundation-bundle/Tests)
