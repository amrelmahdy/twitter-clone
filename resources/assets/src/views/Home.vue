<script>
    import { mapState } from 'vuex'
    import axios from 'axios'
    export default {
        computed: {
            ...mapState({
                userStore: state => state.userStore
            })
        },
        mounted(){
            axios.get('/oauth/user', { })
            let authUser = JSON.parse(window.localStorage.getItem('authUser'))
            this.$store.dispatch('setAuthUser', authUser)

        },
    }
</script>





<style></style>