<template>
  <div class="wrapper">
    <div v-if="user">
      <navbar-top />
      <navbar-left/>
    </div>
    <div>
      <child />
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import NavbarLeft from '../components/NavbarLeft.vue'
import NavbarTop from '../components/NavbarTop.vue'

export default {
  name: 'MainLayout',

  components: {
    NavbarTop,
    NavbarLeft
  },

  computed: mapGetters({
    user: 'auth/user'
  }),
}
</script>