<template>
  <div class="container mt-3">
    <router-view></router-view>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">
            <h4 class="card-header">ADDRESS BOOK</h4></div>
          <div class="card-body">
            <router-link to="/create" class="btn btn-outline-success btn-sm">ADD CONTACT</router-link>
            <div class="input-group mb-3 mt-3">
              <input type="text" v-model="searchQuery" class="form-control" placeholder="Search Contact">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" @click="searchContacts">Search</button>
              </div>
            </div>
            <div class="input-group">
              <select v-model="selectedRelationship" class="form-control">
                <option value="">All Relationships</option>
                <option value="Family">Family</option>
                <option value="Friend">Friend</option>
                <option value="Colleague">Colleague</option>
                <option value="Other">Other</option>
              </select>
              <select v-model="selectedGender" class="form-control">
                <option value="">All Genders</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
              <select v-model="selectedStatus" class="form-control">
                <option value="">All Statuses</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" @click="filterContacts">Filter</button>
              </div>
            </div>
            <div class="content table-responsive mt-3">
              <table class="table table-hover table-bordered custom-row">
                <thead>
                  <tr class="custom-th">
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Relationship</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(contact, index) in contacts" :key="contact.id" class="custom-row">
                    <td>{{ index + 1 + (currentPage - 1) * perPage }}</td>
                    <td>{{ contact.name }}</td>
                    <td>{{ contact.address }}</td>
                    <td>{{ contact.phone }}</td>
                    <td>{{ contact.relationship }}</td>
                    <td>{{ contact.gender }}</td>
                    <td>{{ contact.status }}</td>
                    <td class="text-center">
                      <router-link :to="{ name: 'edit', params: { id: contact.id }}" class="btn btn-sm"><i class="fas fa-edit"></i></router-link>
                      <button class="btn btn-sm" @click="deleteContact(contact.id)"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="pagination">
              <button class="btn btn-outline-primary btn-sm" :disabled="currentPage === 1" @click="handlePagination(currentPage - 1)">Previous</button>
              <button
                v-for="page in pageButtons"
                :key="page"
                class="btn btn-outline-primary btn-sm"
                @click="handlePagination(page)"
                :disabled="currentPage === page"
              >
                {{ page }}
              </button>
              <button
                v-if="totalPages > maxVisibleButtons"
                class="btn btn-outline-primary btn-sm"
                @click="nextPageGroup"
              >
                Next
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      searchQuery: '',
      selectedRelationship: '',
      selectedGender: '',
      selectedStatus: '',
      contacts: [],
      currentPage: 1,
      totalPages: 1,
      perPage: 10,
      maxVisibleButtons: 10,
      startPage: 1,
      isSearching: false,
      isFiltering: false,
    }
  },
  mounted() {
    this.fetchContacts();
  },
  computed: {
    pageButtons() {
      const endPage = Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
      let buttons = [];
      for (let i = this.startPage; i <= endPage; i++) {
        buttons.push(i);
      }
      return buttons;
    }
  },
  methods: {
    fetchContacts(page = 1) {
      this.currentPage = page;
      axios.get('/contacts', { params: { page: this.currentPage, perPage: this.perPage } })
        .then(response => {
          if (response.data.success) {
            this.contacts = response.data.data;
            this.totalPages = response.data.last_page;
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
              this.handlePagination(this.currentPage);
            } else {
              alert('Failed to delete contact');
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
    },
    searchContacts(page = 1) {
      this.currentPage = page;
      this.isSearching = true;
      this.isFiltering = false;
      axios.get(`/search`, { params: { query: this.searchQuery, page: this.currentPage, perPage: this.perPage } })
        .then(response => {
          if (response.data.success) {
            this.contacts = response.data.data;
            this.totalPages = response.data.last_page;
          } else {
            console.error('Failed to fetch search results');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    filterContacts(page = 1) {
      this.currentPage = page;
      this.isSearching = false;
      this.isFiltering = true;
      const params = {
        page: this.currentPage,
        perPage: this.perPage
      };
      if (this.selectedRelationship) {
        params.relationship = this.selectedRelationship;
      }
      if (this.selectedGender) {
        params.gender = this.selectedGender;
      }
      if (this.selectedStatus) {
        params.status = this.selectedStatus;
      }

      axios.get(`/filter`, { params })
        .then(response => {
          if (response.data.success) {
            this.contacts = response.data.data;
            this.totalPages = response.data.last_page;
          } else {
            console.error('Failed to fetch filtered contacts');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    handlePagination(page) {
      if (this.isSearching) {
        this.searchContacts(page);
      } else if (this.isFiltering) {
        this.filterContacts(page);
      } else {
        this.fetchContacts(page);
      }
    },
    nextPageGroup() {
      if (this.startPage + this.maxVisibleButtons <= this.totalPages) {
        this.startPage += this.maxVisibleButtons;
        this.handlePagination(this.startPage);
      }
    }
  }
};
</script>
