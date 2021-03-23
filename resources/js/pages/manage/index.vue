<template>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <button
          class="btn btn-primary m-3"
          data-toggle="modal"
          data-target="#modalAdd"
        >
          Add Admin
        </button>
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive table--no-card m-b-30">
              <table class="table table-borderless table-striped table-earning">
                <thead>
                  <tr>
                    <th>Id admin</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tools</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  <tr
                    :class="{ 'bg-info': admin.id == user.id }"
                    v-for="(admin, index) in admins"
                    :key="admin.id"
                  >
                    <td>{{ admin.id }}</td>
                    <td>{{ admin.name }}</td>
                    <td>{{ admin.email }}</td>
                    <td>{{ admin.role.name }}</td>
                    <td>
                      <div v-if="admin.id != user.id">
                        <button
                          type="button"
                          @click="getAdmin(admin.id, index)"
                          class="btn btn-info"
                          data-toggle="modal"
                          data-target="#modalEdit"
                        >
                          Edit
                        </button>
                        <button
                          type="button"
                          @click="deleteAdmin(admin.id, index)"
                          class="btn btn-warning"
                        >
                          Delete
                        </button>
                      </div>
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
        id="modalEdit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Edit Admin</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" v-if="Object.keys(formEdit).length !== 0">
              <form>
                <div class="form-group">
                  <label class="control-label mb-1">Name Admin</label>
                  <input
                    name="name"
                    v-model="formEdit.name"
                    type="text"
                    class="form-control"
                    placeholder="name admin"
                    required
                  />
                </div>
                <div class="form-group">
                  <label class="control-label mb-1">Email</label>
                  <input
                    name="email"
                    v-model="formEdit.email"
                    type="text"
                    class="form-control"
                    placeholder="email"
                    required
                  />
                </div>
                <div class="form-group">
                  <label class="control-label mb-1">Password</label>
                  <input
                    name="password"
                    v-model="formEdit.password"
                    type="password"
                    class="form-control"
                    placeholder="password"
                    required
                  />
                </div>
                <div class="form-group">
                  <label class="control-label mb-1">Role</label>
                  <select class="form-control" v-model="formEdit.role">
                    <option v-for="role in roles" :key="role.id" :value="role">
                      {{ role }}
                    </option>
                  </select>
                </div>
                <div>
                  <button
                    data-dismiss="modal"
                    @click="editAdmin(idSelect, index)"
                    type="submit"
                    class="btn btn-lg btn-info btn-block"
                  >
                    Edit
                  </button>
                </div>
              </form>
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
      <div
        class="modal fade"
        id="modalAdd"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add Admin</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form v-on:submit.prevent>
                <div class="form-group">
                  <label class="control-label mb-1">Name Admin</label>
                  <input
                    name="name"
                    v-model="formAdd.name"
                    type="text"
                    class="form-control"
                    placeholder="name admin"
                    required
                  />
                </div>
                <div class="form-group">
                  <label class="control-label mb-1">Email</label>
                  <input
                    name="email"
                    v-model="formAdd.email"
                    type="text"
                    class="form-control"
                    placeholder="email"
                    required
                  />
                </div>
                <div class="form-group">
                  <label class="control-label mb-1">Password</label>
                  <input
                    name="password"
                    v-model="formAdd.password"
                    type="password"
                    class="form-control"
                    placeholder="password"
                    required
                  />
                </div>
                <div class="form-group">
                  <label class="control-label mb-1">Role</label>
                  <select class="form-control" v-model="formAdd.role">
                    <option disabled value="">Please select one</option>
                    <option v-for="role in roles" :key="role.id" :value="role">
                      {{ role }}
                    </option>
                  </select>
                </div>
                <div>
                  <button
                    data-dismiss="modal"
                    type="submit"
                    class="btn btn-lg btn-info btn-block"
                    @click="addAdmin"
                  >
                    Create
                  </button>
                </div>
              </form>
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
import Form from "vform";
import { mapGetters } from "vuex";
export default {
  middleware: 'auth',
  computed: mapGetters({
    user: "auth/user",
  }),
  metaInfo() {
    return { title: "Manage" };
  },

  data: () => ({
    admins: [],
    roles: [],
    formEdit: new Form({
      name: "",
      email: "",
      role: "",
      password: "",
    }),
    formAdd: new Form({
      name: "",
      email: "",
      role: "",
      password: "",
    }),
    index: "",
    idSelect: "",
  }),

  methods: {
    getAdmins() {
      axios
        .get("/api/admins")
        .then((response) => {
          this.admins = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getRoles() {
      axios
        .get("/api/roles")
        .then((response) => {
          this.roles = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getAdmin(id, index) {
      this.index = index;
      this.idSelect = id;
      axios
        .get("/api/admins/" + id)
        .then((response) => {
          this.formEdit.name = response.data.name;
          this.formEdit.email = response.data.email;
          this.formEdit.password = response.data.password;
          this.formEdit.role = response.data.role.name;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    editAdmin(id, index) {
      axios
        .put("/api/admins/" + id, this.formEdit)
        .then((response) => {
          this.admins[index].name = response.data.name;
          this.admins[index].email = response.data.email;
          this.admins[index].password = response.data.password;
          this.admins[index].role = response.data.role;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    deleteAdmin(id, index) {
      this.$confirm("Are you sure delete this admin ??!!").then(() => {
        axios
          .delete("/api/admins/" + id)
          .then((response) => {
            this.admins.splice(index, 1);
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },

    addAdmin() {
      axios
        .post("/api/admins", this.formAdd)
        .then((response) => {
          this.formAdd.name = "";
          this.formAdd.email = "";
          this.formAdd.password = "";
          this.formAdd.role = "";
        this.admins.push({ ...response.data });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    checkRole() {
      if(this.user.role.name != 'superadmin')
      {
        this.$router.push({ name: 'home'})
        this.$alert("You don't have a permision.");
      }
      else
      {
        this.getAdmins();
        this.getRoles();
      }
    }
  },

  created() {
    this.checkRole();
  },
};
</script>
<style lang="stylus" scoped></style>