<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ mobileFiltersOpen: false }">
    <div class="lg:grid lg:grid-cols-4 lg:gap-8">
        
        <!-- Mobile Filters Overlay -->
        <div x-show="mobileFiltersOpen" class="fixed inset-0 z-[90] lg:hidden bg-slate-900/50 backdrop-blur-sm"
                     x-transition:enter="transition-opacity ease-linear duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="mobileFiltersOpen = false" style="display: none;"></div>

        <!-- Sidebar Filters -->
        <aside :class="mobileFiltersOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-[100] w-full max-w-xs bg-white shadow-xl transition-transform duration-300 lg:static lg:block lg:col-span-1 lg:w-auto lg:shadow-none lg:bg-transparent lg:z-auto overflow-y-auto lg:overflow-visible h-full lg:h-auto p-6 lg:p-0">
            
            <div class="flex items-center justify-between lg:hidden mb-6 pb-6 border-b border-slate-100">
                <h2 class="text-xl font-bold text-slate-900">Filtres</h2>
                <button @click="mobileFiltersOpen = false" class="p-2 text-slate-500 hover:bg-slate-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <div class="space-y-10">
            <!-- Categories -->
            <div x-data="{ open: true }" class="border-b border-slate-100 pb-6">
                <button @click="open = !open" class="flex items-center justify-between w-full mb-4 focus:outline-none group">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 group-hover:text-blue-600 transition-colors">Catégories</h3>
                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="space-y-1">
                    @foreach($categories as $category)
                    <label class="flex items-center group cursor-pointer p-2 -mx-2 rounded-xl hover:bg-slate-50 transition-colors relative">
                        <input type="checkbox" wire:model.live="selectedCategories" value="{{ $category->id }}" class="sr-only peer">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center overflow-hidden mr-3 shrink-0 border border-transparent peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-100 transition-all">
                            @if($category->image)
                                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                            @endif
                        </div>
                        <span class="text-sm font-semibold text-slate-700 peer-checked:text-blue-600 transition-colors">{{ $category->name }}</span>
                        
                        <div class="ml-auto flex items-center">
                            <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded group-hover:bg-slate-200 transition-colors mr-1">{{ $category->products_count }}</span>
                            <!-- Checkmark for selected state -->
                            <div class="absolute right-2 w-5 h-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-200">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Brands -->
            <div x-data="{ open: true }" class="border-b border-slate-100 pb-6">
                <button @click="open = !open" class="flex items-center justify-between w-full mb-4 focus:outline-none group">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 group-hover:text-blue-600 transition-colors">Marques</h3>
                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="space-y-1">
                    @foreach($brands as $brand)
                    <label class="flex items-center group cursor-pointer p-2 -mx-2 rounded-xl hover:bg-slate-50 transition-colors relative">
                        <input type="checkbox" wire:model.live="selectedBrands" value="{{ $brand->id }}" class="sr-only peer">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center overflow-hidden mr-3 shrink-0 border border-transparent peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-100 transition-all">
                            @if($brand->logo_url)
                                <img src="{{ Storage::url($brand->logo_url) }}" alt="{{ $brand->name }}" class="w-full h-full object-contain p-1">
                            @else
                                <span class="text-xs font-bold text-slate-400">{{ substr($brand->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <span class="text-sm font-semibold text-slate-700 peer-checked:text-blue-600 transition-colors">{{ $brand->name }}</span>
                        
                        <div class="ml-auto flex items-center">
                            <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded group-hover:bg-slate-200 transition-colors mr-1">{{ $brand->products_count }}</span>
                            <!-- Checkmark for selected state -->
                            <div class="absolute right-2 w-5 h-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-200">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Price Range -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm sticky top-24">
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 mb-4">Prix Max ({{ number_format($maxPrice, 0, ',', ' ') }} FCFA)</h3>
                <input type="range" wire:model.live="maxPrice" min="0" max="500000" step="1000" class="w-full h-2 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-blue-600">
                <div class="flex justify-between mt-2 text-[10px] font-bold text-slate-400 uppercase">
                    <span>0 FCFA</span>
                    <span>500 000 FCFA</span>
                </div>
            </div>

            <button wire:click="resetFilters()" class="w-full py-3 px-4 border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 transition-colors">
                Réinitialiser les Filtres
            </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3">
            <!-- Toolbar -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 w-full lg:w-auto">
                    <!-- Mobile Filter Button -->
                    <button @click="mobileFiltersOpen = true" class="lg:hidden flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-100 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    </button>
                    
                    <!-- Search Input -->
                    <div class="relative w-full sm:w-64">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Rechercher un produit..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-blue-500">
                        <svg class="absolute left-3 top-2.5 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
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
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                @if($products->hasPages())
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @endif
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
