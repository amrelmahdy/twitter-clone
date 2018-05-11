<script>
    import { mapState } from 'vuex'
    export default {

        created(){
            let authUser = JSON.parse(window.localStorage.getItem('authUser'))
            this.$store.dispatch('setAuthUser', authUser)

        },
        computed: {
            ...mapState({
                userStore: state => state.userStore
            })
        },

    }
</script>

<template>
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="#fake"><span class="glyphicon glyphicon-home"></span> Home</a>
                    </li>
                    <li>
                        <a href="#fake"><span class="glyphicon glyphicon-bell"></span> Notifications</a>
                    </li>
                    <li>
                        <a href="#fake"><span class="glyphicon glyphicon-envelope"></span> Messages</a>
                    </li>
                </ul>


                <div class="navbar-brand hidden-xs hidden-sm">
                    <a class="navbar-brand" href="#">
                        <img src="/images/logo.png" alt="logo" />
                    </a>
                </div>



                <div class="navbar-form navbar-right">
                    <!--<div class="form-group has-feedback">
                        <input type="text" class="form-control-nav" id="search" aria-describedby="search1">
                        <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                    </div>-->


                    <ul class="avatar-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="http://placehold.it/64x64" alt="avatar"/>
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="user-data-li">
                                    <strong  v-if="userStore.authUser != null">{{ userStore.authUser.name }}</strong>
                                    <span  v-if="userStore.authUser != null">@{{ userStore.authUser.username }}</span>
                                </li>
                                <li><a href="#">Profile</a></li>
                                <li><a href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>


                    <button class="btn btn-primary btn-tweet" style="margin-top: 7px" type="submit" aria-label="Left Align">
                      Tweet
                    </button>
                </div>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</template>

<style>
    .navbar-default .navbar-collapse, .navbar-default .navbar-form{
        margin: 0 !important;
        position: relative;
    }
    .avatar-list{
        list-style: none;
        float: left;
        margin-right: 18px;
        margin-bottom: 0 !important;
    }

    .avatar-list img{
        border-radius: 50%;
        width: 38px;
        border: 3px solid #EEE;
        margin-top: 6px;
    }

    .navbar-brand {
        padding: 6px 15px;
        position: absolute;
        left: 46%;
        top: 4px;
    }

    .navbar-brand img{
        width: 32px;
    }

    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover{
        background: none !important;
        box-shadow: inset 0 3px 9px rgba(0,0,0,.0);
    }

    .user-data-li{
        padding-left: 16px;
        border-bottom: 1px solid #EEE;
        padding-bottom: 8px;
    }

    .btn-tweet{
        margin-top: 7px;
        border-radius: 30px;
        background-color: #A9938F !important;
    }

    .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover{
        background-color: #A9938F !important;
    }
</style>