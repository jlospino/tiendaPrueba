@isset($product->id)
<input type="hidden" name="productId" value="{{$product->id}}" >
@endisset
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" aria-describedby="Nombre" required
            @isset($product->name)
                value="{{ $product->name }}"
            @endisset
            >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Categoria</label>
            <select class="form-control" name="category" required>
                <option value="null">Seleccionar</option>
                @forelse ($categories as $item)
                    @if(isset($product->category_id))
                        <option value="{{ $item->id }}" {{ $item->id == ($product->category_id) ? 'selected' : '' }} > {{ $item->name }}</option>
                    @endif
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Precio</label>
            <input type="number" name="price" class="form-control" aria-describedby="Precio"  required
            @isset($product->price)
                value="{{ $product->price }}"
            @endisset
            >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Unidades Existentes</label>
            <input type="number" name="quantity" class="form-control" aria-describedby="Unidades" required
            @isset($product->quantity)
                value="{{ $product->quantity }}"
            @endisset
            >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Descripción (Max 500 caracteres)</label>
            <textarea class="form-control" name="description" maxlength="500" required>
                @isset($product->description) {{ trim($product->description) }} @endisset
            </textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Unidades Existentes</label>
            <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" @if(empty($product->photo)) required @endif class="custom-file-input" name="photo" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Elegir Archivo</label>
                </div>
              </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Proveedor</label>
            <select class="form-control" name="vendor" required>
                <option value="null">Seleccionar</option>
                @forelse ($vendors as $vendor)
                    @if(isset($product->vendor_id))
                        <option value="{{ $vendor->id }}" {{ $vendor->id == ($product->vendor_id) ? 'selected' : '' }} > {{ $vendor->name }}</option>
                    @endif
                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary px-5">Ir a la página anterior</a>
            <button type="submit" class="btn btn-primary px-5">Guardar</button>
        </div>
    </div>
</div>
