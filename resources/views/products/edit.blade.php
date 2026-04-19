<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;padding:20px}label{display:block;margin-top:8px}</style>
  </head>
  <body>
    <h1>Edit Product</h1>

    @if(session('success'))
      <div style="color:green">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!doctype html>
      <html lang="en">
        <head>
          <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1" />
          <title>Edit Product</title>
          <script>tailwind = { config: { theme: { extend: {} } } }</script>
          <script src="https://cdn.tailwindcss.com"></script>
          <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
          <style>
            body{background:linear-gradient(180deg,#071028 0%,#000000 80%);font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;color:#e6eef8}
            .glass{background:rgba(255,255,255,0.03);backdrop-filter:blur(6px);}
            input,textarea{background:transparent;border:1px solid rgba(255,255,255,0.06);padding:.6rem;border-radius:.5rem;color:#e6eef8}
            label{display:block;margin-bottom:.6rem}
            .btn-primary{background:linear-gradient(90deg,#06b6ff,#8b5cf6);color:#041025;padding:.55rem .9rem;border-radius:.6rem}
          </style>
        </head>
        <body>
          <div class="max-w-4xl mx-auto p-6">
            <div class="flex items-center justify-between mb-6">
              <div>
                <h1 class="text-2xl font-semibold">Edit Product</h1>
                <p class="text-sm text-muted mt-1">Update product details</p>
              </div>
              <a href="{{ route('products.index') }}" class="text-sm text-muted">Back to Store</a>
            </div>

            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="glass rounded-2xl p-6 soft-glow">
              @csrf
              @method('PUT')

              <div class="grid grid-cols-1 gap-4">
                <label>
                  <div class="text-sm text-muted mb-1">Name</div>
                  <input type="text" name="name" value="{{ old('name', $product->name) }}" required maxlength="255">
                </label>

                <label>
                  <div class="text-sm text-muted mb-1">Price</div>
                  <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
                </label>

                <label>
                  <div class="text-sm text-muted mb-1">Image</div>
                  @if($product->image)
                    <div class="mb-2"><img src="{{ asset('storage/' . $product->image) }}" alt="" class="rounded-lg" style="max-width:140px" /></div>
                  @endif
                  <input type="file" name="image" accept="image/*">
                </label>

                <div class="flex items-center gap-3 mt-2">
                  <button type="submit" class="btn-primary">Save</button>
                  <a href="{{ route('products.index') }}" class="text-sm text-muted">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </body>
      </html>
