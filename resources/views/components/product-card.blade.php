@props(['product'])

<div class="group relative bg-white rounded-2xl border border-slate-100 p-3 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1">
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
        
        <button class="absolute bottom-2 right-2 p-2 bg-white/90 backdrop-blur rounded-lg shadow-sm opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:bg-blue-600 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
        </button>
    </div>

    <!-- Content -->
    <div class="mt-4 px-1 pb-2">
        <div class="flex justify-between items-start mb-1">
            <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">{{ $product->brand->name ?? 'Générique' }} / {{ $product->category->name }}</p>
        </div>
        <h3 class="text-sm font-semibold text-slate-800 line-clamp-1 mb-2">
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
</div>
