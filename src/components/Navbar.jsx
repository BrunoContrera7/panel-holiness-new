import { Disclosure } from '@headlessui/react'

function Navbar() {
    return (
        <nav className="sticky top-0 z-20 bg-white/60 backdrop-blur-md shadow-sm">
            <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex items-center justify-between h-16">
          {/* Logo */}
                     <div className="flex-shrink-0">
                        <a href="#inicio"><h2 className="text-2xl font-bold text-primary text-black">Holiness parfum</h2></a>
                    </div>

          {/* Navigation Links */}
            <div className="hidden md:block">
                <div className="ml-10 flex items-baseline space-x-8">
                <a href="#inicio" className="text-black font-medium">
                    Inicio
                </a>
                 <a
                    href="#catalogo"
                    className="text-black font-medium"
                 >
                    Catálogo
              </a>
              <a
                href="#contacto"
                className="text-black font-medium"
              >
                Contacto
              </a>
            </div>
          </div>
          {/* Mobile menu button */}
          <div className="md:hidden flex items-center">
            <Disclosure>
              {({ open }) => (
                <>
                  <Disclosure.Button className="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg
                      className="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      {open ? (
                        <path
                          strokeLinecap="round"
                          strokeLinejoin="round"
                          strokeWidth={2}
                          d="M6 18L18 6M6 6l12 12"
                        />
                      ) : (
                        <path
                          strokeLinecap="round"
                          strokeLinejoin="round"
                          strokeWidth={2}
                          d="M4 6h16M4 12h16M4 18h16"
                        />
                      )}
                    </svg>
                  </Disclosure.Button>

                  <Disclosure.Panel className="absolute top-16 right-0 w-full bg-white/95 backdrop-blur-md shadow-lg rounded-b-2xl flex flex-col p-4 space-y-3 text-center">
                    <Disclosure.Button
                      as="a"
                      href="#inicio"
                      className="py-2 rounded-lg text-gray-800 font-medium hover:bg-blue-50 hover:text-blue-600 transition"
                    >
                      Inicio
                    </Disclosure.Button>
                    <Disclosure.Button
                      as="a"
                      href="#catalogo"
                      className="py-2 rounded-lg text-gray-800 font-medium hover:bg-blue-50 hover:text-blue-600 transition"
                    >
                      Catálogo
                    </Disclosure.Button>
                    <Disclosure.Button
                      as="a"
                      href="#contacto"
                      className="py-2 rounded-lg text-gray-800 font-medium hover:bg-blue-50 hover:text-blue-600 transition"
                    >
                      Contacto
                    </Disclosure.Button>
                  </Disclosure.Panel>
                </>
              )}
            </Disclosure>
          </div>
        </div>
      </div>
    </nav>
    );
}

export default Navbar;