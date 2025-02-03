@extends('layouts.customer')

@section('title', 'Your Dashboard')

@section('content')


<div class="mt-4">
    {{-- Hero --}}
    <div class="flex items-center gap-x-16 px-6">
        {{-- Text --}}
        <div class="w-1/2 flex flex-col justify-center text-center">
            <h1 class="font-bold text-3xl">Create Or Sell Your Own Art</h1>
            {{-- Buttons --}}
            <div class="mt-6 space-x-4">
                <a href="create" class="bg-black text-white px-4 py-2 rounded-full hover:bg-blue-600 transition duration-300 shadow-md">
                    Sell
                </a>
                <a href="/hub" class="bg-white text-black px-4 py-2 rounded-full hover:bg-blue-600 transition duration-300 shadow-md">
                    Hub
                </a>                
            </div>
        </div>
        {{-- Image --}}
        <div class="w-1/2">
            <img class="w-full rounded-lg" src="{{ asset('images/pexels-steve-1509534.jpg') }}" alt="Image">
        </div>
    </div>
</div>

@include('frontend_component/divider')

{{-- Explanation --}}
<div class="text-justify text-2xl mt-12 mx-10 font-semibold">
    <p>
        Here at ArtemVita, we tend to create a welcoming haven for almost every art lover out there, ranging 
        from casual art enjoyers to passionate painters themselves! Not only do we allow you to browse through a 
        variety of art, but we give you the tools to showcase your own hidden talents, and make a reward off of it too!
    </p>
</div>

@include('frontend_component/divider')

{{-- Steps --}}
<div class="flex flex-col md:flex-row justify-center items-center md:space-x-32 mt-12">
    <div class="w-full md:w-1/4 text-center">
        <img class="w-full rounded-lg mx-auto" src="{{ asset('images/Outline.svg') }}" alt="Image">
        <p class="mt-2 text-center text-2xl">Make an account</p>
    </div>
    <div class="w-full md:w-1/4 text-center">
        <img class="w-full rounded-lg mx-auto" src="{{ asset('images/add_new_file.svg') }}" alt="Image">
        <p class="mt-2 text-center text-2xl">Create Your Product Details</p>
    </div>
    <div class="w-full md:w-1/4 text-center">
        <img class="w-full rounded-lg mx-auto" src="{{ asset('images/sell.svg') }}" alt="Image">
        <p class="mt-2 text-center text-2xl">Sell Your Product</p>
    </div>
</div>
@endsection