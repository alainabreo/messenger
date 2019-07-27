<template>

<b-media :right-align="writtenByMe" vertical-align="center" class="mb-2">
    <b-img :src="image" rounded="circle" slot="aside" width="48" height="48" ></b-img>
    <!-- no-body reduce el ancho del mensaje -->
    <!-- <b-card no-body> -->
    <b-card>
        <!-- {{ content }} -->
        <slot></slot>
    </b-card>
</b-media>

</template>

<script>
    export default {
        props: {
            image: String,
            writtenByMe: Boolean
        },
        data () {
            return {
                //content: 'abc'
            };
        },
        mounted() {
            //console.log('Message Conversation Component mounted.')
        }
    }
</script>
