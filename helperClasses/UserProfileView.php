<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 4/29/16
 * Time: 3:02 PM
 */

    class UserProfileView extends Page {
        public function __construct(User $user) {
            $this->html = 'User: ';

                $this->html .= '<br/>&nbsp;&nbsp;&nbsp;&nbsp; First Name: ' . $user->getFirst();
                $this->html .= '<br/>&nbsp;&nbsp;&nbsp;&nbsp; Last Name: ' . $user->getLast();
                $this->html .= '<br/>&nbsp;&nbsp;&nbsp;&nbsp; Email: ' . $user->getEmail();
        }
    }

?>