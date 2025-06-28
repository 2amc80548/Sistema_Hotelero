
<script setup>
import { router, usePage, Link } from '@inertiajs/vue3'
import Alert from '@/components/Alert.vue'
import AppLayout from '@/layouts/AppLayout.vue'
//inportar
const props = defineProps({
  inventario: Array
})

const page = usePage()
const flashMessage = page.props.flash?.success

const eliminar = (id) => {
  if (confirm('¿Seguro que deseas eliminar este producto?')) {
    router.delete(`/inventario/${id}`)
  }
}
</script>


<template>
 <app-layout>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Inventario</h1>

    <Alert v-if="flashMessage" :message="flashMessage" class="mb-4" />

    <div class="mb-4">
      <Link href="/inventario/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Nuevo Producto
      </Link>
    </div>

    <table class="min-w-full bg-white rounded shadow">
      <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
          <th class="py-3 px-4 text-left">Producto</th>
          <th class="py-3 px-4 text-left">Cantidad</th>
          <th class="py-3 px-4 text-left">Stock Mínimo</th>
          <th class="py-3 px-4 text-left">Ubicación</th>
          <th class="py-3 px-4 text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in inventario" :key="item.id" class="border-b">
          <td class="py-2 px-4">{{ item.producto }}</td>
          <td class="py-2 px-4">{{ item.cantidad }}</td>
          <td class="py-2 px-4">{{ item.stock_minimo }}</td>
          <td class="py-2 px-4">{{ item.ubicacion }}</td>
          <td class="py-2 px-4 text-center">
            <Link :href="`/inventario/${item.id}/edit`" class="text-blue-600 hover:underline">Editar</Link>
            <button @click="eliminar(item.id)" class="text-red-600 hover:underline ml-2">Eliminar</button>
          </td>
        </tr>
        <tr v-if="!inventario.length">
          <td colspan="5" class="py-4 text-center text-gray-400">No hay productos en inventario.</td>
        </tr>

        
      </tbody>
    </table>
  </div>
</app-layout>
</template>


  