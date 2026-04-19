<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product</title>
    <style>body{font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;padding:24px;background:#f6f8fa}form{max-width:600px;background:#fff;padding:18px;border-radius:10px;box-shadow:0 6px 18px rgba(12,18,28,0.06)}label{display:block;margin-bottom:10px}input[type=text],input[type=number],textarea{width:100%;padding:8px;border:1px solid #e6e9ef;border-radius:6px}button{background:#2563eb;color:#fff;border:none;padding:10px 14px;border-radius:8px}</style>
  </head>
  <body>
    <h1>Create Product</h1>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
      @csrf
      <label>Name
        <input type="text" name="name" value="{{ old('name') }}" required maxlength="255">
      </label>
      <label>Price
        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required>
      </label>
      <label>Image
        <input type="file" name="image" accept="image/*">
      </label>
      <label>Description
        <textarea name="description">{{ old('description') }}</textarea>
      </label>
      <div style="margin-top:12px">
        <button type="submit">Create Product</button>
        <a href="{{ route('products.index') }}" style="margin-left:10px">Cancel</a>
      </div>
    </form>
  </body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Create Product</title>
    <script>tailwind = { config: { theme: { extend: {} } } }</script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
      body{background:linear-gradient(180deg,#071028 0%,#000000 80%);font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;color:#e6eef8}
      .glass{background:rgba(255,255,255,0.03);backdrop-filter:blur(6px);}
      .add-btn{background:linear-gradient(90deg, rgba(6,182,255,0.10), rgba(139,92,246,0.08));border:1px solid rgba(255,255,255,0.04);color:#e6eef8;backdrop-filter:blur(6px);padding:.45rem .9rem;border-radius:9999px;display:inline-flex;align-items:center;gap:.5rem;font-weight:600}
      input,textarea{background:transparent;border:1px solid rgba(255,255,255,0.06);padding:.6rem;border-radius:.5rem;color:#e6eef8}
      label{display:block;margin-bottom:.6rem}
      .btn-primary{background:linear-gradient(90deg,#06b6ff,#8b5cf6);color:#041025;padding:.55rem .9rem;border-radius:.6rem}
    </style>
  </head>
  <body>
    <div class="max-w-4xl mx-auto p-6">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-semibold">Add New Product</h1>
          <p class="text-sm text-muted mt-1">Create a premium product listing</p>
        </div>
        <a href="{{ route('products.index') }}" class="add-btn">Back to Store</a>
      </div>

      <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="glass rounded-2xl p-6 soft-glow">
        @csrf
        <div class="grid grid-cols-1 gap-4">
          <label>
            <div class="text-sm text-muted mb-1">Name</div>
            <input type="text" name="name" value="{{ old('name') }}" required maxlength="255">
          </label>

          <label>
            <div class="text-sm text-muted mb-1">Price</div>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" required>
          </label>

          <label>
            <div class="text-sm text-muted mb-1">Image</div>
            <input type="file" name="image" accept="image/*">
          </label>

          <label>
            <div class="text-sm text-muted mb-1">Description</div>
            <textarea name="description" rows="4">{{ old('description') }}</textarea>
          </label>

          <div class="flex items-center gap-3 mt-2">
            <button type="submit" class="btn-primary">Create Product</button>
            <a href="{{ route('products.index') }}" class="text-sm text-muted">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
