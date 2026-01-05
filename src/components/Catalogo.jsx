import { useState } from "react";

const Catalogo = ({ productos }) => {
  return (
    <div className="py-8 px-2 max-w-7xl mx-auto">
      <div className="flex flex-wrap justify-center gap-12">
        {productos.map((producto) => (
          <ProductoCard key={producto.id} producto={producto} />
        ))}
      </div>
    </div>
  );
};

const ProductoCard = ({ producto }) => {
  const [imgIndex, setImgIndex] = useState(0);
  const [expandirDescripcion, setExpandirDescripcion] = useState(false);
  const sinStock = producto.stock === 0;

  const handlePrev = (e) => {
    e.stopPropagation();
    setImgIndex((prev) =>
      prev === 0 ? producto.imagenes.length - 1 : prev - 1
    );
  };

  const handleNext = (e) => {
    e.stopPropagation();
    setImgIndex((prev) =>
      prev === producto.imagenes.length - 1 ? 0 : prev + 1
    );
  };

  // Genero badge color
  const generoClass =
    producto.genero === "Hombre"
      ? "bg-blue-100 text-blue-700"
      : producto.genero === "Mujer"
      ? "bg-pink-100 text-pink-700"
      : "bg-green-100 text-green-700";

  return (
    <div
      className={`
    w-full max-w-[370px] bg-white rounded-xl shadow-lg flex flex-col justify-between gap-2
    transition-transform duration-300 ease-in-out hover:shadow-xl relative mx-auto border border-gray-200
    ${sinStock ? "opacity-60 grayscale" : ""}
  `}
    >
      {/* Slider de imágenes */}
      <div className="relative w-full h-auto bg-gray-50 flex items-center justify-center rounded-t-xl overflow-hidden">
        {producto.imagenes && producto.imagenes.length > 0 ? (
          <img
            src={producto.imagenes[imgIndex]}
            alt={producto.nombre}
            className="w-full h-full object-contain"
            loading="lazy"
          />
        ) : (
          <div className="w-full h-full flex items-center justify-center text-gray-400">
            Sin imagen
          </div>
        )}
        {producto.imagenes && producto.imagenes.length > 1 && (
          <>
            <button
              onClick={handlePrev}
              className="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-1 shadow"
              aria-label="Anterior"
            >
              <svg className="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" strokeWidth={2} viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
              </svg>
            </button>
            <button
              onClick={handleNext}
              className="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-1 shadow"
              aria-label="Siguiente"
            >
              <svg className="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" strokeWidth={2} viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 5l7 7-7 7" />
              </svg>
            </button>
          </>
        )}
        {sinStock && (
          <div className="absolute inset-0 flex items-center justify-center z-20">
            <div className="w-full bg-gradient-to-r from-gray-700 to-gray-500 bg-opacity-90 py-3 flex justify-center items-center">
              <span className="text-white text-xl font-bold tracking-widest uppercase drop-shadow">
                Sin stock
              </span>
            </div>
          </div>
        )}
      </div>

      <div className="flex justify-between items-center px-2 py-0.5">
        <h2 className="text-[22px] font-bold text-slate-800 mx-2 m-0 px-2 py-1 truncate">
          {producto.nombre}
        </h2>
        {producto.genero && (
          <p className={`w-fit px-2.5 py-0.5 text-[14px] rounded-lg ${generoClass}`}>
            {producto.genero}
          </p>
        )}
      </div>

      <p
        className={`text-[18px] text-slate-600 mx-8 cursor-pointer transition-all duration-200 ${
          expandirDescripcion ? "" : "line-clamp-3"
        }`}
        title={expandirDescripcion ? "" : "Click para ver más"}
        onClick={() => setExpandirDescripcion((prev) => !prev)}
      >
        {producto.descripcion}
      </p>
      <p className="text-[24px] font-bold text-slate-800 mx-6 my-2">
        ${producto.precio ? producto.precio.toLocaleString("es-CO") : "-"}
      </p>
      <div className="flex justify-center mb-4">
    {sinStock ? (
      <a
        href={`https://wa.me/3412783454?text=Hola!%20Quiero%20encargar%20el%20perfume%20${encodeURIComponent(
          producto.nombre
        )}%20del%20genero%20${encodeURIComponent(producto.genero)}%20cuando%20haya%20stock.`}
        target="_blank"
        rel="noopener noreferrer"
        className="
          bg-[#0083ad] text-white w-[20rem] font-semibold
          py-3 px-4 rounded-lg shadow-md transition-all duration-300
          flex justify-center items-center gap-2 mx-6
          hover:bg-[#009fd1] hover:shadow-lg
        "
      >
        Pedir este perfume igualmente
      </a>
    ) : (
      <a
        href={`https://wa.me/3412783454?text=Hola!%20Quiero%20consultar%20por%20el%20perfume%20${encodeURIComponent(
          producto.nombre
        )}%20del%20genero%20${encodeURIComponent(producto.genero)}.`}
        target="_blank"
        rel="noopener noreferrer"
        className="
          bg-gradient-to-r from-green-800 to-green-700 text-white w-[20rem] font-semibold
          py-3 px-4 rounded-lg shadow-md transition-all duration-300
          flex justify-center items-center gap-2 mx-6
          hover:from-green-700 hover:to-green-600 hover:shadow-lg
        "
      >
        Consultar al WhatsApp
      </a>
    )}
  </div>
    </div>
  );
};

export default Catalogo;