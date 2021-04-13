<template>
  <div>
    <Header/>
    <div class="container">
      <table class="table table-hover">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Evento</th>
          <th scope="col">Fecha del Evento</th>
          <th scope="col">Costo</th>
          <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="ticket in tickets" :key="ticket.id">
          <th scope="row">{{ ticket.id }}</th>
          <td>{{ ticket.event }}</td>
          <td>{{ ticket.event_date }}</td>
          <td>{{ ticket.charge }}</td>
          <td>
            <b-button v-if="ticket.available" variant="success" @click="toggle(ticket.id)"
                      v-b-modal.modal-prevent-closing>Inactivar
            </b-button>
            <b-button v-if="!ticket.available" variant="danger" @click="toggle(ticket.id)"
                      v-b-modal.modal-prevent-closing>Activar
            </b-button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>

import Header from '@/components/Header.vue'
import axios from "axios";

export default {
  name: 'Dashboard',
  data() {
    return {
      buyers: null,
      selected: '',
      tickets: null,
      name: '',
      nameState: '',
      active: true
    }
  },
  components: {
    Header,
  },
  mounted() {
    axios.get('http://api.test/api/ticket', {
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'),
      }
    }).then(response => {
      this.tickets = response.data.data;
      // eslint-disable-next-line no-unused-vars
    }).catch(error => {
      this.$router.push('/')
    })
  },
  methods: {
    toggle(ticketId) {
      axios.get('http://api.test/api/ticket/toggle/' + ticketId, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token'),
        }
      }).then(response => {
        this.tickets = response.data.data;
        // eslint-disable-next-line no-unused-vars
      }).catch(error => {
        this.$router.push('/')
      })
    }
  }
}
</script>