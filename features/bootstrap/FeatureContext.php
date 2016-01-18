<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use AppBundle\Repository\TaskRepository;
use Behat\Behat\Hook\Scope\AfterScenarioScope;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    use Behat\Symfony2Extension\Context\KernelDictionary;


    /**
     * @var TaskRepository $repository
     */
    protected $repository;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager $manager;
     */
    protected $manager;

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
        $this->repository   = $this->getContainer()->get('doctrine')->getManager()->getRepository('AppBundle:Task');
        $this->manager      = $this->getContainer()->get('doctrine')->getManager();


        $allTasks = $this->repository->findAllAsArray();
        $tableTasks = $table->getHash();

        foreach ($allTasks as $k => $task)
        {
            if ($tableTasks[$k] != $task)
            {
                var_dump($task);
                var_dump($tableTasks[$k]);
                throw new Exception('Tasks not even');
            }
        }
    }

    /**
     * @When I create a new task:
     */
    public function iCreateANewTask(TableNode $table)
    {
        foreach($table->getHash() as $row)
        {
            $task = new \AppBundle\Entity\Task();
            $task->setName($row['name']);
            $task->setIsDone(false);

            $this->manager->persist($task);
        }

        $this->manager->flush();
    }

    /**
     * @AfterScenario @database
     */
    public function cleanDB(AfterScenarioScope $scope)
    {
        // @todo install Doctrine Fixtures and use ORM Purger to clean the database
        // see: https://github.com/doctrine/data-fixtures/blob/master/lib/Doctrine/Common/DataFixtures/Purger/ORMPurger.php
    }
}
