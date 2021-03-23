<template>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive table--no-card m-b-30">
              <table class="table table-borderless table-striped table-earning">
                <thead>
                  <tr>
                    <th>Id user</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Tools</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.created_at | formatDate }}</td>
                    <td>
                      <button
                        type="button"
                        @click="changeDataUser(user.id)"
                        class="btn btn-info"
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                      >
                        View User
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div
        class="modal fade"
        id="exampleModalCenter"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">View User</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" v-if="Object.keys(user).length !== 0">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="left-banner mb-3">
                    <h4 class="text-information">Giới thiệu</h4>
                    <div class="text-information">
                      <span>
                        <img
                          class="icon"
                          src="https://static.xx.fbcdn.net/rsrc.php/v3/yk/r/X_t0JnueVu-.png"
                          alt
                        />
                        <span v-if="user.city != '' || user.country != ''" class="font-weight-bold"
                          >Sống tại {{ user.city }},
                          {{ user.country }}</span>
                        <span v-else class="font-weight-bold"
                          >Chưa có</span>
                      </span>
                      
                    </div>
                    <div class="text-information">
                      <span>
                        <img
                          class="icon"
                          src="https://static.xx.fbcdn.net/rsrc.php/v3/yB/r/ODICuZSjkMe.png"
                          alt
                        />
                        <span v-if="user.date_of_birth != ''" class="font-weight-bold">Sinh ngày {{
                          user.date_of_birth
                        }}</span>
                        <span v-else class="font-weight-bold">Chưa có</span>
                      </span>
                    </div>
                    <div class="text-information">
                      <span>
                        <img
                          class="icon"
                          src="https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/S0aTxIHuoYO.png"
                          alt
                        />
                        <span v-if="user.status != ''" class="font-weight-bold">Trạng thái {{
                          user.status
                        }}</span>
                        <span v-else class="font-weight-bold">Chưa có</span>
                      </span>   
                    </div>
                  </div>
                  <div class="left-banner mb-3">
                    <h4 class="text-information">Liên hệ</h4>
                    <div class="text-information">
                      <span>
                        <img
                          class="icon"
                          src="https://img.icons8.com/wired/64/000000/email.png"
                        />
                        Email
                        <span class="font-weight-bold">{{
                          user.email
                        }}</span>
                      </span>
                    </div>
                    <div class="text-information">
                      <span>
                        <img
                          class="icon"
                          src="https://img.icons8.com/material-outlined/48/000000/phone.png"
                        />
                        <span v-if="user.phone != null" class="font-weight-bold">Số điện thoại {{
                          user.phone
                        }}</span>
                        <span v-else class="font-weight-bold">Chưa có</span>
                      </span>
                    </div>
                    <div class="text-information">
                      <span>
                        <img
                          class="icon"
                          src="https://img.icons8.com/metro/26/000000/facebook-new.png"
                        />
                        Facebook
                        <span class="font-weight-bold"
                          ><a :href="user.link_fb" target="_blank">{{
                            user.name
                          }}</a></span
                        >
                      </span>
                    </div>
                  </div>

                  <div class="left-banner">
                    <h4 class="text-information">Sở thích</h4>
                    <div
                      class="interests"
                      v-for="interest in user.interests"
                      :key="interest.id"
                    >
                      <img
                        :src="interest.url_icon"
                        alt=""
                        width="25px"
                        height="25px"
                      />
                      {{ interest.name }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  middleware: 'auth',
  metaInfo() {
    return { title: "Users" };
  },

  data: () => ({
    users: [],
    user: {},
  }),

  methods: {
    getUsers() {
      axios
        .get("/api/users")
        .then((response) => {
          this.users = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getUser(id) {
      axios
        .get("/api/users/" + id)
        .then((response) => {
          this.user = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changeDataUser(id) {
      this.getUser(id);
    },
  },

  created() {
    this.getUsers();
  },
};
</script>
<style scoped>
.icon {
  margin-right: 5px;
  width: 20px;
}
</style>