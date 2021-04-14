<template>
  <div>
    <Header/>
    <div class="container">
      <b-form @submit="onSubmit" @reset="onReset" v-if="show">

        <b-form-group id="input-group-2" label="Evento:" label-for="input-2">
          <b-form-input
              id="input-2"
              v-model="form.event"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-2" label="Costo:" label-for="input-2">
          <b-form-input
              id="input-2"
              v-model="form.charge"
              type="number"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group
            id="input-group-1"
            label="Fecha de evento:"
            label-for="input-1"
        >
          <b-form-input
              id="input-1"
              v-model="form.event_date"
              type="date"
              required
          ></b-form-input>
        </b-form-group>

        <b-button type="submit" variant="primary">Crear</b-button>
        <b-button type="reset" variant="danger">Reset
          <Formulario></Formulario>
        </b-button>
      </b-form>
    </div>
  </div>
</template>
<script>

import Header from '@/components/Header.vue'
import axios from "axios";

export default {
  name: 'RegisterTicket',
  components: {
    Header,
  },
  data() {
    return {
      form: {
        event: '',
        charge: '',
        event_date: ''
      },
      show: true
    }
  },
  methods: {
    onSubmit(event) {
      event.preventDefault()
      axios.post(process.env.VUE_APP_URL + 'ticket', this.form, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token'),
        }
        // eslint-disable-next-line no-unused-vars
      }).then(response => {
        this.$router.push('/tickets/')
        this.onReset()
      })
    },
    onReset(event) {
      event.preventDefault()
      this.form.event = ''
      this.form.event_date = ''
      this.form.charge = ''

      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    }
  }


}
</script>