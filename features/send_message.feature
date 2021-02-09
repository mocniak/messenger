Feature: Sending message
  In order to notify a recipient
  As a user
  I can send a message

  Scenario: Sending an email
    Given there is a recipient "John"
    And recipient "John" have configured email notifications
    When I message recipient "John"
    Then recipient "John" have received an email

  Scenario: Sending a SMS
    Given there is a recipient "John"
    And recipient "John" have configured SMS notifications
    When I message recipient "John"
    Then recipient "John" have received a SMS

  Scenario: Disabling SMS channel
    Given there is a recipient "John"
    And recipient "John" have configured SMS notifications
    And recipient "John" have configured email notifications
    And SMS service is disabled
    When I message recipient "John"
    Then recipient "John" have received an email
    And recipient "John" have NOT received a SMS

  Scenario: Disabling Email channel
    Given there is a recipient "John"
    And recipient "John" have configured SMS notifications
    And recipient "John" have configured email notifications
    And email service is disabled
    When I message recipient "John"
    Then recipient "John" have received a SMS
    And recipient "John" have NOT received an email