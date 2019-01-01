<?php

namespace Chai17\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Chai17\Questions\HTMLForm\CreateForm;
use Chai17\Questions\HTMLForm\EditForm;
use Chai17\Questions\HTMLForm\DeleteForm;
use Chai17\Questions\HTMLForm\UpdateForm;
use Chai17\Answer\Answer;
use Chai17\User\User;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionsController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    //private $data;



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));

        $page->add("questions/crud/view-all", [
            "items" => $questions->findAll(),
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }



    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di);
        $form->check();

        $page->add("questions/crud/create", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a item",
        ]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return object as a response object
     */
    public function deleteAction() : object
    {
        $page = $this->di->get("page");
        $form = new DeleteForm($this->di);
        $form->check();

        $page->add("questions/crud/delete", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Delete an item",
        ]);
    }



    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();

        $page->add("questions/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }

    public function viewAction(int $id) : object
    {
        $page = $this->di->get("page");
        $question = new Questions();
        $answers = new Answer();
        $user = new User();
        $question->setDb($this->di->get("dbqb"));
        $user->setDb($this->di->get("dbqb"));
        $answers->setDb($this->di->get("dbqb"));
        $question->find("id", $id);
        $user->find("id", $question->userID);

        $page->add("questions/crud/view", [
            "question" => $question,
            "answers" => $answers->findAllWhere("questionID = ?", $question->id),
            "user" => $user,
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }
}
