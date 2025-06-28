<script setup>
import { router } from '@inertiajs/vue3'
import Alert from '@/components/Alert.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { usePage } from '@inertiajs/vue3'
import { defineProps } from 'vue'



defineProps({
  habitaciones: Array
})


const page = usePage()
const flashMessage = page.props.flash?.success

   
const eliminar = (id) => {
  if (confirm('¿Estás seguro de eliminar esta habitación?')) {
    router.delete(`/habitaciones/${id}`)

  }
}
</script>

<template>
<app-layout>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Habitaciones</h1>

<Alert v-if="flashMessage" :message="flashMessage" />

    
    

    <div class="mb-4 flex justify-between items-center">
      <button @click="$inertia.visit('/habitaciones/create')"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Nueva Habitación
      </button>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
      <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 text-left font-medium text-gray-700">N°</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Tipo</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Precio</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Estado</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Piso</th>
            <th class="px-4 py-2 text-right font-medium text-gray-700">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-for="habitacion in habitaciones" :key="habitacion.id" class="hover:bg-gray-50">
            <td class="px-4 py-2">{{ habitacion.numero }}</td>
            <td class="px-4 py-2 capitalize">{{ habitacion.tipo }}</td>
            <td class="px-4 py-2">Bs {{ habitacion.precio }}</td>
            <td class="px-4 py-2">
              <span
                :class="{
                  'bg-green-200 text-green-800': habitacion.estado === 'disponible',
                  'bg-yellow-200 text-yellow-800': habitacion.estado === 'reservada',
                  'bg-red-200 text-red-800': habitacion.estado === 'ocupada',
                  'bg-purple-200 text-purple-800': habitacion.estado === 'limpieza'
                }"
                class="px-2 py-1 rounded text-xs font-medium"
              >
                {{ habitacion.estado }}
              </span>
            </td>
            <td class="px-4 py-2">{{ habitacion.piso }}</td>
            <td class="px-4 py-2 text-right space-x-2">
              <button
                @click="$inertia.visit(`/habitaciones/${habitacion.id}/edit`)"
                class="text-blue-600 hover:underline"
              >
                Editar
              </button>
              <button
                @click="eliminar(habitacion.id)"
                class="text-red-600 hover:underline"
              >
                Eliminar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
     </div>
  </div>
</app-layout>
</template>
