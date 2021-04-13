<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="#">
        <b-img rounded=""  src="https://psicol.co/wp-content/uploads/2018/08/logo-Psicol.png" id="icon" alt="User Icon"/>
      </b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item :href="'/buyers/'">Ver Clientes</b-nav-item>
          <b-nav-item :href="'/tickets/'">Ver Boletos</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>