<template>
  <div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">UPDATE CONTACT</div>
          <div class="card-body">
            <form @submit.prevent="UpdateContact">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" v-model="contacts.name" placeholder="Enter Name">
                <div v-if="validation.name">
                  <div class="alert alert-danger mt-1" role="alert">
                    {{ validation.name[0] }}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" v-model="contacts.address" placeholder="Enter Address">
                <div v-if="validation.address">
                  <div class="alert alert-danger mt-1" role="alert">
                    {{ validation.address[0] }}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" v-model="contacts.phone" placeholder="Enter Phone Number">
                <div v-if="validation.phone">
                  <div class="alert alert-danger mt-1" role="alert">
                    {{ validation.phone[0] }}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-md btn-danger">RESET</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      contacts: {},
      validation: []
    }
  },
  created() {
    this.fetchContact();
  },
  methods: {
    fetchContact() {
      axios.get(`/contacts/${this.$route.params.id}`)
        .then(response => {
          if (response.data.success) {
            this.contacts = response.data.data;
          } else {
            console.error('Failed to fetch contact');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    UpdateContact() {
      axios.put(`/contacts/update/${this.$route.params.id}`, this.contacts)
        .then(response => {
          if (response.data.success) {
            alert('Contact updated successfully');
            this.$router.go(-1); // Go back to the previous page
          } else {
            alert('Failed to update contact');
          }
        })
        .catch(error => {
          this.validation = error.response.data.errors;
        });
    },
    resetForm() {
      this.contacts = {
        name: '',
        address: '',
        phone: ''
      };
      this.validation = {};
    }
  }
};
</script>
