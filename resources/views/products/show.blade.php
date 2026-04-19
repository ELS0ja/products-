<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
      body{background:linear-gradient(180deg,#071028 0%,#000000 80%);font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;color:#e6eef8}
      .glass{background:rgba(255,255,255,0.03);backdrop-filter:blur(6px);}
    </style>
  </head>
  <body>
    <div class="max-w-4xl mx-auto p-6">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>
          <p class="text-sm text-muted mt-1">Price: ${{ number_format($product->price, 2) }}</p>
        </div>
        <div class="flex items-center gap-3">
          <a href="{{ route('products.index') }}" class="text-sm text-muted">Back</a>
          <a href="{{ route('products.edit', $product->id) }}" class="text-sm text-muted">Edit</a>
        </div>
      </div>

      <div class="glass rounded-2xl p-6">
        @if($product->image)
          <img src="{{ asset('storage/' . $product->image) }}" alt="" class="rounded-lg w-full mb-4" style="max-height:420px;object-fit:cover">
        @else
          <div class="rounded-lg bg-gradient-to-r from-slate-700 to-slate-900 h-56 mb-4 flex items-center justify-center">
            <span class="text-slate-300">No image available</span>
          </div>
        @endif

        <div class="prose text-slate-200">
          <p>{{ $product->description }}</p>
        </div>
      </div>
    </div>
  </body>
 </html>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Product</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;padding:20px}</style>
  </head>
  <body>
    <h1>View Product</h1>
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Price:</strong> {{ number_format($product->price, 2) }}</p>
    <p><a href="{{ route('products.index') }}">Back to list</a></p>
  </body>
</html>
