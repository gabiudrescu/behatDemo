Feature: Task list
  In order to organize my day
  As a user
  I want to keep track of my tasks

@database
Scenario: Task list
  Given I have the following tasks:
    | id | name              | isDone |
  When I create a new task:
    | id | name              | isDone |
    | 1  | Pick groceries    | false  |
  Then I have the following tasks:
    | id | name              | isDone |
    | 1  | Pick groceries    | false  |

Scenario: Tasks can be cloned
  # to be completed

Scenario: Tasks are default unchecked
  # to be completed