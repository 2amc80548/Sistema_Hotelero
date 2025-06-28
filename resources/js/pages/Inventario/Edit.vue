

<script setup>
import { useForm } from '@inertiajs/vue3'
import InventarioForm from '@/Components/Inventario/InventarioForm.vue'

const props = defineProps({
  inventario: Object
})

const form = useForm({ ...props.inventario })

const submit = () => {
  form.put(`/inventario/${props.inventario.id}`)
}
</script>
<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Producto</h1>
    <InventarioForm :inventario="form" @submit="submit" submit-label="Actualizar" />
  </div>
</template>