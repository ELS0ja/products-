<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>AI Control — Dashboard</title>

  <!-- Tailwind CDN with config -->
  <script>
    tailwind = { config: {
      theme: {
        extend: {
          colors: {
            'bg-900': '#0f172a',
            'panel': '#0b1220',
            'neon-blue': '#06b6ff',
            'neon-violet': '#8b5cf6',
            'muted': '#98a0b3'
          },
          boxShadow: {
            'neon': '0 8px 30px rgba(99,102,241,0.08), 0 2px 6px rgba(6,182,213,0.04)'
          },
          backdropBlur: {
            xs: '2px'
          }
        }
      }
    } }
  </script>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Alpine for interactivity -->
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <!-- Chart.js for charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    /* extra polish */
    body { background: linear-gradient(180deg,#071025 0%, #0b1220 60%); }
    .glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(6px); }
    .glow { box-shadow: 0 8px 30px rgba(99,102,241,0.08), inset 0 1px 0 rgba(255,255,255,0.02); }
    .neon-text { text-shadow: 0 0 8px rgba(6,182,213,0.12), 0 0 20px rgba(139,92,246,0.04); }
    .btn-gradient { background: linear-gradient(90deg,#06b6ff 0%,#8b5cf6 100%); }
    .btn-gradient:hover { filter: saturate(1.05) brightness(1.03); transform: translateY(-2px); }
    .sidebar-scroll { scrollbar-width: thin; }
    .table-row:hover { background: rgba(255,255,255,0.02); transform: translateY(-2px); }
  </style>
</head>
<body class="min-h-screen text-sky-100 font-sans">
  <div x-data="dashboard()" class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside x-bind:class="{ 'w-20': collapsed, 'w-64': !collapsed }" class="glass transition-all duration-300 h-full p-4 border-r border-white/6">
      <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-br from-neon-blue to-neon-violet text-black font-bold">AI</div>
          <div class="hidden md:block">
            <div class="text-sm font-semibold">AI Control</div>
            <div class="text-xs text-muted">Control Panel</div>
          </div>
        </div>
        <button @click="collapsed = !collapsed" class="p-2 rounded-md hover:bg-white/2">
          <svg class="w-5 h-5 text-sky-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/></svg>
        </button>
      </div>

      <nav class="mt-4 sidebar-scroll overflow-auto h-[calc(100%-160px)]">
        <ul class="space-y-2">
          <li>
            <a href="#" class="flex items-center gap-3 p-2 rounded-lg hover:bg-white/2 transition-colors">
              <svg class="w-5 h-5 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18"/></svg>
              <span class="hidden md:inline">Overview</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center gap-3 p-2 rounded-lg hover:bg-white/2 transition-colors">
              <svg class="w-5 h-5 text-neon-violet" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6M9 7h6"/></svg>
              <span class="hidden md:inline">Products</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center gap-3 p-2 rounded-lg hover:bg-white/2 transition-colors">
              <svg class="w-5 h-5 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17a4 4 0 01-4-4V7a4 4 0 014-4h2a4 4 0 014 4v6a4 4 0 01-4 4h-2z"/></svg>
              <span class="hidden md:inline">Analytics</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="mt-auto hidden md:block">
        <div class="text-xs text-muted mb-2">Status</div>
        <div class="flex items-center gap-2">
          <span class="inline-block w-3 h-3 rounded-full bg-green-400 shadow-sm"></span>
          <div class="text-sm">Online</div>
        </div>
      </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 overflow-auto">
      <!-- Topbar -->
      <header class="sticky top-0 z-20 glass backdrop-blur-xs border-b border-white/6 px-6 py-3">
        <div class="flex items-center justify-between gap-4">
          <div class="flex items-center gap-4">
            <button @click="collapsed = !collapsed" class="md:hidden p-2 rounded-md hover:bg-white/2">
              <svg class="w-6 h-6 text-sky-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="relative">
              <input type="search" placeholder="Search AI commands, products..." class="pl-10 pr-4 py-2 rounded-full bg-transparent border border-white/6 text-sm w-96 focus:outline-none" />
              <div class="absolute left-3 top-1/2 -translate-y-1/2 text-muted">
                <svg class="w-4 h-4 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              </div>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="text-sm text-muted hidden sm:block">Welcome, Operator</div>
            <div class="relative" x-data="{ open:false }">
              <button @click="open = !open" class="flex items-center gap-2 p-2 rounded-full bg-white/2">
                <img src="https://ui-avatars.com/api/?name=OP&background=7c3aed&color=fff" class="w-8 h-8 rounded-full" />
                <span class="hidden md:inline">OP</span>
              </button>
              <div x-show="open" @click.outside="open=false" x-transition class="absolute right-0 mt-2 w-48 bg-panel rounded-md shadow-lg glass p-2">
                <a href="#" class="block px-2 py-2 rounded hover:bg-white/3">Profile</a>
                <a href="#" class="block px-2 py-2 rounded hover:bg-white/3">Settings</a>
                <a href="#" class="block px-2 py-2 rounded hover:bg-white/3">Sign out</a>
              </div>
            </div>
          </div>
        </div>
      </header>

      <section class="p-6">
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
          <div class="glass rounded-xl p-4 glow">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-sm text-muted">Active Models</div>
                <div class="text-2xl font-bold neon-text" x-text="counters.models">0</div>
              </div>
              <div class="icon-box">M</div>
            </div>
          </div>

          <div class="glass rounded-xl p-4 glow">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-sm text-muted">Requests / min</div>
                <div class="text-2xl font-bold neon-text" x-text="counters.rpm">0</div>
              </div>
              <div class="icon-box">R</div>
            </div>
          </div>

          <div class="glass rounded-xl p-4 glow">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-sm text-muted">Revenue</div>
                <div class="text-2xl font-bold neon-text" x-text="counters.revenue">$0</div>
              </div>
              <div class="icon-box">$</div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div class="lg:col-span-2">
            <div class="glass rounded-xl p-4 glow mb-6">
              <div class="flex items-center justify-between mb-4">
                <div class="text-lg font-semibold">Traffic Overview</div>
                <div class="text-sm text-muted">Live metrics</div>
              </div>
              <canvas id="chartLine" height="160"></canvas>
            </div>

            <div class="glass rounded-xl p-4 glow">
              <div class="text-lg font-semibold mb-3">Products Table</div>
              <div class="overflow-auto">
                <table class="w-full text-sm table-auto">
                  <thead>
                    <tr class="text-left text-muted text-xs uppercase">
                      <th class="p-3">Name</th>
                      <th class="p-3">Price</th>
                      <th class="p-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="align-top">
                    @foreach($products as $p)
                      <tr class="table-row transition-transform duration-150">
                        <td class="p-3">{{ $p->name }}</td>
                        <td class="p-3">${{ number_format($p->price,2) }}</td>
                        <td class="p-3">
                          <a class="btn btn-secondary text-xs" href="{{ route('products.show', $p->id) }}">View</a>
                          <a class="btn btn-primary text-xs" href="{{ route('products.edit', $p->id) }}">Edit</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <aside>
            <div class="glass rounded-xl p-4 glow mb-6">
              <div class="text-lg font-semibold mb-3">Quick Insights</div>
              <ul class="space-y-3 text-sm text-muted">
                <li>Top product: <span class="text-sky-100">Phone Case</span></li>
                <li>Conversion: <span class="text-sky-100">3.8%</span></li>
                <li>Latency: <span class="text-sky-100">42ms</span></li>
              </ul>
            </div>

            <div class="glass rounded-xl p-4 glow">
              <div class="text-lg font-semibold mb-3">Actions</div>
              <div class="flex flex-col gap-3">
                <a class="btn btn-gradient text-black text-sm" href="#">Deploy Model</a>
                <a class="btn btn-secondary text-sm" href="#">Sync Data</a>
              </div>
            </div>
          </aside>
        </div>
      </section>
    </main>
  </div>

<script>
  function dashboard(){
    return {
      collapsed:false,
      counters: { models:0, rpm:0, revenue:0 },
      init(){
        // animate counters
        this.animateCounter('models', 12, 1200);
        this.animateCounter('rpm', 842, 1200);
        this.animateCounter('revenue', 12490, 1200, true);

        // init chart
        const ctx = document.getElementById('chartLine').getContext('2d');
        const gradient = ctx.createLinearGradient(0,0,0,300);
        gradient.addColorStop(0, 'rgba(99,102,241,0.6)');
        gradient.addColorStop(1, 'rgba(6,182,213,0.04)');

        new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul'],
            datasets: [{
              data: [120,200,150,300,260,380,420],
              borderColor: '#06b6ff',
              backgroundColor: gradient,
              fill: true,
              tension: 0.4,
              pointRadius: 0
            }]
          },
          options: {
            responsive:true,
            plugins:{legend:{display:false}},
            scales:{
              x:{display:true,ticks:{color:'rgba(255,255,255,0.6)'}},
              y:{display:true,ticks:{color:'rgba(255,255,255,0.6)'}}
            }
          }
        });
      },
      animateCounter(key, to, ms, currency=false){
        const start = 0; const duration = ms; let startTime = null;
        const step = (timestamp) => {
          if (!startTime) startTime = timestamp;
          const progress = Math.min((timestamp-startTime)/duration,1);
          const value = Math.floor(progress * (to-start) + start);
          this.counters[key] = currency ? `$${value}` : value;
          if (progress < 1) window.requestAnimationFrame(step);
        };
        window.requestAnimationFrame(step);
      }
    }
  }
</script>
</body>
</html>