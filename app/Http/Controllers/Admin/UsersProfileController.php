<?php

namespace Educ\Http\Controllers\Admin;

use Educ\Forms\UserProfileForm;
use Educ\Http\Controllers\Controller;
use Educ\Models\User;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;

/**
 * Class UsersController
 * @package Educ\Http\Controllers\Admin
 */
class UsersProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserProfileForm::class, [
            'url' => route('admin.users.profile.update', ['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user->profile,
            'data' => ['user' => $user]
        ]);

        return view('admin.users.profile.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserProfileForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $user->profile->address ? $user->profile->update($data) : $user->profile()->create($data);
        Session()->flash('message', 'Perfil atulizado com sucesso');
        return redirect()->route('admin.users.profile.update', ['user' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Session()->flash('message', 'Usuário excluído com sucesso');
        return redirect()->route('admin.users.index');
    }
}
