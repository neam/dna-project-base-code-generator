Feature: item-related-test-method-classes.feature
  In order to write tests efficiently
  As a developer
  I need to generate item related test method classes
  So that the tests can create and check for the existance of items in the database

  @data:test-motin,coverage:full
  Scenario: try item-related-test-method-classes.feature
    Given I generate item related test method classes for all item types
    Then I should arrive here without errors
