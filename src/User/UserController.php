<?php

namespace Chai17\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Chai17\User\HTMLForm\UserLoginForm;
use Chai17\User\HTMLForm\CreateUserForm;
use Chai17\User\HTMLForm\UpdateUserForm;
use Chai17\Answer\Answer as Answer;
use Chai17\Questions\Questions as Questions;
use Chai17\Comment\Comment as Comment;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UserController implements ContainerInjectableInterface
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
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {

        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("email", $session->get("user"));
        $questions = new Questions;
        $questions->setDb($this->di->get("dbqb"));
        $answers = new Answer;
        $answers->setDb($this->di->get("dbqb"));
        $comments = new Comment;
        $comments->setDb($this->di->get("dbqb"));

        $page->add("user/index", [
            "user" => $user,
            "questions" => $questions,
            "answers" => $answers,
            "comments" => $comments,
        ]);

        return $page->render([
            "title" => "Användare",
        ]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function loginAction() : object
    {
        $page = $this->di->get("page");
        $form = new UserLoginForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A login page",
        ]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateUserForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A create user page",
        ]);
    }

    public function logoutAction() : object
    {
        $page = $this->di->get("page");
        $this->di->session->delete("user");
        $this->di->session->delete("login");
        $form = new UserLoginForm($this->di);
        $form->check();

        $page->add("user/logout", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A create user page",
        ]);
    }

    public function allAction() : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));

        $page->add("user/view-all", [
            "items" => $user->findAll(),
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }

    public function viewAction(int $id) : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->findById($id);
        $questions = new Questions;
        $questions->setDb($this->di->get("dbqb"));
        $answers = new Answer;
        $answers->setDb($this->di->get("dbqb"));
        $comments = new Comment;
        $comments->setDb($this->di->get("dbqb"));
        $page->add("user/view", [
            "user" => $user,
            "questions" => $questions,
            "answers" => $answers,
            "comments" => $comments,
        ]);

        return $page->render([
            "title" => "A collection of items",

        ]);
    }

    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateUserForm($this->di, $id);
        $form->check();

        $page->add("user/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }
}
