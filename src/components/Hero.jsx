import {Button} from '@headlessui/react'

function Navbar() {
    return(
        <section id="inicio" className="relative min-h-[80vh] flex items-center justify-center overflow-hidden">
      {/* Background Image */}
      <div className="absolute inset-0 z-0">
        <img
          src="/images/imagen-hero.webp"
          alt="Luxury perfume collection"
          className="w-full h-full object-cover"
          loading="lazy"
        />
        <div className="absolute inset-0 bg-black/50"></div>
      </div>

      {/* Content */}
      <div className="relative z-10 text-center text-white px-4 sm:px-6 lg:px-8">
        <h1 className="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 text-balance drop-shadow-lg">
          Catálogo Online
        </h1>
        <p className="text-xl md:text-2xl lg:text-3xl mb-8 font-light text-balance drop-shadow-md">
          Fragancias Exclusivas
        </p>
        <p className="text-lg md:text-xl mb-10 max-w-2xl mx-auto text-pretty opacity-90 drop-shadow-sm">
          Descubre nuestra colección de perfumes de lujo, cada uno elaborado con los mejores ingredientes para
          crear aromas inolvidables.
        </p>
        <button
          size="lg"
          className="bg-white rounded-2xl hover:bg-gray-300 text-black text-primary-foreground px-8 py-3 text-lg transition-all duration-300 hover:scale-105"
          onClick={() => document.getElementById("catalogo")?.scrollIntoView({ behavior: "smooth" })}
        >
          Explorar Colección
        </button>
      </div>
    </section>
    );
}

export default Navbar;