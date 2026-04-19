@extends('layouts.app')

@section('title', 'Boutique - ElecShop')

@section('content')
    <div class="bg-white border-b border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-slate-900 font-display">Notre Catalogue</h1>
            <p class="mt-2 text-slate-500">Trouvez l'équipement parfait pour votre installation.</p>
        </div>
    </div>

    @livewire('shop-page')
@endsection
