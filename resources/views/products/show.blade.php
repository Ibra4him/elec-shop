@extends('layouts.app')

@section('title', $product->name . ' - ElecShop')

@section('content')
    <div class="bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex text-xs font-bold uppercase tracking-widest text-slate-400 gap-2 items-center">
                <a href="/" class="hover:text-blue-600">Accueil</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                <a href="/shop" class="hover:text-blue-600">Boutique</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-900">{{ $product->name }}</span>
            </nav>
        </div>
    </div>

    <div class="bg-white py-12 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-16">
                <!-- Image Gallery -->
                <div class="space-y-4">
                    <div class="aspect-square rounded-3xl overflow-hidden bg-slate-50 border border-slate-100">
                        <img 
                            src="{{ $product->getMedia('product_images')->first()?->getUrl() ?? 'https://placehold.co/1000x1000/f8fafc/64748b?text=Produit' }}" 
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product->getMedia('product_images')->skip(1) as $media)
                        <div class="aspect-square rounded-xl overflow-hidden border border-slate-100 cursor-pointer hover:border-blue-600 transition-colors">
                            <img src="{{ $media->getUrl('thumb') }}" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product Info -->
                <div class="mt-10 lg:mt-0">
                    <div class="mb-4">
                        <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1">{{ $product->brand->name ?? 'Générique' }}</p>
                        <h1 class="text-4xl font-extrabold text-slate-900 font-display leading-tight">{{ $product->name }}</h1>
                    </div>

                    <div class="flex items-center gap-4 mb-8">
                        <div class="flex items-center gap-1 text-amber-400">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded">Basé sur 24 avis</span>
                    </div>

                    <div class="prose prose-slate prose-sm text-slate-500 mb-10">
                        <p>{{ $product->description }}</p>
                    </div>

                    <!-- Livewire Picker -->
                    @livewire('product-picker', ['product' => $product])

                    <!-- Additional tabs/info -->
                    <div class="mt-12 pt-8 border-t border-slate-100">
                        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6">Spécifications Techniques</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
                            @foreach($product->specifications as $spec)
                            <div class="flex justify-between py-2 border-b border-slate-50">
                                <span class="text-sm text-slate-500">{{ $spec->key }}</span>
                                <span class="text-sm font-bold text-slate-900">{{ $spec->value }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="bg-slate-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-extrabold text-slate-900 font-display mb-12">Produits Similaires</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
