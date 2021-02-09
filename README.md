# Installation

As for now implementation covers only functional tests (in Behat)

```bash
composer install
vendor/bin/behat
```

# Shortcuts

- Active channels are hardcoded in a class, not from configuration file, database, or configuration service
- Available Channels are hardcoded in a Factory, it would be better idea to use symfony tags for that 
- There are only one endpoint available from the outside world: /notify which sends a sms to the developer 