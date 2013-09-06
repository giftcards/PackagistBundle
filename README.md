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

### Setup a Stash User in Packagist
Because Stash does not supply the information for the user who triggered the hook, you must create a generic Stash user.
Once this user is created you will need to login and copy the API Token.
The token and the username are used to authenticate Stash with Packagist.
If you're configuring a hook for a repository specific to your user you can use your own credentials.

NOTE: For Stash to update Packagist the Stash user will need to be a maintainer on every package from Stash.


### Configure a Post-Receive hook in Stash
Setup a Post-Receive hook for each repository which is tracked in packagist.
Configure it with a similiar url: `http://<packagist domain>/api/stash?username=<stash user>&apiToken=<stash user token>`
