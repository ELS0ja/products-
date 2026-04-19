<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Premium Phone Store</title>

    <script>
      tailwind = { config: { theme: { extend: {
        colors: {
          'bg-deep':'#0f172a',
          'panel':'#0b1220',
          'neon-blue':'#06b6ff',
          'neon-violet':'#8b5cf6',
          'muted':'#9aa6bd'
        },
        boxShadow: { 'soft':'0 8px 30px rgba(2,6,23,0.6)' }
      } } } }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
      body { background: linear-gradient(180deg,#071028 0%, #000000 80%); }
      .glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(6px); }
      .soft-glow { box-shadow: 0 10px 30px rgba(99,102,241,0.06), inset 0 1px 0 rgba(255,255,255,0.02); }
      .price-badge { background: linear-gradient(90deg,#06b6ff,#8b5cf6); box-shadow: 0 8px 24px rgba(139,92,246,0.12); }
      /* Add Product button that blends with the glass background */
      .add-btn{
        background: linear-gradient(90deg, rgba(6,182,255,0.10), rgba(139,92,246,0.08));
        border: 1px solid rgba(255,255,255,0.04);
        color: #e6eef8;
        backdrop-filter: blur(6px);
        padding: .45rem .9rem;
        border-radius: 9999px;
        display:inline-flex;align-items:center;gap:.5rem;font-weight:600
      }
      .add-btn .icon{display:inline-flex;align-items:center;justify-content:center;width:1.25rem;height:1.25rem;border-radius:.45rem;background:linear-gradient(90deg,#06b6ff,#8b5cf6);color:#041025}
      .add-btn:hover{box-shadow:0 10px 40px rgba(99,102,241,0.12), 0 2px 8px rgba(6,182,213,0.06);transform:translateY(-3px)}
      .add-btn:active{transform:translateY(-1px)}
      .pulse { animation: pulse 2s infinite; }
      @keyframes pulse { 0% { transform: scale(1); opacity: 1 } 70% { transform: scale(1.06); opacity: .7 } 100% { transform: scale(1); opacity: 1 } }
    </style>
  </head>
  <body class="antialiased text-slate-100 font-inter">
    <div class="max-w-7xl mx-auto p-6">

      <header class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-3xl font-semibold tracking-tight">Premium Phone Accessories</h1>
          <p class="text-sm text-muted mt-1">Welcome to our curated collection of premium phone accessories
            
          </p>
        </div>

        <div class="flex items-center gap-4">
          <div class="relative">
            <input type="search" placeholder="Search products, cases, chargers..." class="pl-10 pr-4 py-2 rounded-full bg-white/3 text-sm placeholder:text-slate-300 border border-white/6 focus:outline-none focus:ring-2 focus:ring-neon-blue focus:shadow-[0_6px_30px_rgba(6,182,213,0.08)] transition" />
            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-neon-blue">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
          </div>

          <a href="{{ route('products.create') }}" class="add-btn" title="Add Product">
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </span>
            <span class="hidden sm:inline">Add Product</span>
          </a>
        </div>
      </header>

      @if(session('success'))
        <div class="mb-4 p-3 rounded-xl bg-emerald-900/40 border border-emerald-600 text-emerald-200">{{ session('success') }}</div>
      @endif

      <main>
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($products as $p)
            <article x-data class="relative group glass soft-glow rounded-2xl overflow-hidden transform hover:-translate-y-3 transition-shadow duration-300">

              <!-- Image -->
              <div class="relative h-56 bg-gradient-to-br from-slate-900/60 to-black flex items-end">
                <img src="https://source.unsplash.com/collection/190727/800x600?sig={{ $p->id }}" alt="{{ $p->name }}" class="absolute inset-0 w-full h-full object-cover brightness-90" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                <!-- Price badge -->
                <div class="absolute left-4 bottom-4 -translate-y-2 px-3 py-1 rounded-full text-xs font-semibold text-white price-badge">
                  ${{ number_format($p->price,2) }}
                </div>

                <!-- Stock badge -->
                <div class="absolute right-4 top-4 flex items-center gap-2">
                  <div class="w-3 h-3 rounded-full bg-emerald-400 shadow-md pulse"></div>
                  <div class="text-xs text-slate-200/90 bg-black/20 px-2 py-1 rounded-md">In stock</div>
                </div>
              </div>

              <!-- Body -->
              <div class="p-5">
                <h3 class="text-lg font-semibold mb-1">{{ $p->name }}</h3>
                <p class="text-sm text-muted mb-4">{{ $p->description ?? 'Premium accessory crafted with precision and style.' }}</p>

                <div class="flex items-center justify-between gap-3">
                  <div class="flex items-center gap-3">
                    <a href="{{ route('products.show', $p->id) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/6 hover:bg-white/10 transition" title="View">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-neon-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </a>

                    <a href="{{ route('products.edit', $p->id) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/6 hover:bg-white/10 transition" title="Edit">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-neon-violet" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6m2 2v12a2 2 0 01-2 2H7l-4-4V7a2 2 0 012-2h6"/></svg>
                    </a>
                  </div>

                  <form method="POST" action="{{ route('products.destroy', $p->id) }}" onsubmit="return confirm('Delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-lg border border-white/6 bg-transparent hover:bg-red-600/10 transition" title="Delete">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                  </form>
                </div>
              </div>
            </article>
          @endforeach
        </section>
      </main>
    </div>
  </body>
</html>
