<div>
    @if($variant === 'large')
        <button wire:click.prevent="toggleFavorite" 
            class="flex items-center justify-center gap-2 px-6 py-4 rounded-2xl border-2 transition-all font-bold {{ $isFavorited ? 'border-red-600 bg-red-50 text-red-600' : 'border-slate-100 bg-white text-slate-700 hover:border-red-200 hover:text-red-600' }}">
            <svg class="w-6 h-6 {{ $isFavorited ? 'fill-current' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <span>{{ $isFavorited ? 'Dans mes favoris' : 'En favoris' }}</span>
        </button>
    @else
        <button wire:click.prevent="toggleFavorite" 
            class="absolute top-2 right-2 p-2 rounded-lg shadow-md transition-all duration-300 z-20 {{ $isFavorited ? 'bg-red-50 text-red-500' : 'bg-white text-slate-500 hover:text-red-500' }}">
            <svg class="w-5 h-5 {{ $isFavorited ? 'fill-current' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>
    @endif
</div>
