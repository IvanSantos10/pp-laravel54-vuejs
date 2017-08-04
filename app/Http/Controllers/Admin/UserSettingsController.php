<?php

namespace Educ\Http\Controllers\Admin;

use Bootstrapper\Form;
use Educ\Forms\UserSettingsForm;
use Educ\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function edit()
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserSettingsForm::class, [
            'url' => route('admin.users.settings.update'),
            'method' => 'PUT'
        ]);

        return view('admin.users.settings', compact('form'));
    }

    public function update(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserSettingsForm::class);

        if(!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $data['password'] = bcrypt($data['password']);
        \Auth::user()->update($data);
        $request->session()->flash('message', 'Senha alterada com sucesso');
        return redirect()->route('admin.users.settings.edit');
    }
}
