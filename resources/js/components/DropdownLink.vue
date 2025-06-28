<template>
  <component :is="as" :class="classes">
    <slot />
  </component>
</template>

<script>
export default {
  props: {
    as: {
      type: String,
      default: 'a'
    },
    href: {
      type: String,
      default: '#'
    }
  },

  computed: {
    classes() {
      return 'block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
    }
  }
}
</script>