<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link
              :to="{ name: 'home' }"
              :class="[{ active: $route.name === 'home' }]"
              class="brand-link"
            >
            <span class="brand-text font-weight-light">Admin</span>
            </router-link>
            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open">
                            <router-link 
                                :to="{ name: 'home' }"
                                :class="[{ active: $route.name === 'home' }]"
                                class="nav-link"
                            >
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item menu-open">
                            <router-link 
                                :to="{ name: 'manage.index' }"
                                :class="[{ active: $route.name === 'manage.index' }]"
                                class="nav-link"
                            >
                                <p>
                                    Manage
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item menu-open">
                            <router-link 
                                :to="{ name: 'posts.index' }"
                                :class="[{ active: $route.name === 'posts.index'}]"
                                class="nav-link"
                            >
                                <p>
                                    Posts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item menu-open">
                            <router-link 
                                :to="{ name: 'users.index' }"
                                :class="[{ active: $route.name === 'users.index' }]"
                                class="nav-link"
                            >
                                <p>
                                    Users
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item menu-open">
                            <router-link 
                                :to="{ name: 'interests.index' }"
                                :class="[{ active: $route.name === 'interests.index' }]"
                                class="nav-link"
                            >
                                <p>
                                    Interests
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item menu-open">
                            <router-link 
                                :to="{ name: 'messages.index' }"
                                :class="[{ active: $route.name === 'messages.index' }]"
                                class="nav-link"
                            >
                                <p>
                                    Messages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
