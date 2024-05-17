<template>
  <div class="container mt-3">
    <router-view></router-view>
    <div class= "row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header"> ADDRESS BOOK </div>
          <div class="card-body">
            <router-link to="/create" class="btn btn-info">ADD CONTACT</router-link>
            <div class="table-responsive mt-3">
              <table class="table table-hover table-bordered" border="1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(i, index) in contacts" :key="index">
                    <td>{{ i.id }}</td>
                    <td>{{ i.name }}</td>
                    <td>{{ i.address }}</td>
                    <td>{{ i.phone }}</td>
                    <td class="text-center">
                      <router-link class="btn btn-primary">EDIT</router-link>
                      <button class="btn-danger btn-sm">DELETE</button>
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
    }
  }
};
</script>