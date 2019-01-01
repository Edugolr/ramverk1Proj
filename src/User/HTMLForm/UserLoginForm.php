<?php

namespace Chai17\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Chai17\User\User;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
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
                "legend" => "User Login"
            ],
            [
                "user" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    // "placeholder" => "email",
                ],

                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
     public function callbackSubmit()
    {
         // Get values from the submitted form
         $email       = $this->form->value("user");
         $password      = $this->form->value("password");

         $user = new User();
         $user->setDb($this->di->get("dbqb"));
         $res = $user->verifyPassword($email, $password);

         if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("User or password did not match.". $password. $email);
            return false;
         }
         $session = $this->di->get("session");
         $session->set("login", true);
         $session->set("user", $email);
         $session->set("userID", $user->id);
         $session->set("username", $user->acronym);
         $this->form->addOutput("User " . $user->email . " logged in.");
         return true;
    }
}
