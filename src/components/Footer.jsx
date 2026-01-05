import { useState } from "react";
import { FaMapMarkerAlt, FaPhoneAlt, FaInstagram, FaFacebook } from 'react-icons/fa';

function Footer() {
  const [openIndex, setOpenIndex] = useState(null);

  const toggleSection = (index) => {
    setOpenIndex(openIndex === index ? null : index);
  };

  return (
    <>
    <footer id="contacto" className="bg-[#222222] py-8 px-4 text-sm flex flex-col md:flex-row md:justify-around items-start md:items-center gap-6 select-none">
      
      {/* Contenedor textos + logo (en móvil en fila, en desktop en columnas separadas) */}
      <div className="flex flex-row justify-between items-start w-full md:w-auto md:flex-row gap-6 lg:gap-30">
        
        {/* Contenedor de las 3 secciones */}
        <div className="flex flex-col md:flex-row flex-grow lg:gap-30">
          
          {/* Sección 1 */}
          <div className="w-full md:w-auto">
            <h3
              className="text-[18px] text-white mb-4 cursor-pointer md:cursor-default"
              onClick={() => toggleSection(1)}
            >
              NUESTRO EMPRENDIMIENTO ↓
            </h3>
            <div
              className={`w-[200px] transition-all duration-300 overflow-hidden md:overflow-visible ${
                openIndex === 1 ? "max-h-screen" : "max-h-0 md:max-h-screen"
              }`}
            >
              <p className="text-sm text-[#dbdbdb] mb-5">Fragancias exclusivas que capturan la esencia del lujo y la elegancia. Cada aroma cuenta una historia única.</p>
            </div>
          </div>
          
          {/* Sección 2 */}
          <div className="w-full md:w-auto">
            <h3
              className="text-[18px] text-white mb-4 cursor-pointer md:cursor-default"
              onClick={() => toggleSection(0)}
            >
              INFORMACIÓN DE LA TIENDA ↓
            </h3>
            <div
              className={`transition-all duration-300 overflow-hidden md:overflow-visible ${
                openIndex === 0 ? "max-h-screen" : "max-h-0 md:max-h-screen"
              }`}
            >
              <div className="flex items-center gap-3 mb-2">
                <FaMapMarkerAlt className="text-2xl" />
                <a 
                  href="https://www.google.com/maps/place/Av.+Belgrano+1063,+S2138+Carcara%C3%B1a,+Santa+Fe/@-32.8563463,-61. 1572481,17z/data=!4m6!3m5!1s0x95b62524e409f6dd:0x6db43d75aaa9dee0!8m2!3d-32.8561346!4d-61. 1552525!16s%2Fg%2F11kq3s2s10?entry=ttu&g_ep=EgoyMDI1MDgxMy4wIKXMDSoASAFQAw%3D%3D"
                  className="text-sm text-[#dbdbdb] decoration-none">
                    Belgrano 1063, Carcaraña
                </a>
              </div>
              <div className="flex items-center gap-3">
                <FaPhoneAlt className="text-2xl mb-4" />
                <p className="text-sm text-[#dbdbdb] mb-4">+54 9 341 278-3454</p>
              </div>
            </div>
          </div>


          {/* Sección 3 */}
          <div className="w-full md:w-auto">
            <h3
              className="text-[18px] text-white mb-4 cursor-pointer md:cursor-default"
              onClick={() => toggleSection(2)}
            >
              ENCONTRANOS EN ↓
            </h3>
            <div
              className={`transition-all duration-300 overflow-hidden md:overflow-visible ${
                openIndex === 2 ? "max-h-screen" : "max-h-0 md:max-h-screen"
              }`}
            >
              <div className="flex gap-3 mb-4">
                <FaInstagram className="text-2xl" />
                <p className="text-sm text-[#dbdbdb]">
                  <a
                    className="decoration-none"
                    href="https://www.instagram.com/holiness.parfum"
                    rel="noopener noreferrer"
                    target="_blank"
                  >
                    Instagram
                  </a>
                </p>
              </div>
            </div>
          </div>
          {/* Sección 4 */}
          <div className="w-full md:w-auto">
            <h3
              className="text-[18px] text-white mb-4 cursor-pointer md:cursor-default"
              onClick={() => toggleSection(3)}
            >
              ENLACES RÁPIDOS ↓
            </h3>
            <div
              className={`transition-all duration-300 overflow-hidden md:overflow-visible ${
                openIndex === 3 ? "max-h-screen" : "max-h-0 md:max-h-screen"
              }`}
            >
              <div className="flex flex-col mb-2">
                <a 
                  href="#inicio"
                  className="text-sm text-[#dbdbdb] decoration-none mb-2">
                    Inicio
                </a>
                <a 
                  href="#catalogo"
                  className="text-sm text-[#dbdbdb] decoration-none mb-2">
                    Catálogo
                </a>
                <a 
                  href="#contacto"
                  className="text-sm text-[#dbdbdb] decoration-none mb-2">
                    Contacto
                </a>
              </div>
            </div>
          </div>
        </div>

        {/* Logo */}
        <div className="flex-shrink-0">
          <img
            src="/images/logoHoliness.jpg"
            alt="Logo Holiness"
            className="rounded-2xl w-20 h-auto object-contain"
          />
        </div>
      </div>
    </footer>
    <div className="bg-[#222222] pb-4">
        <p className="text-center text-xs text-[#dbdbdb]">
          © {new Date().getFullYear()} Holiness parfum. Todos los derechos reservados. | Emitido por Bruno Contrera
        </p>
      </div>
    </>
  );
}

export default Footer;
