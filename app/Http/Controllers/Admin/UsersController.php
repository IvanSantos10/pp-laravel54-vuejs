<?php

namespace Educ\Http\Controllers\Admin;

use Educ\EducModelsUser;
use Educ\Forms\UserForm;
use Educ\Http\Controllers\Controller;
use Educ\Models\User;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;

/**
 * Class UsersController
 * @package Educ\Http\Controllers\Admin
 */
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.store'),
            'method' => 'POST'
        ]);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $data['password'] = str_random(6);
        User::create($data);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Educ\EducModelsUser  $educModelsUser
     * @return \Illuminate\Http\Response
     */
    public function show(EducModelsUser $educModelsUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Educ\EducModelsUser  $educModelsUser
     * @return \Illuminate\Http\Response
     */
    public function edit(EducModelsUser $educModelsUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Educ\EducModelsUser  $educModelsUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducModelsUser $educModelsUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Educ\EducModelsUser  $educModelsUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducModelsUser $educModelsUser)
    {
        //
    }
}
