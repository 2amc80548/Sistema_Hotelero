<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Bienvenido | Sistema Hotelero">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    </Head>
    
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-white text-gray-800 dark:from-gray-900 dark:to-gray-800 dark:text-gray-100">
        <!-- Barra de navegación -->
        <header class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-sm shadow-sm dark:bg-gray-900/80 z-50">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-hotel text-2xl text-blue-600 dark:text-blue-400"></i>
                    <span class="text-xl font-bold text-blue-600 dark:text-blue-400">Hotel Elegance</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <Link :href="route('about')" class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 transition">
                        Sobre Nosotros
                    </Link>
                    <Link :href="route('services')" class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 transition">
                        Servicios
                    </Link>
                    <Link :href="route('contact')" class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 transition">
                        Contacto
                    </Link>
                </div>
                
                <div class="flex items-center space-x-4">
                    <template v-if="$page.props.auth.user">
                        <Link :href="route('dashboard')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Panel de Control
                        </Link>
                    </template>
                    <template v-else>
                        <Link :href="route('login')" class="px-4 py-2 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition">
                            Iniciar Sesión
                        </Link>
                        <Link :href="route('register')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Registrarse
                        </Link>
                    </template>
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="pt-32 pb-20 px-6">
            <div class="container mx-auto flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-12 lg:mb-0 lg:pr-12">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                        Experiencia de <span class="text-blue-600 dark:text-blue-400">lujo</span> y comodidad
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                        Descubre el confort excepcional y el servicio impecable que hacen de Hotel Elegance tu mejor opción para estadías inolvidables.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <Link :href="route('booking')" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center font-medium">
                            Reservar Ahora
                        </Link>
                        <Link :href="route('gallery')" class="px-8 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-800 transition text-center font-medium">
                            Ver Galería
                        </Link>
                    </div>
                    
                    <div class="mt-12 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-2"></i>
                            <span class="font-medium">4.9 (2,345 reseñas)</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-award text-blue-500 mr-2"></i>
                            <span class="font-medium">Premio a la Excelencia 2023</span>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2 relative">
                    <div class="relative rounded-xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Hotel Elegance" 
                             class="w-full h-auto object-cover transition-transform duration-500 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold mb-2">Suite Presidencial</h3>
                            <p class="text-blue-200">Desde $299/noche</p>
                        </div>
                    </div>
                    
                    <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-blue-100 dark:bg-blue-900 rounded-full opacity-30 z-0"></div>
                    <div class="absolute -top-8 -right-8 w-40 h-40 bg-blue-100 dark:bg-blue-900 rounded-full opacity-20 z-0"></div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 bg-white dark:bg-gray-800 px-6">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Nuestros Servicios Exclusivos</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-concierge-bell text-2xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Servicio a la Habitación</h3>
                        <p class="text-gray-600 dark:text-gray-300">Disfruta de nuestro servicio las 24 horas con menú gourmet disponible a cualquier hora.</p>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-spa text-2xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Spa & Bienestar</h3>
                        <p class="text-gray-600 dark:text-gray-300">Relájate con nuestros tratamientos de spa diseñados para tu completo bienestar.</p>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-utensils text-2xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Restaurante Gourmet</h3>
                        <p class="text-gray-600 dark:text-gray-300">Experiencia culinaria excepcional con chefs internacionales y menús estacionales.</p>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-swimming-pool text-2xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Piscina Infinity</h3>
                        <p class="text-gray-600 dark:text-gray-300">Nuestra piscina con vista panorámica es el lugar perfecto para relajarse.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-16 bg-gray-50 dark:bg-gray-900 px-6">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Lo que dicen nuestros huéspedes</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Cliente" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-semibold">María González</h4>
                                <div class="flex">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">"La atención fue excepcional y las instalaciones impecables. Definitivamente volveré en mi próximo viaje."</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Cliente" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-semibold">Carlos Mendoza</h4>
                                <div class="flex">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">"El mejor hotel en el que me he hospedado. La suite tenía una vista espectacular y la cama era muy cómoda."</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Cliente" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-semibold">Ana Rodríguez</h4>
                                <div class="flex">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">"El spa es increíble y el personal muy atento. Perfecto para un fin de semana de relajación."</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-blue-600 text-white px-6">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">¿Listo para una experiencia inolvidable?</h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto text-blue-100">Reserva ahora y obtén un 15% de descuento en tu primera estadía.</p>
                <Link :href="route('booking')" class="px-8 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition font-medium inline-block">
                    Reservar con Oferta
                </Link>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12 px-6">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            <i class="fas fa-hotel text-2xl text-blue-400"></i>
                            <span class="text-xl font-bold">Hotel Elegance</span>
                        </div>
                        <p class="text-gray-400">Ofreciendo experiencias de lujo y confort desde 2005.</p>
                        <div class="flex space-x-4 mt-4">
                            <a href="#" class="text-gray-400 hover:text-white transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Enlaces Rápidos</h4>
                        <ul class="space-y-2">
                            <li><Link :href="route('home')" class="text-gray-400 hover:text-white transition">Inicio</Link></li>
                            <li><Link :href="route('rooms')" class="text-gray-400 hover:text-white transition">Habitaciones</Link></li>
                            <li><Link :href="route('services')" class="text-gray-400 hover:text-white transition">Servicios</Link></li>
                            <li><Link :href="route('gallery')" class="text-gray-400 hover:text-white transition">Galería</Link></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Contacto</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>Av. Principal 123, Ciudad</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone-alt mr-2"></i>
                                <span>+1 234 567 890</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-2"></i>
                                <span>info@hotelelegance.com</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Boletín</h4>
                        <p class="text-gray-400 mb-4">Suscríbete para recibir ofertas exclusivas.</p>
                        <div class="flex">
                            <input type="email" placeholder="Tu correo" class="px-4 py-2 rounded-l-lg w-full text-gray-800">
                            <button class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-r-lg">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2023 Hotel Elegance. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
</template>