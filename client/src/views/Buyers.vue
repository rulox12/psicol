<template>
  <div>
    <Header/>
    <div class="container">
      <br/>
      <b-button variant="secondary" :href="'/register_buyer/'">Crear nuevo</b-button>
      <br/>
      <br/>
      <b-alert
          :show="dismissCountDown"
          dismissible
          variant="info"
          @dismissed="dismissCountDown=0"
          @dismiss-count-down="countDownChanged"
      >
        <p>{{ this.message }}</p>
        <b-progress
            variant="info"
            :max="dismissSecs"
            :value="dismissCountDown"
            height="4px"
        ></b-progress>
      </b-alert>
      <table class="table table-hover">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Correo</th>
          <th scope="col">Celular</th>
          <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="buyer in buyers" :key="buyer.id">
          <th scope="row">{{ buyer.id }}</th>
          <td>{{ buyer.name }}</td>
          <td>{{ buyer.surname }}</td>
          <td>{{ buyer.email }}</td>
          <td>{{ buyer.mobile }}</td>
          <td>
            <b-button variant="info" @click="setBuyerSelect(buyer.id)" v-b-modal.modal-prevent-closing>
              Añadir boleto
            </b-button>
          </td>
        </tr>
        </tbody>
      </table>
      <b-modal
          id="modal-prevent-closing"
          ref="modal"
          title="Selecciona el boleto"
          @ok="handleOk"
      >
        <form ref="form" @submit.stop.prevent="handleSubmit">
          <b-form-select
              label="Ticket"
              v-model="ticketSelected"
              value-field="id"
              text-field="event"
              :select-size="4"
              :options="tickets">
          </b-form-select>
        </form>
      </b-modal>
    </div>
  </div>
</template>
<script>

import Header from '@/components/Header.vue'
import axios from "axios";

export default {
  name: 'Buyers',
  data() {
    return {
      buyers: null,
      typeAlert: '',
      ticketSelected: '',
      buyerSelected: '',
      dismissCountDown: 0,
      dismissSecs: '',
      tickets: null,
      message: '',
      name: '',
    }
  },
  components: {
    Header,
  },
  mounted() {
    axios.get(process.env.VUE_APP_URL + 'buyer', {
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'),
      }
    }).then(response => {
      this.buyers = response.data.data;
    })
    axios.get(process.env.VUE_APP_URL + 'ticket/available/1', {
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
    handleOk(bvModalEvt) {
      bvModalEvt.preventDefault()
      this.handleSubmit()
    },
    handleSubmit() {
      axios.put(`${process.env.VUE_APP_URL}ticket/assign/${this.ticketSelected}/${this.buyerSelected}`, '', {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token'),
        }
        // eslint-disable-next-line no-unused-vars
      }).then(response => {
        this.message = 'Boleto añadido';
        this.typeAlert = 'success'
        this.showAlert()

        // eslint-disable-next-line no-unused-vars
      }).catch(error => {
        this.message = 'No se pudo asignar el boleto'
        this.showAlert();
      })
      this.$nextTick(() => {
        this.$bvModal.hide('modal-prevent-closing')
      })
    },
    setBuyerSelect(buyerId) {
      this.buyerSelected = buyerId;
    },
    showAlert() {
      this.dismissCountDown = 5
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
  }
}
</script>