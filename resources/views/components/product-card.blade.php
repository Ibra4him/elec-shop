@props(['product'])

<div x-data="{ quickViewOpen: false }" class="group relative bg-white rounded-2xl border border-slate-100 p-3 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1">
    <!-- Image -->
    <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-50">
        <img 
            src="{{ $product->getMedia('product_images')->first()?->getUrl('thumb') ?? 'https://placehold.co/600x600/f8fafc/64748b?text=Produit' }}" 
            alt="{{ $product->name }}"
            class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
        >
        @if($product->base_price < 100)
            <span class="absolute top-2 left-2 bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider">Eco</span>
        @endif
        
        <!-- Favorite Toggle -->
        <livewire:favorite-button :product-id="$product->id" :wire:key="'fav-'.$product->id" />

        <!-- Eye Icon (Quick View) -->
        <button @click.prevent="quickViewOpen = true" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-slate-700 hover:text-blue-600 hover:bg-white transition-all opacity-0 group-hover:opacity-100 shadow-lg z-20 scale-75 group-hover:scale-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
        </button>
    </div>

    <!-- Content -->
    <div class="mt-4 px-1 pb-2">
        <div class="flex justify-between items-start mb-1">
            <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">{{ $product->brand->name ?? 'Générique' }} / {{ $product->category->name }}</p>
        </div>
        <h3 class="text-lg font-bold text-slate-900 line-clamp-1 mb-2">
            <a href="/products/{{ $product->slug }}">
                <span class="absolute inset-0"></span>
                {{ $product->name }}
            </a>
        </h3>
        
        <div class="flex items-center justify-between mt-auto">
            <span class="text-xl font-display font-black text-slate-900 group-hover:text-blue-600 transition-colors">
                {{ number_format($product->base_price, 0, ',', ' ') }} <span class="text-xs">FCFA</span>
            </span>
            <div class="flex items-center gap-1 text-amber-400">
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <span class="text-[10px] font-bold text-slate-400">4.9</span>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <template x-teleport="body">
        <div x-show="quickViewOpen" style="display: none;" class="fixed inset-0 z-[110] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div x-show="quickViewOpen" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="quickViewOpen = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div x-show="quickViewOpen"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative z-10 inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl w-full">
                    
                    <button @click="quickViewOpen = false" class="absolute top-4 right-4 p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors z-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>

                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <!-- Product Image -->
                        <div class="bg-slate-50 p-8 flex items-center justify-center">
                            <img src="{{ $product->getMedia('product_images')->first()?->getUrl('thumb') ?? 'https://placehold.co/600x600/f8fafc/64748b?text=Produit' }}" alt="{{ $product->name }}" class="max-w-full h-auto object-contain rounded-xl mix-blend-multiply">
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-8 lg:p-10 flex flex-col">
                            <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-2">{{ $product->brand->name ?? 'Générique' }} / {{ $product->category->name }}</p>
                            <h2 class="text-2xl font-bold text-slate-900 mb-6">{{ $product->name }}</h2>
                            
                            <div class="mt-auto">
                                <livewire:product-picker :product="$product" :wire:key="'quick-view-'.$product->id" />
                            </div>
                            
                            <div class="mt-6 text-center">
                                <a href="/products/{{ $product->slug }}" class="text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                                    Voir tous les détails du produit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
