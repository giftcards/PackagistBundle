PackagistBundle
===============

Additional Functionality
------------------------

1. Atlassian Stash Integration

    Should be used with this [Stash Plugin](https://marketplace.atlassian.com/plugins/com.atlassian.stash.plugin.stash-web-post-receive-hooks-plugin)    
    Plugin [Documentation](https://confluence.atlassian.com/display/STASH/POST+service+webhook+for+Stash)
2. Global Maintainer Console Command

Installation
------------

### app/AppKernel.php
Register the new bundle in your AppKernel file

```php
	    new Nelmio\SolariumBundle\NelmioSolariumBundle(),
        new Nelmio\SecurityBundle\NelmioSecurityBundle(),
	    new GiftCards\PackagistBundle\GiftCardsPackagistBundle(),
    );
```

### app/config/config.yml
Configure the stash connection

```YAML
    gift_cards_packagist:
        protocol: ssh
        domain: stash.domain.com
```
        
### app/config/routing.yml
Include the bundle routing file

```YAML
    gift_cards_packagist:
        resource: "@GiftCardsPackagistBundle/Resources/config/routing.yml"
```

