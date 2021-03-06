<?php

namespace Chai17\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Chai17\Questions\Questions;
use Chai17\Tags\Tags;
use Chai17\User\User;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Details of the item",
            ],
            [
                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "question" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],

                "tags" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $questions = new Questions();
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $questions->setDb($this->di->get("dbqb"));
        $questions->title  = $this->form->value("title");
        $questions->userID  = $this->di->session->get("userID");
        $questions->question = $this->form->value("question");
        $tagArray = explode(" ", $this->form->value("tags"));
        $tagArray = array_filter($tagArray);
        $questions->tags = implode(" ", $tagArray);
        foreach ($tagArray as $tagArray) {
            $tags = new Tags();
            $tags->setDb($this->di->get("dbqb"));
            $tags->find("tag", $tagArray);
            if (!$tags->tag == $tagArray) {
                $tags->tag = $tagArray;
                $tags->counter = 1;
                $tags->save();
            } else {
                $tags->tag = $tagArray;
                $tags->counter = $tags->counter + 1;
                $tags->save();
            }
        }
        $user->findById($questions->userID);
        $user->counter = $user->counter + 1;
        $questions->save();
        $user->save();
        return true;
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("questions")->send();
    }



    // /**
    //  * Callback what to do if the form was unsuccessfully submitted, this
    //  * happen when the submit callback method returns false or if validation
    //  * fails. This method can/should be implemented by the subclass for a
    //  * different behaviour.
    //  */
    // public function callbackFail()
    // {
    //     $this->di->get("response")->redirectSelf()->send();
    // }
}
