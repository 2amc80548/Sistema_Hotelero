

<script setup>
import InventarioForm from '@/Components/Inventario/InventarioForm.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  producto: '',
  cantidad: 0,
  stock_minimo: 0,
  ubicacion: '',
  observaciones: '',
})

const submit = () => {
  form.post('/inventario')
}
</script>
<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Nuevo Producto</h1>
    <InventarioForm :inventario="form" @submit="submit" submitLabel="Registrar" />
  </div>
</template>