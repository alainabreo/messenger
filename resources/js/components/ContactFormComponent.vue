<template>
    <b-form class="my-3 mx-2">
        <b-form-input class="text-center" 
            type="text"
            v-model="querySearch"
            placeholder="Search contact"
            autocomplete="off">
        </b-form-input>                        
    </b-form>        
</template>

<script>
    export default {
        computed: {
        	querySearch: {
        		//getter y setter para computed property
        		get() {
        			return this.$store.state.querySearch;
        		},
        		set(value) {
        			this.$store.commit('newQuerySearch', value);
        		}
        	}
        }
    }
</script>
