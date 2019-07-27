<template>
	<b-container>
		<b-card class="mt-3" header="Datos de tu Perfil">
			<b-form action="" method="post" enctype="multipart/form-data" >
				<input type="hidden" name="_token" v-model="csrfToken">

				<b-form-group
					label="Email:">
					<b-form-input
						v-model="user.email"
						name="email"
						type="email"
						disabled
						placeholder="Ingresa tu email">
					</b-form-input>
				</b-form-group>

				<b-form-group 
					label="Nombre:">
					<b-form-input
						v-model="user.name"
						name="name"
						type="text"
						required
						placeholder="Ingresa tu nombre">
					</b-form-input>
				</b-form-group>

				<b-form-group 
					label="Nueva contraseña:">
					<b-form-input
						type="password"
						name="password"
						placeholder="Ingresa nueva contraseña">
					</b-form-input>
				</b-form-group>

				<b-form-group 
					label="Imágen de perfil:">
					<b-img :src="image" rounded="circle" width="60" height="60" alt="Imágen de Perfil" title="Imágen actual" class="m-1" />
					<b-form-file
						name="image"
						placeholder="Selecciona nueva imágen de perfil">
					</b-form-file>
				</b-form-group>

				<b-button type="submit" variant="primary">Guardar cambios</b-button>
			</b-form>
		</b-card>
	</b-container>
</template>

<script>
  export default {
  	props: {
  		user: Object,
  		csrfToken: String
  	},
    data() {
      return {
      }
    },
    methods: {
    },
    computed: {
    	image() {
    		return `/users/${this.user.image}`;
    	}
    }
  }
</script>