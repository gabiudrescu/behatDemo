<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    use Behat\Symfony2Extension\Context\KernelDictionary;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I have the following tasks:
     */
    public function iHaveTheFollowingTasks(TableNode $table)
    {
        $repository = $this->getContainer()->get('doctrine');
        // get all tasks from database
        // compare tableNode with database
        // if they are not equivalent, throw exception
    }

    /**
     * @When I create a new task:
     */
    public function iCreateANewTask(TableNode $table)
    {
        throw new PendingException();
    }
}
