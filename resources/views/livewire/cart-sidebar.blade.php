<div
    x-data="{ show: @entangle('isOpen') }"
    x-show="show"
    @keydown.window.escape="show = false"
    class="relative z-[60]"
    x-cloak
>
    <!-- Background backdrop -->
    <div 
        x-show="show"
        x-transition:enter="ease-in-out duration-500"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in-out duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
        @click="show = false"
    ></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div 
                    x-show="show"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="pointer-events-auto w-screen max-w-md"
                >
                    <div class="flex h-full flex-col bg-white shadow-2xl">
                        <!-- Header -->
                        <div class="flex items-center justify-between px-6 py-6 border-b border-slate-100">
                            <h2 class="text-xl font-bold font-display text-slate-900">Mon Panier</h2>
                            <button @click="show = false" class="p-2 text-slate-400 hover:text-slate-500 transition-colors">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 overflow-y-auto px-6 py-6 scrollbar-hide">
                            @if(count($cartItems) > 0)
                                <div class="space-y-8">
                                    @foreach($cartItems as $item)
                                        <div class="flex gap-4 group">
                                            <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl border border-slate-100 bg-slate-50">
                                                <img src="{{ $item->variant->product->getMedia('product_images')->first()?->getUrl('thumb') ?? 'https://placehold.co/200x200?text=Produit' }}" class="h-full w-full object-cover">
                                            </div>

                                            <div class="flex flex-1 flex-col">
                                                <div class="flex justify-between text-sm font-bold text-slate-900">
                                                    <h3 class="line-clamp-1 hover:text-blue-600 transition-colors">
                                                        <a href="/products/{{ $item->variant->product->slug }}">{{ $item->variant->product->name }}</a>
                                                    </h3>
                                                    <p class="ml-4">{{ number_format($item->variant->price, 0, ',', ' ') }} FCFA</p>
                                                </div>
                                                <p class="mt-1 text-xs text-slate-400 font-medium">
                                                    @foreach($item->variant->attributeValues as $val)
                                                        {{ $val->value }}{{ !$loop->last ? ' / ' : '' }}
                                                    @endforeach
                                                </p>
                                                <div class="flex flex-1 items-end justify-between">
                                                    <p class="text-xs font-bold text-slate-600">Qté : {{ $item->quantity }}</p>
                                                    <button wire:click="removeItem({{ $item->id }})" class="text-xs font-bold text-red-500 hover:text-red-600 transition-colors opacity-0 group-hover:opacity-100">
                                                        Supprimer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="h-full flex flex-col items-center justify-center text-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-200">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                    </div>
                                    <p class="text-slate-500 font-medium">Votre panier est vide</p>
                                    <button @click="show = false" class="mt-4 text-blue-600 font-bold text-sm">Continuer mes achats</button>
                                </div>
                            @endif
                        </div>

                        <!-- Footer -->
                        @if(count($cartItems) > 0)
                            <div class="border-t border-slate-100 px-6 py-8 bg-slate-50/50">
                                <div class="flex justify-between text-base font-bold text-slate-900 mb-6">
                                    <span>Total Estimé</span>
                                    <span class="text-xl font-display text-blue-600">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <p class="text-xs text-slate-400 mb-8 italic text-center">Les frais de livraison seront calculés lors de la confirmation.</p>
                                
                                <div class="space-y-4">
                                    <a href="{{ route('checkout') }}" wire:navigate @click="show = false" class="flex w-full items-center justify-center rounded-2xl bg-blue-600 px-6 py-4 text-base font-bold text-white shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                                        Passer à la Caisse
                                    </a>
                                    <button @click="show = false" class="flex w-full items-center justify-center text-sm font-bold text-slate-500 hover:text-slate-600 px-6 py-2">
                                        Continuer les achats
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
