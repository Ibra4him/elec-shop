<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-4 lg:gap-8">
        <!-- Sidebar Filters -->
        <aside class="hidden lg:block lg:col-span-1 space-y-10">
            <!-- Categories -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 mb-4">Catégories</h3>
                <div class="space-y-3">
                    @foreach($categories as $category)
                    <label class="flex items-center group cursor-pointer">
                        <input type="checkbox" wire:model.live="selectedCategories" value="{{ $category->id }}" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-3 text-sm text-slate-600 group-hover:text-blue-600 transition-colors">{{ $category->name }}</span>
                        <span class="ml-auto text-[10px] font-bold text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded">{{ $category->products_count }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Brands -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 mb-4">Marques</h3>
                <div class="space-y-3">
                    @foreach($brands as $brand)
                    <label class="flex items-center group cursor-pointer">
                        <input type="checkbox" wire:model.live="selectedBrands" value="{{ $brand->id }}" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-3 text-sm text-slate-600 group-hover:text-blue-600 transition-colors">{{ $brand->name }}</span>
                        <span class="ml-auto text-[10px] font-bold text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded">{{ $brand->products_count }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Price Range -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm sticky top-24">
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 mb-4">Prix Max ({{ number_format($maxPrice, 0, ',', ' ') }} FCFA)</h3>
                <input type="range" wire:model.live="maxPrice" min="0" max="10000" step="50" class="w-full h-2 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-blue-600">
                <div class="flex justify-between mt-2 text-[10px] font-bold text-slate-400 uppercase">
                    <span>0 FCFA</span>
                    <span>10 000 FCFA</span>
                </div>
            </div>

            <button wire:click="resetFilters()" class="w-full py-3 px-4 border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 transition-colors">
                Réinitialiser les Filtres
            </button>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3">
            <!-- Toolbar -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
                <div class="relative w-full sm:w-64">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Rechercher un produit..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-blue-500">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider hidden sm:inline">Trier par :</span>
                    <select wire:model.live="sortBy" class="bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-blue-500 py-2 pr-8 w-full sm:w-auto">
                        <option value="latest">Nouveautés</option>
                        <option value="price_asc">Prix croissant</option>
                        <option value="price_desc">Prix décroissant</option>
                    </select>
                </div>
            </div>

            <!-- Active Filters (Mobile) -->
            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-24 bg-white rounded-3xl border border-dashed border-slate-200">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Aucun produit trouvé</h3>
                    <p class="text-slate-500 max-w-xs mx-auto">Essayez d'ajuster vos filtres ou de modifier votre recherche.</p>
                </div>
            @endif
        </main>
    </div>
</div>
