<template>
  <div>
    <Header/>
    <div class="container">
      <div class="alert alert-danger" role="alert" v-if="error">
        {{ this.error_message }}
      </div>
      <b-form @submit="onSubmit" @reset="onReset" v-if="show">

        <b-form-group id="input-group-2" label="Nombre:" label-for="input-2">
          <b-form-input
              id="input-2"
              v-model="form.name"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-2" label="Apellido:" label-for="input-2">
          <b-form-input
              id="input-2"
              v-model="form.surname"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group
            id="input-group-1"
            label="Correo:"
            label-for="input-1"
        >
          <b-form-input
              id="input-1"
              v-model="form.email"
              type="email"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-3" label="Celular:" label-for="input-3">
          <b-form-input
              id="input-1"
              v-model="form.mobile"
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
  name: 'RegisterBuyer',
  components: {
    Header,
  },
  data() {
    return {
      form: {
        email: '',
        name: '',
        surname: '',
        mobile: ''
      },
      show: true,
      error: false,
      error_message: true
    }
  },
  methods: {
    onSubmit(event) {
      event.preventDefault()
      console.log(this.form);
      axios.post(process.env.VUE_APP_URL + 'buyer', this.form, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token'),
        }
      }).then(response => {
        this.buyers = response.data.data
        this.$router.push('/buyers/')
        this.onReset()
        // eslint-disable-next-line no-unused-vars
      }).catch(error => {
        this.error = true;
        this.error_message = 'No se pudo registrar el comprador';
      })
    },
    onReset(event) {
      event.preventDefault()

      this.form.email = ''
      this.form.name = ''
      this.form.surname = ''
      this.form.mobile = ''

      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    }
  }


}
</script>