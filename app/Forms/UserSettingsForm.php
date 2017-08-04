<?php

namespace Educ\Forms;

use Educ\Models\User;
use Kris\LaravelFormBuilder\Form;

class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('password', 'password', [
                'rules' => 'required|min:6|max:16|confirmed'
            ])
            ->add('password_confirmation', 'password');
    }

    protected function roles()
    {
        return [
            User::ROLE_ADMIN => 'Administrador',
            User::ROLE_TEACHER => 'Professor',
            User::ROLE_STUDANT => 'Aluno'
        ];
    }
}
