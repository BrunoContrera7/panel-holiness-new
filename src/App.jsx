import { useState, useEffect } from 'react';
import './App.css'
import Navbar from './components/Navbar'
import Hero from './components/Hero'
import Informacion from './components/Informacion'
import Busqueda from './components/Busqueda'
import Catalogo from './components/Catalogo'
import Footer from './components/Footer'

function App() {
  const [productos, setProductos] = useState([]);
  const [productosFiltrados, setProductosFiltrados] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    setLoading(true);
    fetch('/data/productos.json')
      .then((res) => {
        if (!res.ok) throw new Error('No se pudo cargar el catálogo.');
        return res.json();
      })
      .then((data) => {
        setProductos(data);
        setProductosFiltrados(data);
        setLoading(false);
      })
      .catch((err) => {
        setError(err.message || "Error cargando productos.");
        setLoading(false);
      });
  }, []);

  const handleFiltrar = (lista) => {
    setProductosFiltrados(lista.length > 0 ? lista : productos);
  };

  return (
    <div>
        <Navbar />
      <main>
        <Hero />
        <Informacion />
        <Busqueda productos={productos} onFiltrar={handleFiltrar} />
        {loading && (
          <div className="flex justify-center items-center py-16">
            <div className="animate-spin rounded-full h-12 w-12 border-t-4 border-blue-500 border-solid mr-4"></div>
            <span className="text-lg text-gray-700">Cargando productos...</span>
          </div>
        )}
        {error && (
          <div className="flex justify-center items-center py-16">
            <span className="text-lg text-red-600 font-semibold">No se pudieron cargar los productos. Por favor, recarga la página.</span>
          </div>
        )}
        {!loading && !error && <Catalogo productos={productosFiltrados} />}
      </main>
      <Footer />
    </div>
  )
}

export default App;