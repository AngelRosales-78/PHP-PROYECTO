<form action="{{ route('admin.productos.guardar') }}" method="POST" enctype="multipart/form-data">
    @csrf 
    
    <input type="text" name="nombre" required>
    <input type="text" name="categoria" required>
    <input type="number" name="precio" step="0.01" required>
    <input type="number" name="stock" required>
    <input type="file" name="imagen">

    <button type="submit">Guardar Producto</button>
</form>