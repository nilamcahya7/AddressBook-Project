<template>
  <div class="container mt-3">
    <router-view></router-view>
    <div class= "row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header"> ADDRESS BOOK </div>
          <div class="card-body">
            <router-link to="/create" class="btn btn-info">ADD CONTACT</router-link>
            <div class="input-group mb-3">
              <input type="text" v-model="searchQuery" class="form-control" placeholder="Search contacts...">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" @click="searchContacts">Search</button>
              </div>
            </div>
            <div class="table-responsive mt-3">
              <table class="table table-hover table-bordered" border="1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Relationship</th>
                    <th>Gender</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(i, index) in contacts" :key="index">
                    <td>{{ i.id }}</td>
                    <td>{{ i.name }}</td>
                    <td>{{ i.address }}</td>
                    <td>{{ i.phone }}</td>
                    <td>{{ i.relationship }}</td>
                    <td>{{ i.gender }}</td>
                    <td>{{ i.status }}</td>
                    <td class="text-center">
                      <router-link :to="{name : 'edit', params: { id: i.id }}" class="btn btn-primary">EDIT</router-link>
                      <button class="btn-danger btn-sm" @click="deleteContact(i.id)">DELETE</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default{
  data(){
    return{
      searchQuery:'',
      contacts:[]
    }
  },
  mounted(){
    this.fetchContacts();
  },
  methods:{
    fetchContacts(){
      axios.get('/contacts')
        .then(response=>{
          if (response.data.success) {
            this.contacts = response.data.data;
          } else {
            console.error('Failed to fetch contacts');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    deleteContact(id) {
      if (confirm('Are you sure you want to delete this contact?')) {
        axios.delete(`/contacts/delete/${id}`)
          .then(response => {
            if (response.data.success) {
              alert('Contact deleted successfully');
              this.fetchContacts();
            } else {
              alert('Failed to delete contact');
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
    },
    searchContacts() {
      axios.get(`/search?query=${this.searchQuery}`)
        .then(response => {
          if (response.data.success) {
            this.contacts = response.data.data;
          } else {
            console.error('Failed to fetch search results');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
  }
};
</script>