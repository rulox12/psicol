<template>
  <div>
    <Header/>
    <div class="container">
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

        <b-button type="submit" variant="primary">Submit</b-button>
        <b-button type="reset" variant="danger">Reset</b-button>
      </b-form>
      <b-card class="mt-3" header="Form Data Result">
        <pre class="m-0">{{ form }}</pre>
      </b-card>
    </div>
  </div>
</template>
<script>

import Header from '@/components/Header.vue'

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
      show: true
    }
  },
  methods: {
    onSubmit(event) {
      event.preventDefault()
      alert(JSON.stringify(this.form))
    },
    onReset(event) {
      event.preventDefault()
      // Reset our form values
      this.form.email = ''
      this.form.name = ''
      this.form.surname = ''
      this.form.mobile = []
      // Trick to reset/clear native browser form validation state
      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    }
  }


}
</script>