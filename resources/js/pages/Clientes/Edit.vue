<script setup>
import ClienteForm from '@/components/Clientes/ClienteForm.vue'
import { useForm } from '@inertiajs/vue3'


const props = defineProps({
  cliente: Object
})

const form = useForm({
  nombre: props.cliente.nombre,
  documento_identidad: props.cliente.documento_identidad,
  telefono: props.cliente.telefono,
  email: props.cliente.email,
  direccion: props.cliente.direccion,
})
const submit = () => {
  form.put(`/clientes/${props.cliente.id}`)
}

</script>

<template>
    <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Editar Cliente</h1>
    <ClienteForm :cliente="form" @submit="submit" submitLabel="Actualizar" />
  </div>
</template>
