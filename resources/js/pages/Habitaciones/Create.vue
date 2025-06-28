<script setup>
import HabitacionForm from '@/components/Habitaciones/HabitacionForm.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  numero: '',
  tipo: '',
  precio: '',
  estado: 'disponible',
  piso: '',
  observaciones: '',
})

const submit = () => {
  form.post('/habitaciones')
}
</script>

<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Nueva Habitación</h1>

    <HabitacionForm :habitacion="form" @submit="submit" submitLabel="Registrar" />
  </div>
</template>
