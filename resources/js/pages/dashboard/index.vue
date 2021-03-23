<template>
  <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{posts.length}}</h3>

                                    <p>Posts</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a @click="redirectPost" class="small-box-footer" style="cursor: pointer">More info</a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{users.length}}</h3>

                                    <p>User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a @click="redirectUser" class="small-box-footer" style="cursor: pointer">More info</a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{admins.length}}</h3>

                                    <p>Admins</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a @click="redirectAdmin" class="small-box-footer" style="cursor: pointer">More info</a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data : () => ({
      users : [],
      posts : [],
      admins : []
  }),

  methods : {
      getUsers(){
          axios.get('/api/users')
          .then((response) => {
              this.users = response.data
          })
          .catch((error) => {
              console.log(error)
          })
      },
      getAdmins(){
          axios.get('/api/admins')
          .then((response) => {
              this.admins = response.data
          })
          .catch((error) => {
              console.log(error)
          })
      },
      getPosts(){
          axios.get('/api/posts')
          .then((response) => {
              this.posts = response.data
          })
          .catch((error) => {
              console.log(error)
          })
      },
      redirectPost(){
          this.$router.push({ name : 'posts.index'})
      },
      redirectUser(){
          this.$router.push({ name : 'users.index'})
      },
      redirectAdmin(){
          this.$router.push({ name : 'manage.index'})
      },
  },

  created() {
      this.getUsers()
      this.getAdmins()
      this.getPosts()
  }
}
</script>
