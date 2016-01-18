<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use AppBundle\Repository\TaskRepository;

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

        if ($allTasks != $table->getHash())
        {
            var_dump($allTasks);
            var_dump($table->getHash());
            die();
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
}
