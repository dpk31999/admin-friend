<template>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <button class="btn btn-primary m-3" 
            data-toggle="modal"
            data-target="#modalAdd">Add Interest</button>
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive table--no-card m-b-30">
              <table class="table table-borderless table-striped table-earning">
                <thead>
                  <tr>
                    <th>Id interest</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Created at</th>
                    <th>Tools</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  <tr v-for="(interest,index) in interests" :key="interest.id">
                    <td>{{ interest.id }}</td>
                    <td>{{ interest.name }}</td>
                    <td><img :src="interest.url_icon" alt="" width="50px" height="50px"></td>
                    <td>{{ interest.created_at | formatDate }}</td>
                    <td>
                      <button
                        type="button"
                        @click="getInterest(interest.id,index)"
                        class="btn btn-info"
                        data-toggle="modal"
                        data-target="#modalEdit"
                      >
                        Edit
                      </button>
                      <button
                        type="button"
                        @click="deleteInterest(interest.id,index)"
                        class="btn btn-warning"
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Interest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" v-if="Object.keys(formEdit).length !== 0">
                    <form >
                        <div class="form-group">
                            <label class="control-label mb-1">Name Interest</label>
                            <input name="name" v-model="formEdit.name" type="text" class="form-control" placeholder="name interest" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Url Icon</label>
                            <input name="name" v-model="formEdit.url_icon" type="text" class="form-control" placeholder="url icon" required>
                        </div>
                        <div>
                            <button data-dismiss="modal" @click="editInterest(idSelect,index)" type="submit" class="btn btn-lg btn-info btn-block">
                                Edit
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Interest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form 
                    v-on:submit.prevent>
                        <div class="form-group">
                            <label class="control-label mb-1">Name Interest</label>
                            <input name="name" v-model="formAdd.name" type="text" class="form-control" placeholder="name interest" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Url Icon</label>
                            <input name="name" v-model="formAdd.url_icon" type="text" class="form-control" placeholder="url icon" required>
                        </div>
                        <div>
                            <button @click="addInterest" data-dismiss="modal" type="submit" class="btn btn-lg btn-info btn-block">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </section>
  </div>
</template>
<script>
import Form from "vform";
export default {
  middleware: 'auth',

  metaInfo() {
    return { title: "Interests" };
  },

  data : () => ({
    interests : [],
    check : false,
    formEdit: new Form({
        name: '',
        url_icon: ''
    }),
    formAdd: new Form({
        name: '',
        url_icon: ''
    }),
    index: '',
    idSelect: '',
  }),

  methods : {
      getInterests() {
          axios.get('/api/interests')
          .then((response) => {
              this.interests = response.data
          })
          .catch((error) => {
              console.log(error)
          })
      },
    
    getInterest(id,index) {
        this.index = index
        this.idSelect = id
        axios.get('/api/interests/' + id)
        .then((response) => {
            this.formEdit.name = response.data.name
            this.formEdit.url_icon = response.data.url_icon
        })
        .catch((error) => {
            console.log(error)
        })
    },

    editInterest(id,index) {
        axios.put('/api/interests/' + id, this.formEdit)
        .then((response) => {
            this.interests[index].name = response.data.name
            this.interests[index].url_icon = response.data.url_icon
        })
        .catch((error) => {
            console.log(error)
        })
    },

    deleteInterest(id,index) {
        this.$confirm("Are you sure delete this interest ??!!").then(() => {
            axios.delete('/api/interests/' + id)
            .then((response) => {
                this.interests.splice(index,1)
            })
            .catch((error) => {
                console.log(error)
            })
        });
    },

    addInterest() {
        axios.post('/api/interests', this.formAdd)
        .then((response) => {
            this.formAdd.name = '';
            this.formAdd.url_icon = '';
            this.interests.push({...response.data})
        })
        .catch((error) => {
            console.log(error)
        })
    }
  },

  created() {
      this.getInterests();
  }
};
</script>
<style lang="stylus" scoped></style>