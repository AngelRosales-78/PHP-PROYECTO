use App\Models\Pedido;
use Illuminate\Http\Request;

public function updateEstado(Request $request, $id)
{
    // 1. Validamos que el estado enviado sea uno de los permitidos
    $request->validate([
        'estado' => 'required|in:Pendiente,Procesando,En Camino,Entregado,Cancelado'
    ]);

    // 2. Buscamos el pedido
    $pedido = Pedido::findOrFail($id);

    // 3. Actualizamos el estado
    $pedido->estado = $request->input('estado');
    $pedido->save();

    // 4. Redireccionamos de vuelta con un mensaje de éxito
    return redirect()->back()->with('success', 'El estado del pedido #' . $id . ' se actualizó a: ' . $pedido->estado);
}