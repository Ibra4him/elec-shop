<div class="space-y-6">
    <!-- Variants Selection -->
    @if($product->variants->count() > 1)
    <div>
        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Sélectionner une option</h3>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
            @foreach($product->variants as $variant)
            <label class="relative flex items-center justify-center rounded-xl border py-3 px-4 text-sm font-semibold uppercase sm:flex-1 cursor-pointer focus:outline-none 
                {{ $selectedVariantId == $variant->id ? 'bg-blue-600 border-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white border-slate-200 text-slate-900 hover:bg-slate-50' }}
                {{ !$variant->is_active || $variant->stock_qty <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                <input type="radio" wire:model.live="selectedVariantId" value="{{ $variant->id }}" class="sr-only" {{ !$variant->is_active ? 'disabled' : '' }}>
                <span>
                    @foreach($variant->attributeValues as $val)
                        {{ $val->value }}{{ !$loop->last ? ' / ' : '' }}
                    @endforeach
                </span>
            </label>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Price Section -->
    <div class="bg-slate-50 rounded-2xl p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Prix de l'article</p>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-900 font-display">
                    {{ number_format($currentVariant ? $currentVariant->price : $product->base_price, 0, ',', ' ') }}
                </span>
                <span class="text-sm font-bold text-slate-500 uppercase">FCFA / Unité</span>
            </div>
            @if($currentVariant && $currentVariant->promo_price)
                <p class="text-sm text-green-600 font-bold mt-1">Économisez {{ number_format($currentVariant->price - $currentVariant->promo_price, 0, ',', ' ') }} FCFA</p>
            @endif
        </div>

        <div class="flex items-center gap-4 bg-white p-2 rounded-xl border border-slate-100 shadow-sm">
            <button wire:click="$set('quantity', {{ max(1, $quantity - 1) }})" class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
            </button>
            <span class="w-8 text-center font-bold text-slate-900">{{ $quantity }}</span>
            <button wire:click="$set('quantity', {{ $quantity + 1 }})" class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            </button>
        </div>
    </div>

    <!-- Stock Status -->
    <div class="flex items-center gap-2">
        @if($currentVariant && $currentVariant->stock_qty > 0)
            <div class="flex items-center gap-1.5 py-1 px-3 bg-emerald-50 text-emerald-700 rounded-full border border-emerald-100">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                <span class="text-[10px] font-bold uppercase tracking-wider">En Stock ({{ $currentVariant->stock_qty }})</span>
            </div>
        @else
            <div class="flex items-center gap-1.5 py-1 px-3 bg-red-50 text-red-700 rounded-full border border-red-100">
                <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                <span class="text-[10px] font-bold uppercase tracking-wider">Rupture de Stock</span>
            </div>
        @endif
    </div>

    <!-- Actions -->
    <div class="flex flex-col sm:flex-row gap-3">
        <button 
            wire:click="addToCart"
            {{ ($currentVariant && $currentVariant->stock_qty > 0) ? '' : 'disabled' }}
            class="flex-1 py-4 bg-slate-900 text-white font-bold rounded-2xl shadow-lg hover:bg-slate-800 transition-all hover:-translate-y-0.5 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
        >
            <span class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                Ajouter
            </span>
        </button>

        <button 
            wire:click="buyNow"
            {{ ($currentVariant && $currentVariant->stock_qty > 0) ? '' : 'disabled' }}
            class="flex-1 py-4 bg-slate-100 text-slate-900 font-bold rounded-2xl border border-slate-200 hover:bg-slate-200 transition-all hover:-translate-y-0.5 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
        >
            <span class="flex items-center justify-center gap-2">
                Acheter
            </span>
        </button>
        
        <div class="flex sm:hidden w-full h-px bg-slate-100 my-1"></div>

        <div class="flex justify-center">
            <livewire:favorite-button :product-id="$product->id" variant="large" :wire:key="'fav-page-'.$product->id" />
        </div>
    </div>
</div>
