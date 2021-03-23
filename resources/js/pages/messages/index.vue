<template>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h2>Fill out the form two user to watch thier messages</h2>
        <div class="row justify-content-center">
          <div class="col-md-3">
            <input
              type="number"
              v-model="idUser1"
              placeholder="Id user 1"
              class="form-control"
              required
            />
          </div>
          <div class="col-md-3">
            <input
              type="number"
              v-model="idUser2"
              placeholder="Id user 2"
              class="form-control"
              required
            />
          </div>
          <div class="col-md-3" v-if="idUser1 != '' && idUser2 != ''">
            <button class="btn btn-primary" @click="viewMessage()">
              View Message
            </button>
          </div>
          <div class="col-md-3" v-else>
            <button disabled class="btn btn-primary">View Message</button>
          </div>
        </div>
        <div class="row justify-content-center" v-if="check">
            <div class="col-md-6">
              <div class="message-wrapper">
                <span v-if="messages.length <= 0">Not fount Their Message</span>
                <ul class="messages" v-else>
                  <li
                    v-for="message in messages"
                    :key="message.id"
                    class="message clearfix"
                  >
                    <div :class="getClass(message.from)">
                      <p>{{ message.message }}</p>
                    </div>
                  </li>
                </ul>
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
    return { title: "Messages" };
  },

  data: () => ({
    idUser1: "",
    idUser2: "",
    messages: [],
    check: false,
  }),

  methods: {
    viewMessage() {
      axios
        .get("/api/messages/user1/" + this.idUser1 + "/user2/" + this.idUser2)
        .then((response) => {
          this.messages = response.data;
        })
        .catch((error) => {
          console.log(error);
        });

      this.check = true;
    },
    getClass(id) {
      return this.idUser1 == id ? "user1" : "user2";
    },
  },
};
</script>
<style scoped>
.message-wrapper {
  padding: 10px;
  height: 450px;
  background: #eeeeee;
  overflow-y: auto;
}

.messages .message {
  margin-bottom: 15px;
}

.messages .message:last-child {
  margin-bottom: 0;
}

ul {
  list-style-type: none;
}

.user1 .user2 {
  width: 45%;
  padding: 3px 10px;
  border-radius: 10px;
}

.user1 {
  background: #ffffff;
  width: max-content;
}


.user2 {
  background: #ffffff;
  float: right;
  text-align: right;
  border-radius: 10%;
}

.message p {
  margin: 5px 15px;
}
</style>