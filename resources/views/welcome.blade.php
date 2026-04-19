@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-white pt-6 pb-20 lg:pt-12 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold leading-5 bg-blue-100 text-blue-800 uppercase tracking-widest mb-4">
                        Équipement Électrique de Luxe
                    </span>
                    <h1 class="text-4xl tracking-tight font-extrabold text-slate-900 sm:text-6xl font-display leading-[1.1]">
                        Illuminez votre intérieur avec <span class="text-blue-600">élégance</span>.
                    </h1>
                    <p class="mt-6 text-base text-slate-500 sm:text-xl lg:text-lg xl:text-xl leading-relaxed">
                        Découvrez notre collection exclusive d'appareillages et luminaires résidentiels. Performance technique et esthétique minimaliste pour votre maison.
                    </p>
                    <div class="mt-10 sm:flex sm:justify-center lg:justify-start gap-4">
                        <a href="/shop" class="flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 md:text-lg shadow-xl shadow-blue-200 transition-all hover:-translate-y-1">
                            Découvrir la Boutique
                        </a>
                        <a href="#featured" class="flex items-center justify-center px-8 py-4 border-2 border-slate-100 text-base font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 md:text-lg transition-all">
                            Voir les Nouveautés
                        </a>
                    </div>
                </div>
                <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <div class="relative mx-auto w-full rounded-3xl shadow-2xl overflow-hidden transform lg:rotate-2 hover:rotate-0 transition-transform duration-700">
                        <img class="w-full" src="/images/hero.png" alt="Electrical residential equipment">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-64 h-64 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>
    </div>

    <!-- Categories Grid -->
    <div class="bg-slate-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 font-display">Nos Catégories</h2>
                    <p class="mt-2 text-slate-500">Explorez notre gamme complète par type d'équipement.</p>
                </div>
                <a href="/shop" class="text-sm font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 group">
                    Tout voir <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7-7" /></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($rootCategories as $category)
                <a href="/shop?category={{ $category->slug }}" class="group relative bg-white p-8 rounded-2xl border border-slate-100 flex flex-col items-center text-center transition-all hover:border-blue-200 hover:shadow-xl hover:shadow-blue-500/5">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        @if($category->icon)
                            @svg($category->icon, 'w-8 h-8')
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $category->name }}</h3>
                    <p class="text-xs text-slate-400 font-medium uppercase tracking-tight">{{ $category->products_count }} Articles</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div id="featured" class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.2em] mb-4 block">Sélection du mois</span>
                <h2 class="text-4xl font-extrabold text-slate-900 font-display mb-4">Produits Mis en Avant</h2>
                <div class="w-16 h-1 bg-blue-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-20 text-center">
                <a href="/shop" class="inline-flex items-center px-10 py-4 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all">
                    Voir Tout le Catalogue
                </a>
            </div>
        </div>
    </div>

    <!-- Trust Section -->
    <div class="bg-slate-900 py-20 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-white font-bold mb-2">Qualité Certifiée</h3>
                    <p class="text-slate-400 text-sm">Normes ISO & NF garanties pour tous nos produits.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-white font-bold mb-2">Livraison Rapide</h3>
                    <p class="text-slate-400 text-sm">Expédition sous 24h partout au Bénin.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <h3 class="text-white font-bold mb-2">Support WhatsApp</h3>
                    <p class="text-slate-400 text-sm">Conseils techniques et commandes simplifiées.</p>
                </div>
            </div>
        </div>
        <!-- Decorative lines -->
        <div class="absolute top-0 right-0 w-full h-full opacity-5 pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 1000 1000" preserveAspectRatio="none">
                <path d="M0,1000 C300,800 400,200 1000,0" stroke="white" fill="none" />
                <path d="M0,800 C400,600 500,100 1000,-100" stroke="white" fill="none" />
            </svg>
        </div>
    </div>
@endsection
