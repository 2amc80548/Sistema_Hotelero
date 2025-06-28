<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 flex flex-col">
    <!-- Header con gradiente moderno -->
    <header class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-xl p-4 flex justify-between items-center">
      <!-- Logo y nombre -->
      <div class="flex-1 flex justify-center">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center shadow-lg">
            <span class="text-2xl">🏨</span>
          </div>
          <h1 class="text-2xl font-bold text-white">
           HOTEL CAMIRI
          </h1>
        </div>
      </div>

      <!-- Menú de usuario -->
      <div class="relative flex-1 flex justify-end">
        <button 
          @click="userMenuOpen = !userMenuOpen"
          class="flex items-center space-x-2 group focus:outline-none"
        >
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-indigo-500 flex items-center justify-center text-white font-bold shadow-lg">
            {{ userInitials }}
          </div>
          <span class="hidden md:inline text-white/90 group-hover:text-white transition-all">{{ userName }}</span>
          <svg 
            class="w-4 h-4 text-white/70 transition-transform duration-200" 
            :class="{ 'rotate-180': userMenuOpen }"
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>

        <!-- Dropdown de usuario -->
        <transition
          enter-active-class="transition ease-out duration-100"
          enter-from-class="transform opacity-0 scale-95"
          enter-to-class="transform opacity-100 scale-100"
          leave-active-class="transition ease-in duration-75"
          leave-from-class="transform opacity-100 scale-100"
          leave-to-class="transform opacity-0 scale-95"
        >
          <div 
            v-show="userMenuOpen"
            class="absolute top-12 right-0 w-56 bg-white rounded-lg shadow-2xl z-50 overflow-hidden border border-gray-200"
            @click.outside="userMenuOpen = false"
          >
            <div class="p-4 border-b border-gray-100">
              <p class="text-sm font-medium text-gray-900">{{ userName }}</p>
              <p class="text-xs text-gray-500">{{ userEmail }}</p>
            </div>
            <div class="py-1">
              <button @click="visit('/perfil')" class="menu-dropdown-item">
                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Mi perfil
              </button>
              <button @click="visit('/configuracion')" class="menu-dropdown-item">
                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Configuración
              </button>
            </div>
            <div class="py-1 border-t border-gray-100">
              <button 
                @click="logout"
                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors flex items-center"
              >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Cerrar sesión
              </button>
            </div>
          </div>
        </transition>
      </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
      <!-- Sidebar con gradiente vertical y color llamativo -->
      <aside
        :class="[
          'bg-gradient-to-b from-indigo-800 to-purple-800 shadow-2xl w-64 space-y-2 p-4 transition-all duration-300 ease-in-out',
          sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0',
          'fixed md:relative z-40 h-full'
        ]"
      >
        <div class="p-2 mb-4 border-b border-indigo-700/50">
          <h2 class="text-indigo-300 text-xs uppercase font-bold tracking-widest">MENÚ PRINCIPAL</h2>
        </div>
        
        <nav class="space-y-1">
          <button @click="visit('/dashboard')" class="nav-menu-item" :class="{ 'nav-menu-item-active': $page.url === '/' }">
            <span class="nav-menu-icon">📊</span>
            <span>Dashboard</span>
            <span class="nav-menu-arrow">→</span>
          </button>
          
          <button @click="visit('/habitaciones')" class="nav-menu-item" :class="{ 'nav-menu-item-active': $page.url.startsWith('/habitaciones') }">
            <span class="nav-menu-icon">🛏</span>
            <span>Habitaciones</span>
            <span class="nav-menu-arrow">→</span>
          </button>
          
          <button @click="visit('/clientes')" class="nav-menu-item" :class="{ 'nav-menu-item-active': $page.url.startsWith('/clientes') }">
            <span class="nav-menu-icon">👥</span>
            <span>Clientes</span>
            <span class="nav-menu-arrow">→</span>
          </button>
          
          <button @click="visit('/empleados')" class="nav-menu-item" :class="{ 'nav-menu-item-active': $page.url.startsWith('/empleados') }">
            <span class="nav-menu-icon">👔</span>
            <span>Empleados</span>
            <span class="nav-menu-arrow">→</span>
          </button>
          
          <button @click="visit('/reservas')" class="nav-menu-item" :class="{ 'nav-menu-item-active': $page.url.startsWith('/reservas') }">
            <span class="nav-menu-icon">📅</span>
            <span>Reservas</span>
            <span class="nav-menu-arrow">→</span>
          </button>
          
          <button @click="visit('/facturas')" class="nav-menu-item" :class="{ 'nav-menu-item-active': $page.url.startsWith('/facturas') }">
            <span class="nav-menu-icon">🧾</span>
            <span>Facturas</span>
            <span class="nav-menu-arrow">→</span>
          </button>
          
          <button @click="visit('/inventario')" class="nav-menu-item" :class="{ 'nav-menu-item-active': $page.url.startsWith('/inventario') }">
            <span class="nav-menu-icon">📦</span>
            <span>Inventario</span>
            <span class="nav-menu-arrow">→</span>
          </button>
          
          <button @click="visit('/reportes')" class="nav-menu-item" :class="{ 'nav-menu-item-active': $page.url.startsWith('/reportes') }">
            <span class="nav-menu-icon">📈</span>
            <span>Reportes</span>
            <span class="nav-menu-arrow">→</span>
          </button>
          
          <button @click="visit('/roles')" class="nav-menu-item" :class="{ 'nav-menu-item-active': $page.url.startsWith('/roles') }">
            <span class="nav-menu-icon">🔐</span>
            <span>Roles y Permisos</span>
            <span class="nav-menu-arrow">→</span>
          </button>
        </nav>
      </aside>

      <!-- Contenido Principal -->
      <main class="flex-1 overflow-y-auto bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="p-6 max-w-7xl mx-auto min-h-full">
          <slot />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

const sidebarOpen = ref(false)
const userMenuOpen = ref(false)

// Datos de usuario simulados
const user = {
  name: 'Alex Rivera',
  email: 'alex@hotelharmony.com'
}

const userName = computed(() => user.name)
const userEmail = computed(() => user.email)
const userInitials = computed(() => {
  return user.name.split(' ').map(n => n[0]).join('').toUpperCase()
})

const visit = (url) => {
  router.visit(url)
}

const logout = () => {
  router.post('/logout')
}
</script>

<style>
/* Estilos mejorados para los items del menú de navegación */
.nav-menu-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 0.75rem 1rem;
  border-radius: 0.5rem;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.85);
  background-color: transparent;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  border: none;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}

.nav-menu-item:hover {
  background-color: rgba(255, 255, 255, 0.12);
  color: white;
  transform: translateX(4px);
}

.nav-menu-item-active {
  background-color: rgba(255, 255, 255, 0.18);
  color: white;
  font-weight: 600;
  border-left: 4px solid #a78bfa;
  box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.1);
}

.nav-menu-icon {
  font-size: 1.1rem;
  margin-right: 0.75rem;
  transition: transform 0.3s ease;
  filter: drop-shadow(0 1px 1px rgba(0, 0, 0, 0.2));
}

.nav-menu-item:hover .nav-menu-icon {
  transform: scale(1.15);
}

.nav-menu-arrow {
  color: #c4b5fd;
  opacity: 0;
  transition: all 0.3s ease;
  transform: translateX(-5px);
  font-weight: bold;
}

.nav-menu-item:hover .nav-menu-arrow, 
.nav-menu-item-active .nav-menu-arrow {
  opacity: 1;
  transform: translateX(0);
}

.nav-menu-badge {
  margin-left: auto;
  background: linear-gradient(to right, #8b5cf6, #6366f1);
  color: white;
  font-size: 0.7rem;
  padding: 0.15rem 0.5rem;
  border-radius: 9999px;
  font-weight: 600;
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Estilos mejorados para el dropdown del usuario */
.menu-dropdown-item {
  display: flex;
  align-items: center;
  width: 100%;
  padding: 0.6rem 1rem;
  text-align: left;
  font-size: 0.875rem;
  color: #4b5563;
  background-color: transparent;
  transition: all 0.2s ease;
  border: none;
  cursor: pointer;
}

.menu-dropdown-item:hover {
  background-color: #f5f3ff;
  color: #7c3aed;
}

/* Animación para el badge */
@keyframes pulse {
  0%, 100% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.05); opacity: 0.9; }
}

/* Transiciones suaves */
.transition-all {
  transition-property: all;
}
.duration-300 {
  transition-duration: 300ms;
}

/* Mejoras generales */
.shadow-xl {
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
.shadow-2xl {
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}
</style>