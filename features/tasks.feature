Feature: Task list
  In order to organize my day
  As a user
  I want to keep track of my tasks

Scenario: Task list
  Given I have the following tasks:
    | id | name              | isDone | dueDate    |
  When I create a new task:
    | id | name              | isDone | dueDate    |
    | 1  | Pick groceries    | false  | 18.01.2016 |
  Then I have the following tasks:
    | id | name              | isDone | dueDate    |
    | 1  | Pick groceries    | false  | 18.01.2016 |

Scenario: Tasks can be cloned
  # to be completed

Scenario: Tasks are default unchecked
  # to be completed

Scenario: Tasks have no default due date
  # to be completed