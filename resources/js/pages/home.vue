<template>
  <div>
    <div v-if="authenticated">
      <DashBoard></DashBoard>
    </div>
    <div v-else>
      <Login></Login>
    </div>
  </div>
</template>

<script>

import {mapGetters} from 'vuex'
import Login from '../pages/auth/login'
import DashBoard from '../pages/dashboard/index'

export default {
  metaInfo(){
    return {title : "Home"}
  },
  computed : mapGetters({
    authenticated : 'auth/check'
  }),
  components: {
    Login,
    DashBoard
  }
}
</script>
