{{-- REUSABLE HINT BUTTON COMPONENT --}}
<div class="dashboard-hint-container" x-data="{ open: false }">
    <button @click="open = !open" class="hint-toggle-btn shadow-lg" title="Bantuan">
        <i class="bi bi-question-lg" x-show="!open"></i>
        <i class="bi bi-x-lg" x-show="open"></i>
    </button>
    
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 transform translate-y-10 scale-95"
         @click.away="open = false" 
         class="hint-popup card shadow-2xl border-0 p-4">
        <div class="d-flex align-items-center mb-3">
            <div class="hint-icon-circle me-3">
                <i class="bi bi-lightbulb-fill"></i>
            </div>
            <h6 class="fw-bold mb-0" style="color: #3a5a40;">{{ $title }}</h6>
        </div>
        <div class="hint-content text-muted" style="font-size: 0.9rem; line-height: 1.6;">
            {!! $slot !!}
        </div>
    </div>
</div>
