<template>
    <nav class="navbar top-navbar">
        <div class="container-fluid">

            <div class="navbar-left">
                <div class="navbar-btn">
                    <a href="index.html"><img src="/assets/images/icon.svg" alt="Oculux Logo"
                            class="img-fluid logo"></a>
                    <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i>
                    </button>
                </div>
                <ul class="nav navbar-nav">

                    <li class="dropdown language-menu">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="fa fa-language"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item pt-2 pb-2" href="#"><img src="/assets/images/flag/us.svg "
                                    class="w20 mr-2 rounded-circle"> US English</a>
                            <a class="dropdown-item pt-2 pb-2" href="#"><img src="/assets/images/flag/gb.svg "
                                    class="w20 mr-2 rounded-circle"> UK English</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item pt-2 pb-2" href="#"><img src="/assets/images/flag/russia.svg "
                                    class="w20 mr-2 rounded-circle"> Russian</a>
                            <a class="dropdown-item pt-2 pb-2" href="#"><img src="/assets/images/flag/arabia.svg "
                                    class="w20 mr-2 rounded-circle"> Arabic</a>
                            <a class="dropdown-item pt-2 pb-2" href="#"><img src="/assets/images/flag/france.svg "
                                    class="w20 mr-2 rounded-circle"> French</a>
                        </div>
                    </li>

                    <li class="p_social"><a href="page-social.html" class="social icon-menu" title="News">Social</a>
                    </li>
                    <li class="p_news"><a href="page-news.html" class="news icon-menu" title="News">News</a></li>
                    <li class="p_blog"><a href="page-blog.html" class="blog icon-menu" title="Blog">Blog</a></li>
                </ul>
            </div>

            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="#" class="icon-menu" @click.prevent="logout"><i class="icon-power"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </nav>

</template>

<script>
export default {
    methods: {
        logout() {
            axios
                .request({ baseURL: '/', url: 'logout', method: 'post' })
                .then(() => location.assign('/'))
        }
    }
}
</script>

<style>
</style>
