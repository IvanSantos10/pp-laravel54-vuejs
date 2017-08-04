@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar perfil</h3>
            {!!
            form($form->add('salve', 'submit', [
                'attr' => ['class' => 'btn btn-primary btn-block'],
                'label' => $icon = Icon::create('pencil')
            ]))
            !!}
        </div>
    </div>
@endsection