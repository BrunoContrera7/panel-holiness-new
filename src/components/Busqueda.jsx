import { useState } from 'react';
import { FiX } from 'react-icons/fi';

function Busqueda({ productos, onFiltrar }) {
    const [query, setQuery] = useState('');
    const [filtroActivo, setFiltroActivo] = useState('Todos');
    const [sinResultados, setSinResultados] = useState(false);

    const filtrarProductos = (texto, filtro) => {
      let filtrados = [...productos];

      if (filtro === 'Stock') {
          filtrados = filtrados.filter((producto) => producto.stock > 0);
      } 
      else if (filtro === 'Recientes') {
          filtrados = filtrados
              .filter((producto) => producto.stock >= 1)
              .sort((a, b) => b.id - a.id);
      } 
      else if (filtro !== 'Todos') {
          filtrados = filtrados.filter(
              (producto) =>
                  producto.genero &&
                  producto.genero.toLowerCase() === filtro.toLowerCase()
          );
      }

      if (texto.trim() !== '') {
          filtrados = filtrados.filter((producto) =>
              producto.nombre &&
              producto.nombre.toLowerCase().includes(texto.toLowerCase())
          );
      }

      setSinResultados(filtrados.length === 0);
      onFiltrar(filtrados);
};


    const handleInputChange = (e) => {
        const value = e.target.value;
        setQuery(value);
        filtrarProductos(value, filtroActivo);
    };

    const handleFiltro = (filtro) => {
        setFiltroActivo(filtro);
        filtrarProductos(query, filtro);
    };

    const handleClear = () => {
        setQuery('');
        filtrarProductos('', filtroActivo);
    };

    return (
        <div className="relative max-w-md w-full mx-auto">
            <div className="relative">
                <input
                    type="text"
                    placeholder="Buscar fragancia..."
                    value={query}
                    onChange={handleInputChange}
                    className="w-full px-4 py-2 border border-gray-500 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
                />
                {query && (
                    <button
                        type="button"
                        onClick={handleClear}
                        className="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-700 focus:outline-none"
                        aria-label="Borrar búsqueda"
                    >
                        <FiX size={22} />
                    </button>
                )}
            </div>
            <div className="flex justify-center gap-2 mt-8 flex-wrap">
                {/* ...botones de filtro igual que antes... */}
                <button
                    className={`px-3 py-1 rounded font-semibold border transition ${
                        filtroActivo === 'Todos'
                            ? 'bg-[#0083ad] text-white border-[#0083ad]'
                            : 'bg-white text-[#0083ad] border-[#0083ad] hover:bg-blue-50'
                    }`}
                    onClick={() => handleFiltro('Todos')}
                >
                    Todos
                </button>
                <button
                    className={`px-3 py-1 rounded font-semibold border transition ${
                        filtroActivo === 'Recientes'
                            ? 'bg-[#0083ad] text-white border-[#0083ad]'
                            : 'bg-white text-[#0083ad] border-[#0083ad] hover:bg-blue-50'
                    }`}
                    onClick={() => handleFiltro('Recientes')}
                >
                    Recientes
                </button>
                <button
                    className={`px-3 py-1 rounded font-semibold border transition ${
                        filtroActivo === 'Hombre'
                            ? 'bg-[#0083ad] text-white border-[#0083ad]'
                            : 'bg-white text-[#0083ad] border-[#0083ad] hover:bg-blue-50'
                    }`}
                    onClick={() => handleFiltro('Hombre')}
                >
                    Hombre
                </button>
                <button
                    className={`px-3 py-1 rounded font-semibold border transition ${
                        filtroActivo === 'Mujer'
                            ? 'bg-[#0083ad] text-white border-[#0083ad]'
                            : 'bg-white text-[#0083ad] border-[#0083ad] hover:bg-blue-50'
                    }`}
                    onClick={() => handleFiltro('Mujer')}
                >
                    Mujer
                </button>
                <button
                    className={`px-3 py-1 rounded font-semibold border transition ${
                        filtroActivo === 'Unisex'
                            ? 'bg-[#0083ad] text-white border-[#0083ad]'
                            : 'bg-white text-[#0083ad] border-[#0083ad] hover:bg-blue-50'
                    }`}
                    onClick={() => handleFiltro('Unisex')}
                >
                    Unisex
                </button>
                <button
                    className={`px-3 py-1 rounded font-semibold border transition ${
                        filtroActivo === 'Stock'
                            ? 'bg-[#0083ad] text-white border-[#0083ad]'
                            : 'bg-white text-[#0083ad] border-[#0083ad] hover:bg-blue-50'
                    }`}
                    onClick={() => handleFiltro('Stock')}
                >
                    En Stock
                </button>
            </div>
            {sinResultados && (
                <div className="mt-4 text-center text-red-600 font-semibold">
                    No hay coincidencias para tu búsqueda.
                </div>
            )}
        </div>
    );
}

export default Busqueda;