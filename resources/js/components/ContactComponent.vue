<template>
    <b-list-group-item :variant="variant">
        <b-row class="p-0" aligh-h="center">
            <b-col cols="12" sm="3" class="text-center">
                <b-img :src="conversation.contact_image" rounded="circle" width="48" height="48" class="m-1"></b-img>
            </b-col>
            <b-col cols="6" align-self="center" class="d-none d-md-block">
                <p class="mb-1">
                    <status-component :online="conversation.online" />

                    {{ conversation.contact_name }}
                </p>
                <p class="text-muted small mb-1">{{ conversation.last_message }}</p>
            </b-col>
            <b-col cols="3" class="d-none d-md-block">
                <p class="text-muted small">{{ lastTime }}</p>
            </b-col>
        </b-row>
    </b-list-group-item>
</template>

<script>
    export default {
        props: {
            conversation: Object,
            selected: Boolean
        },
        data () {
            return {
            };
        },
        mounted() {
            console.log('Contact Component mounted.')
        },
        computed: {
            lastTime() {
                return moment(this.conversation.last_time, "YYYY-MM-DD hh:mm:ss").locale('es').fromNow();
            },
            variant() {
                //dark, secondary, info, ''
                return this.selected ? 'info' : '';
            }
        }
    }
</script>
