<template>
  <div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">UPDATE CONTACT</div>
          <div class="card-body">
            <form @submit.prevent="UpdateContact">
              <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" v-model="contacts.name" placeholder="Enter Name">
                <div v-if="validation.name">
                  <div class="alert alert-danger mt-1" role="alert">
                    {{ validation.name[0] }}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" v-model="contacts.address" placeholder="Enter Address">
                <div v-if="validation.address">
                  <div class="alert alert-danger mt-1" role="alert">
                    {{ validation.address[0] }}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" v-model="contacts.phone" placeholder="Enter Phone Number">
                <div v-if="validation.phone">
                  <div class="alert alert-danger mt-1" role="alert">
                    {{ validation.phone[0] }}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Gender</label>
                <select class="form-control" v-model="contacts.gender">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Relationship</label>
                <select class="form-control" v-model="contacts.relationship">
                  <option value="Family">Family</option>
                  <option value="Friend">Friend</option>
                  <option value="Colleague">Colleague</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Status</label>
                <select class="form-control" v-model="contacts.status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success mt-3">UPDATE</button>
                <button type="reset" class="btn btn-sm btn-danger mt-3 pl-5 update">RESET</button>
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
      validation: {}
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
            this.$router.go(-1);
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
        phone: '',
        gender: '',
        relationship: '',
        status: ''
      };
      this.validation = {};
    }
  }
};
</script>
