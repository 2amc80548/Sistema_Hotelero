<script setup>
import { Head, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'

const props = defineProps({
  reservas: Array,
  totalIngresos: Number,
  totalReservas: Number,
  clientesFrecuentes: Array,
  habitacionesOcupadas: Array,
  filtros: Object
})

const fechaInicio = ref(props.filtros.fecha_inicio)
const fechaFin = ref(props.filtros.fecha_fin)

const filtrar = () => {
  router.get(route('reportes.index'), {
    fecha_inicio: fechaInicio.value,
    fecha_fin: fechaFin.value
  })
}
</script>

<template>
  <AppLayout>
    <Head title="Reportes" />
    <div class="p-6 max-w-6xl mx-auto">
      <h1 class="text-2xl font-bold mb-4 text-gray-800">📊 Reportes por Fechas</h1>

      <!-- Filtros -->
      <div class="bg-white rounded-lg shadow-sm p-4 mb-4 border border-gray-100">
        <h2 class="text-md font-semibold mb-3">Filtrar por fechas</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
          <div>
            <label class="block text-xs font-medium mb-1">Fecha Inicio</label>
            <input v-model="fechaInicio" type="date" class="input-small">
          </div>
          <div>
            <label class="block text-xs font-medium mb-1">Fecha Fin</label>
            <input v-model="fechaFin" type="date" class="input-small">
          </div>
          <div class="flex items-end">
            <button @click="filtrar" class="btn-filter">
              Filtrar
            </button>
          </div>
        </div>
      </div>

      <!-- Resumen y Clientes -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
          <h2 class="text-md font-semibold mb-2">Resumen del Periodo</h2>
          <div class="text-sm space-y-1">
            <p><span class="font-medium">Total Reservas:</span> {{ totalReservas }}</p>
            <p><span class="font-medium">Total Ingresos:</span> Bs. {{ totalIngresos.toLocaleString() }}</p>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
          <h2 class="text-md font-semibold mb-2">Clientes Frecuentes</h2>
          <ul class="text-sm space-y-1">
            <li v-for="c in clientesFrecuentes.slice(0, 3)" :key="c.id" class="flex justify-between">
              <span class="truncate">{{ c.nombre }}</span>
              <span class="font-medium">{{ c.total_reservas }} reservas</span>
            </li>
            <li v-if="clientesFrecuentes.length === 0" class="text-gray-500 text-sm">No hay datos</li>
          </ul>
        </div>
      </div>

      <!-- Habitaciones y Reservas (en paralelo) -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <!-- Habitaciones más ocupadas -->
        <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
          <h2 class="text-md font-semibold mb-2">Habitaciones Más Ocupadas</h2>
          <ul class="text-sm space-y-2">
            <li v-for="h in habitacionesOcupadas.slice(0, 5)" :key="h.id" class="flex justify-between items-center">
              <div>
                <span class="font-medium">Hab. {{ h.numero }}</span>
                <span class="text-xs text-gray-500 ml-2">({{ h.tipo }})</span>
              </div>
              <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                {{ h.veces_ocupada }} veces
              </span>
            </li>
            <li v-if="habitacionesOcupadas.length === 0" class="text-gray-500 text-sm">No hay datos</li>
          </ul>
        </div>

        <!-- Detalle de Reservas (compacto) -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
          <h2 class="text-md font-semibold p-3 border-b">Reservas Recientes</h2>
          <div class="overflow-y-auto max-h-64">
            <div v-for="reserva in reservas.slice(0, 5)" :key="reserva.id" class="p-3 border-b last:border-0 hover:bg-gray-50">
              <div class="flex justify-between items-start">
                <div>
                  <p class="font-medium text-sm">#{{ reserva.id }} - {{ reserva.cliente.nombre.split(' ')[0] }}</p>
                  <p class="text-xs text-gray-500">Hab. {{ reserva.habitacion.numero }}</p>
                  <p class="text-xs text-gray-500 mt-1">
                    {{ reserva.fecha_ingreso }} → {{ reserva.fecha_salida }}
                  </p>
                </div>
                <span class="bg-green-100 text-green-800 text-sm px-2 py-1 rounded">
                  Bs. {{ reserva.total }}
                </span>
              </div>
            </div>
            <div v-if="reservas.length === 0" class="p-3 text-center text-sm text-gray-500">
              No hay reservas en este periodo
            </div>
          </div>
        </div>
      </div>

      <!-- Tabla completa de reservas (opcional, si aún necesitas espacio) -->
      <div v-if="reservas.length > 5" class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
        <h2 class="text-md font-semibold p-3 border-b">Todas las Reservas</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">ID</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Cliente</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Habitación</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Total</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="reserva in reservas.slice(5)" :key="reserva.id" class="hover:bg-gray-50">
                <td class="px-4 py-2 whitespace-nowrap">{{ reserva.id }}</td>
                <td class="px-4 py-2 whitespace-nowrap">{{ reserva.cliente.nombre.split(' ')[0] }}</td>
                <td class="px-4 py-2 whitespace-nowrap">Hab. {{ reserva.habitacion.numero }}</td>
                <td class="px-4 py-2 whitespace-nowrap">Bs. {{ reserva.total }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.input-small {
  border: 1px solid #e2e8f0;
  border-radius: 0.25rem;
  padding: 0.375rem 0.5rem;
  width: 100%;
  font-size: 0.875rem;
}

.btn-filter {
  background-color: #3b82f6;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.25rem;
  font-size: 0.875rem;
  width: 100%;
  transition: background-color 0.2s;
}

.btn-filter:hover {
  background-color: #2563eb;
}

.max-h-64 {
  max-height: 16rem;
}
</style>