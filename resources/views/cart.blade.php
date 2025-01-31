@extends('layouts.customer')

@section('title', 'Your Cart')

@section('content')


<!-- Cart Page or Section -->
<div class="container mx-auto mt-8">





 

    <!-- Livewire Cart Component -->
    @livewire('cart-component')
</div>

@endsection