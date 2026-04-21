<div class="py-12 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 font-display mb-2">Mes Favoris <span class="text-red-500">❤️</span></h1>
                <p class="text-slate-500 text-lg">Retrouvez tous les produits que vous avez aimés.</p>
            </div>
            <a href="/shop" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                Continuer mes achats
            </a>
        </div>

        @if($favorites->isEmpty())
            {{-- Empty State --}}
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm">
                <div class="w-24 h-24 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Votre liste est vide</h2>
                <p class="text-slate-500 mb-8 max-w-md mx-auto">Vous n'avez pas encore ajouté de produits à vos favoris. Parcourez notre boutique pour trouver votre bonheur !</p>
                <a href="/shop" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                    Découvrir nos produits
                </a>
            </div>
        @else
            {{-- Products Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($favorites as $favorite)
                    <div wire:key="fav-item-{{ $favorite->id }}">
                        <x-product-card :product="$favorite->product" />
                        
                        {{-- Quick Remove Button --}}
                        <div class="mt-3">
                            <button wire:click.prevent="$dispatchTo('favorite-button', 'toggleFavorite', { product: {{ $favorite->product_id }} })" 
                                class="w-full py-2.5 text-xs font-bold text-slate-400 hover:text-red-500 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                Retirer des favoris
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12 text-center text-slate-400 text-sm">
                <p>Vous avez {{ $favorites->count() }} produit(s) en favoris.</p>
            </div>
        @endif
    </div>
</div>
