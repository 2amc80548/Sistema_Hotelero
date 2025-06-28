<script setup>
import ClienteForm from '@/components/Clientes/ClienteForm.vue'
import { useForm } from '@inertiajs/vue3'

// Recibe habitaciones del backend
defineProps({
  cliente: Array
})

// Creamos el formulario con valores por defecto
const form = useForm({
  nombre: '',
  documento_identidad: '',
  telefono: '',
  email: '',
  direccion: '',
})

// Al enviar el formulario
const submit = () => {
  form.post('/clientes')
}
</script>

<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Nuevo Cliente</h1>
    <ClienteForm :cliente="form" @submit="submit" submit-label="Registrar" />
  </div>
</template>

