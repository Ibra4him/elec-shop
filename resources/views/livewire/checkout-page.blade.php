<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-slate-900 font-display">Finaliser votre commande</h1>
            <p class="text-slate-500 mt-2">Veuillez remplir les informations ci-dessous pour valider votre achat.</p>
        </div>

        @if (session()->has('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-start">
            <!-- Form Section -->
            <div class="lg:col-span-7 bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                <form wire:submit.prevent="placeOrder" class="space-y-8">
                    <!-- Personal Info -->
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                             <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">1</div>
                             Informations Personnelles
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nom Complet</label>
                                <input type="text" wire:model="name" class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all" placeholder="Jean Dupont">
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                                <input type="email" wire:model="email" class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all" placeholder="jean@example.com">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Téléphone</label>
                                <input type="text" wire:model="phone" class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all" placeholder="+229 XX XX XX XX">
                                @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Info -->
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                             <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">2</div>
                             Détails de Livraison
                        </h2>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Adresse Complète</label>
                            <textarea wire:model="delivery_address" rows="3" class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all" placeholder="Rue, Quartier, Ville, Points de repère..."></textarea>
                            @error('delivery_address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                             <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">3</div>
                             Mode de Paiement
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative flex flex-col p-4 border rounded-2xl cursor-pointer transition-all @if($payment_method == 'cash_on_delivery') border-blue-600 bg-blue-50/50 @else border-slate-200 hover:border-blue-200 @endif">
                                <input type="radio" wire:model="payment_method" value="cash_on_delivery" class="sr-only">
                                <div class="flex items-center gap-3">
                                    <div class="w-5 h-5 border-2 rounded-full flex items-center justify-center @if($payment_method == 'cash_on_delivery') border-blue-600 @else border-slate-300 @endif">
                                        @if($payment_method == 'cash_on_delivery') <div class="w-2.5 h-2.5 bg-blue-600 rounded-full"></div> @endif
                                    </div>
                                    <span class="font-bold text-slate-900">Paiement à la livraison</span>
                                </div>
                                <p class="text-xs text-slate-500 mt-2 ml-8">Payez en espèces dès réception de votre commande.</p>
                            </label>

                            <label class="relative flex flex-col p-4 border rounded-2xl cursor-pointer transition-all @if($payment_method == 'bank_transfer') border-blue-600 bg-blue-50/50 @else border-slate-200 hover:border-blue-200 @endif">
                                <input type="radio" wire:model="payment_method" value="bank_transfer" class="sr-only">
                                <div class="flex items-center gap-3">
                                    <div class="w-5 h-5 border-2 rounded-full flex items-center justify-center @if($payment_method == 'bank_transfer') border-blue-600 @else border-slate-300 @endif">
                                        @if($payment_method == 'bank_transfer') <div class="w-2.5 h-2.5 bg-blue-600 rounded-full"></div> @endif
                                    </div>
                                    <span class="font-bold text-slate-900">Virement Bancaire / Mobile</span>
                                </div>
                                <p class="text-xs text-slate-500 mt-2 ml-8">Envoyez votre paiement directement sur notre compte.</p>
                            </label>
                        </div>
                    </div>

                    <!-- Additional Notes -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Notes Additionnelles (Optionnel)</label>
                        <textarea wire:model="notes" rows="2" class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all" placeholder="Instructions spéciales pour la livraison..."></textarea>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-2xl hover:bg-blue-700 shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:translate-y-0">
                            Confirmer ma Commande
                        </button>
                    </div>
                </form>
            </div>

            <!-- Summary Section -->
            <div class="lg:col-span-5 mt-10 lg:mt-0">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden sticky top-8">
                    <div class="bg-slate-900 p-6 text-white text-center">
                        <h2 class="text-xl font-bold">Résumé de la Commande</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="max-h-96 overflow-y-auto space-y-4 mb-6 pr-2 custom-scrollbar">
                            @foreach($cartItems as $item)
                                <div class="flex gap-4 items-center">
                                    <div class="w-16 h-16 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                                        <img src="{{ $item->variant->product->getFirstMediaUrl('product_images', 'thumb') ?: 'https://placehold.co/200x200?text=Produit' }}" alt="{{ $item->variant->product->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="text-sm font-bold text-slate-900 leading-tight">{{ $item->variant->product->name }}</h3>
                                        <div class="flex items-center justify-between">
                                            <p class="text-xs text-slate-400 font-medium">
                                                @foreach($item->variant->attributeValues as $av)
                                                    {{ $av->attribute->name }}: {{ $av->value }}@if(!$loop->last), @endif
                                                @endforeach
                                                x {{ $item->quantity }}
                                            </p>
                                            <span class="text-sm font-bold text-blue-600">{{ number_format($item->subtotal(), 0, ',', ' ') }} FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-slate-100 pt-6 space-y-3">
                            <div class="flex justify-between text-slate-500">
                                <span>Sous-total</span>
                                <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between text-slate-500">
                                <span>Frais de livraison</span>
                                <span class="text-green-600 font-medium">Gratuit</span>
                            </div>
                            <div class="flex justify-between pt-4 border-t border-slate-100 mt-4">
                                <span class="text-lg font-bold text-slate-900">Total à payer</span>
                                <span class="text-2xl font-black text-blue-600">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>

                        <div class="mt-8 p-4 bg-orange-50 rounded-2xl flex gap-3 items-start border border-orange-100">
                            <svg class="w-5 h-5 text-orange-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-orange-800 leading-relaxed">
                                <strong>Note:</strong> Une fois la commande confirmée, vous recevrez un lien pour confirmer les détails définitifs avec notre équipe via <strong>WhatsApp</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
