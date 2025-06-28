<script setup>
import { usePage } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import Alert from '@/components/Alert.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { router } from '@inertiajs/vue3'







const props = defineProps({ clientes: Array })
const flashMessage = usePage().props.flash?.success
const search = ref('')

const filteredClientes = computed(() => {
  return props.clientes.filter(c =>
    c.nombre.toLowerCase().includes(search.value.toLowerCase()) ||
    c.documento_identidad.toLowerCase().includes(search.value.toLowerCase())
  )
})

const eliminar = (id) => {
  if (confirm('¿Estás seguro de eliminar este cliente?')) {
    router.delete(`/clientes/${id}`)
  }
}
</script>

<template>
  <AppLayout>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Clientes</h1>
      <input v-model="search" placeholder="Buscar cliente..." class="mb-4 px-3 py-2 border rounded w-full" />
      <Alert v-if="flashMessage" :message="flashMessage" />
     <div class="mb-4">
      <button @click="$inertia.visit('/clientes/create')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Nuevo Cliente
       </button>
     </div>

    
    <table class="min-w-full divide-y divide-gray-200 text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left font-medium text-gray-700">Nombre</th>
          <th class="px-4 py-2 text-left font-medium text-gray-700">CI</th>
          <th class="px-4 py-2 text-left font-medium text-gray-700">Teléfono</th>
          <th class="px-4 py-2 text-left font-medium text-gray-700">Email</th>
          <th class="px-4 py-2 text-center font-medium text-gray-700">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cliente in filteredClientes" :key="cliente.id" class="border-t">
          <td class="px-4 py-2">{{ cliente.nombre }}</td>
          <td class="px-4 py-2">{{ cliente.documento_identidad }}</td>
          <td class="px-4 py-2">{{ cliente.telefono }}</td>
          <td class="px-4 py-2">{{ cliente.email }}</td>
          <td class="px-4 py-2 text-center space-x-2">
            <button @click="$inertia.visit(`/clientes/${cliente.id}`)" class="text-green-600 hover:underline">Ver</button>
            <button @click="$inertia.visit(`/clientes/${cliente.id}/edit`)" class="text-blue-600 hover:underline">Editar</button>
            <button @click="eliminar(cliente.id)" class="text-red-600 hover:underline">Eliminar</button>
          </td>
        </tr>
        <tr v-if="!filteredClientes.length">
          <td colspan="5" class="text-center py-4 text-gray-500">No se encontraron clientes.</td>
        </tr>
      </tbody>
     </table>
     </div>
    
  </AppLayout>
</template>