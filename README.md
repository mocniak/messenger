# Installation

As for now implementation covers only functional tests (in Behat)

```bash
composer install
vendor/bin/behat
```

# Shortcuts

- Active channels are hardcoded in a class, not from configuration file, database, or configuration service
- Available Channels are hardcoded in a Factory, it would be better idea to use symfony tags for that 
- Values like email addresses or phone numbers are not validated  
# Usage
- got to url /notify/+12345 to create a user with +12345 phone number and send them a message 