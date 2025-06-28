<script setup>
import { router, usePage } from '@inertiajs/vue3'
import Alert from '@/components/Alert.vue'
import AppLayout from '@/layouts/AppLayout.vue'


defineProps({
  reservas: Array,
  
})

const page = usePage()
const flashMessage = page.props.flash?.success

const eliminar = (id) => {
  if (confirm('¿Estás seguro de eliminar esta reserva?')) {
    router.delete(`/reservas/${id}`)
  }
}
</script>

<template>
<app-layout>

  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Reservas</h1>

    <Alert v-if="flashMessage" :message="flashMessage" />

    <div class="mb-4 flex justify-between items-center">
      <button
        @click="$inertia.visit('/reservas/create')"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        + Nueva Reserva
      </button>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
      <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 text-left font-medium text-gray-700">#</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Habitación</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Cliente</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Ingreso</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Salida</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Estado</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Total (Bs)</th>
            <th class="px-4 py-2 text-right font-medium text-gray-700">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-for="(reserva, index) in reservas" :key="reserva.id" class="hover:bg-gray-50">
            <td class="px-4 py-2">{{ index + 1 }}</td>
            <td class="px-4 py-2">{{ reserva.habitacion?.numero }}</td>
            <td class="px-4 py-2">{{ reserva.cliente?.nombre }}</td>
            <td class="px-4 py-2">{{ reserva.fecha_ingreso }}</td>
            <td class="px-4 py-2">{{ reserva.fecha_salida }}</td>
            <td class="px-4 py-2 capitalize">
              <span
                :class="{
                  'bg-yellow-200 text-yellow-800': reserva.estado === 'pendiente',
                  'bg-green-200 text-green-800': reserva.estado === 'confirmada',
                  'bg-blue-200 text-blue-800': reserva.estado === 'finalizada',
                  'bg-red-200 text-red-800': reserva.estado === 'cancelada'
                }"
                class="px-2 py-1 rounded text-xs font-medium"
              >
                {{ reserva.estado }}
              </span>
            </td>
            <td class="px-4 py-2">Bs {{ parseFloat(reserva.total).toFixed(2) }}</td>
            <td class="px-4 py-2 text-right space-x-2">
              <button
                @click="$inertia.visit(`/reservas/${reserva.id}/edit`)"
                class="text-blue-600 hover:underline"
              >
                Editar
              </button>
              <button
                @click="eliminar(reserva.id)"
                class="text-red-600 hover:underline"
              >
                Eliminar
              </button>

             <button @click="$inertia.visit(`/reservas/${reserva.id}`)" 
             class="text-green-400 hover:underline">
               Detalles
             </button>
           </td>
         </tr>
         <tr v-if="!reservas.length">
            <td colspan="8" class="text-center py-6 text-gray-400">
              No hay reservas registradas.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </app-layout>
</template>
