<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <router-link
                    :to="{ name: 'home' }"
                    :class="[{ active: $route.name === 'home' }]"
                    class="nav-link"
                    >
                    Home
                    </router-link>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark"
                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    >
                    {{ user.name }}
                    </a>
                    <div class="dropdown-menu">
                    <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                        <fa icon="cog" fixed-width />
                        {{ $t('settings') }}
                    </router-link>

                    <div class="dropdown-divider" />
                    <a href="#" class="dropdown-item pl-3" @click.prevent="logout">
                        <fa icon="sign-out-alt" fixed-width />
                        {{ $t('logout') }}
                    </a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  
  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')
      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>

</style>
