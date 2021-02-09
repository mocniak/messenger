Feature: Sending message
  In order to notify a recipient
  As a user
  I can send a message

  Scenario: Sending a message
    Given there is a recipient "John"
    And recipient "John" have configured email notifications
    When I message recipient "John"
    Then recipient "John" have received an email
