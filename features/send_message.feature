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
