<?php

namespace Chai17\Content;

/**
 *kontroller klass för content
 */
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Chai17\Answer\Answer;
use Chai17\User\User;
use Chai17\Questions\Questions;
use Chai17\Tags\Tags;


class ContentController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    // filter text funktion (använder ramverkets)

    // rendera startsidan inuti content
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $question = new Questions;
        $tags = new Tags;
        $users = new User;
        $answers = new Answer();
        $question->setDb($this->di->get("dbqb"));
        $tags->setDb($this->di->get("dbqb"));
        $users->setDb($this->di->get("dbqb"));
        $answers->setDb($this->di->get("dbqb"));
        $page->add("content/index", [
            "questions" => $question->findTop3("created"),
            "answers" => $answers,
            "tags" => $tags->findTop3("counter"),
            "users" => $users->findTop3("counter")
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }

    public function omActionGet() : object
    {
        $page = $this->di->get("page");


        $page->add("content/om", [
            "items" => "test"
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }
}
